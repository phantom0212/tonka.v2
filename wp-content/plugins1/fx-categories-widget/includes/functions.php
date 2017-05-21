<?php
/**
 * Utility & Helper Functions
 * @since 0.1.0
**/

/**
 * Drop Down Taxonomy
 * This is a fork of `wp_dropdown_categories()` function to allow using slug instead of ID
 * @see wp-includes/category-template.php
 * @since 0.1.0
 */
function fx_cat_widget_dropdown_categories( $args = '' ) {
	$defaults = array(
		'show_option_all' => '', 'show_option_none' => '',
		'orderby' => 'id', 'order' => 'ASC',
		'show_count' => 0,
		'hide_empty' => 1, 'child_of' => 0,
		'exclude' => '', 'echo' => 1,
		'selected' => 0, 'hierarchical' => 0,
		'name' => 'cat', 'id' => '',
		'class' => 'postform', 'depth' => 0,
		'tab_index' => 0, 'taxonomy' => 'category',
		'hide_if_empty' => false, 'option_none_value' => -1,
		'value_field' => 'term_id',
	);

	$defaults['selected'] = ( is_category() ) ? get_query_var( 'cat' ) : 0;

	$r = wp_parse_args( $args, $defaults );
	$option_none_value = $r['option_none_value'];

	if ( ! isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
		$r['pad_counts'] = true;
	}

	$tab_index = $r['tab_index'];

	$tab_index_attribute = '';
	if ( (int) $tab_index > 0 ) {
		$tab_index_attribute = " tabindex=\"$tab_index\"";
	}

	// Avoid clashes with the 'name' param of get_terms().
	$get_terms_args = $r;
	unset( $get_terms_args['name'] );
	$categories = get_terms( $r['taxonomy'], $get_terms_args );

	$name = esc_attr( $r['name'] );
	$class = esc_attr( $r['class'] );
	$id = $r['id'] ? esc_attr( $r['id'] ) : $name;

	if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
		$output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";
	} else {
		$output = '';
	}
	if ( empty( $categories ) && ! $r['hide_if_empty'] && ! empty( $r['show_option_none'] ) ) {

		/**
		 * Filter a taxonomy drop-down display element.
		 *
		 * A variety of taxonomy drop-down display elements can be modified
		 * just prior to display via this filter. Filterable arguments include
		 * 'show_option_none', 'show_option_all', and various forms of the
		 * term name.
		 *
		 * @since 1.2.0
		 *
		 * @see wp_dropdown_categories()
		 *
		 * @param string $element Taxonomy element to list.
		 */
		$show_option_none = apply_filters( 'list_cats', $r['show_option_none'] );
		$output .= "\t<option value='" . esc_attr( $option_none_value ) . "' selected='selected'>$show_option_none</option>\n";
	}

	if ( ! empty( $categories ) ) {

		if ( $r['show_option_all'] ) {

			/** This filter is documented in wp-includes/category-template.php */
			$show_option_all = apply_filters( 'list_cats', $r['show_option_all'] );
			$selected = ( '0' === strval($r['selected']) ) ? " selected='selected'" : '';
			$output .= "\t<option value='0'$selected>$show_option_all</option>\n";
		}

		if ( $r['show_option_none'] ) {

			/** This filter is documented in wp-includes/category-template.php */
			$show_option_none = apply_filters( 'list_cats', $r['show_option_none'] );
			$selected = selected( $option_none_value, $r['selected'], false );
			$output .= "\t<option value='" . esc_attr( $option_none_value ) . "'$selected>$show_option_none</option>\n";
		}

		if ( $r['hierarchical'] ) {
			$depth = $r['depth'];  // Walk the full depth.
		} else {
			$depth = -1; // Flat.
		}
		$output .= fx_categories_widget_walk_category_dropdown_tree( $categories, $depth, $r );
	}

	if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
		$output .= "</select>\n";
	}
	/**
	 * Filter the taxonomy drop-down output.
	 *
	 * @since 2.1.0
	 *
	 * @param string $output HTML output.
	 * @param array  $r      Arguments used to build the drop-down.
	 */
	$output = apply_filters( 'wp_dropdown_cats', $output, $r );

	if ( $r['echo'] ) {
		echo $output;
	}
	return $output;
}

/**
 * Walker Helper Function
 */
function fx_categories_widget_walk_category_dropdown_tree(){
	$args = func_get_args();
	// the user's options are the third parameter
	if ( empty( $args[2]['walker'] ) || ! ( $args[2]['walker'] instanceof Walker ) ) {
		$walker = new fx_Categories_Widget_Walker_CategoryDropdown;
	} else {
		$walker = $args[2]['walker'];
	}
	return call_user_func_array( array( $walker, 'walk' ), $args );
}

/**
 * Custom Walker Class
 */

/**
 * Create HTML dropdown list of Categories.
 * This is a modified version of Walker_CategoryDropdown Class.
 * The difference is that this function will output the option value using term slug instead of term id.
 * @see wp-includes/class-walker-category-dropdown.php
 * @uses Walker
 */
class fx_Categories_Widget_Walker_CategoryDropdown extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	public $tree_type = 'category';

	/**
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this
	 * @var array
	 */
	public $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int    $depth    Depth of category. Used for padding.
	 * @param array  $args     Uses 'selected', 'show_count', and 'value_field' keys, if they exist.
	 *                         See {@see wp_dropdown_categories()}.
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		$pad = str_repeat('&nbsp;', $depth * 3);

		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters( 'list_cats', $category->name, $category );

		if ( isset( $args['value_field'] ) && isset( $category->{$args['value_field']} ) ) {
			$value_field = $args['value_field'];
		} else {
			$value_field = 'term_id';
		}
		//ccdd($args);

		$output .= "\t<option class=\"level-$depth\" value=\"" . esc_attr( $category->slug ) . "\"";

		/* Selected: Category */
		if( 'category' == $args['taxonomy'] ){
			// Type-juggling causes false matches, so we force everything to a string.
			if ( (string) $category->{$value_field} === (string) $args['selected'] ){
				$output .= ' selected="selected"';
			}
		}
		else{
			if( is_tax( $args['taxonomy'] ) || is_tag() ){
				$queried_object = get_queried_object();
				$c_tax = $queried_object->taxonomy;
				$c_slug = $queried_object->slug;

				if( $c_tax == $args['taxonomy'] && $c_slug == $category->slug ){
					$output .= ' selected="selected"';
				}
			}
		}


		$output .= '>';
		$output .= $pad.$cat_name;
		if ( $args['show_count'] )
			$output .= '&nbsp;&nbsp;('. number_format_i18n( $category->count ) .')';
		$output .= "</option>\n";
	}
}
