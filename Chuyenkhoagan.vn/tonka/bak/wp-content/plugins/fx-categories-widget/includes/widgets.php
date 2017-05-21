<?php
/**
 * Register Widgets
 * @since 0.1.0
**/

/* Register Widgets */
add_action( 'widgets_init', 'fx_cat_widget_register_widgets' );

/**
 * Register Widget
 * @uses     register_widget()
 * @since    0.1.0
 */
function fx_cat_widget_register_widgets() {
	register_widget( 'fx_Cat_Widget' );
}


/**
 * Categories Widget with taxonomy drop down option just like Tag Cloud widget.
 * @see wp-includes/widgets/class-wp-widget-categories.php
 * @see wp-includes/widgets/class-wp-widget-tag-cloud.php
 * @since 0.1.0
 */
class fx_Cat_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "A list or dropdown of categories, tags, or taxonomy terms.", 'fx-categories-widget' ) );
		parent::__construct( 'widget_fx_categories', __( 'Categories +','fx-categories-widget' ), $widget_ops);
	}

	/**
	 * Outputs the content for the current Categories widget instance.
	 * @since 0.1.0
	 * @access public
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Categories widget instance.
	 */
	public function widget( $args, $instance ) {

		/* Widget ID */
		$wid = $args['widget_id'];
		$cwid = str_replace( "-", "_", $args['widget_id'] );

		/* === OPEN SESAME === */
		echo $args['before_widget'];

		/* Display Widget Title */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		/* Taxonomy Selected */
		$taxonomy = $this->_get_current_taxonomy($instance);

		/* Dropdown? */
		$dropdown = ! empty( $instance['dropdown'] ) ? '1' : '0';
		if( $dropdown ){

			/* Get Taxonomy Name */
			$tax_obj = get_taxonomy( $taxonomy );
			$name = '';
			if( $tax_obj && isset( $tax_obj->labels->singular_name ) ){
				$name = $tax_obj->labels->singular_name;
			}

			/* Display Drop Down Taxonomies */
			$tax_args = array(
				'id'                => $wid . '_dd',
				'taxonomy'          => $taxonomy,
				'orderby'           => 'name',
				'show_option_none'  => esc_attr( sprintf( __( 'Select %s', 'fx-categories-widget' ), $name ) ),
				'show_count'        => ! empty( $instance['count'] ) ? '1' : '0',
				'hierarchical'      => ! empty( $instance['hierarchical'] ) ? '1' : '0',
				//'echo'              => 0,
			);
			if( 'category' == $taxonomy ){
				wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $tax_args ) );
			}
			else{
				fx_cat_widget_dropdown_categories( apply_filters( 'fx_cat_widget_dropdown_args', $tax_args ) );
			}

			/* Current taxonomy to build URL Query. */
			if( 'category' == $taxonomy ) $taxonomy = 'cat';
			if( 'post_tag' == $taxonomy ) $taxonomy = 'tag';
?>

<script type='text/javascript'>
/* <![CDATA[ */
	var <?php echo $cwid; ?>_dropdown = document.getElementById("<?php echo $wid; ?>_dd");
	function <?php echo $cwid; ?>_onTaxChange() {
		if ( <?php echo $cwid; ?>_dropdown.options[<?php echo $cwid; ?>_dropdown.selectedIndex].value != -1 ) {
			location.href = "<?php echo home_url(); ?>/?<?php echo $taxonomy; ?>="+<?php echo $cwid; ?>_dropdown.options[<?php echo $cwid; ?>_dropdown.selectedIndex].value;
		}
	}
	<?php echo $cwid; ?>_dropdown.onchange = <?php echo $cwid; ?>_onTaxChange;
/* ]]> */
</script>

<?php
		}
		/* Simple List (No Drop Down) */
		else{
			/* Display Drop Down Taxonomies */
			$tax_args = array(
				'id'                => $wid . '_dd',
				'taxonomy'          => $taxonomy,
				'orderby'           => 'name',
				'show_count'        => ! empty( $instance['count'] ) ? '1' : '0',
				'hierarchical'      => ! empty( $instance['hierarchical'] ) ? '1' : '0',
				'title_li'          => '',
			);
			?>
				<ul>
					<?php wp_list_categories( apply_filters( 'widget_categories_args', $tax_args ) ); ?>
				</ul>
			<?php
		}

		/* === CLOSE SESAME === */
		echo $args['after_widget'];

	} // end widget function

	/**
	 * === SAVE WIDGET OPTION ===
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
		return $instance;
	}

	/**
	 * === WIDGET OPTION / FORM ===
	 */
	public function form( $instance ) {

		/* Defaults */
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$current_taxonomy = $this->_get_current_taxonomy($instance);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:','fx-categories-widget' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:','fx-categories-widget') ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
		<?php foreach ( get_taxonomies() as $taxonomy ){
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) ){
					continue;
				}
				?>
				<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
		<?php } // end foreach ?>
		</select></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown','fx-categories-widget' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts','fx-categories-widget' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy','fx-categories-widget' ); ?></label></p>
<?php
	}

	/**
	 * === GET CURRENT TAXONOMY HELPER FUNCTION ===
	 */
	public function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) ){
			return $instance['taxonomy'];
		}
		return 'category';
	}
}


