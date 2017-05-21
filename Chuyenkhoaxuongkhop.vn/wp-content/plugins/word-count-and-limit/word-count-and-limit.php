<?php
/*
Plugin Name: Word Count and Limit
Text Domain: word-count-and-limit
Plugin URI: https://wordpress.org/plugins/word-count-and-limit/
Description: Dynamically counts the words in edit post window and limit the character count if needed for one or more user roles.
Author: Jojaba
Version: 1.4.1
Author URI: http://perso.jojaba.fr/
*/

/**
 * Language init
 */
function wpwcl_lang_init() {
 load_plugin_textdomain( 'word-count-and-limit', false, basename(dirname(__FILE__)) );
}
add_action('plugins_loaded', 'wpwcl_lang_init');

add_action( 'admin_menu', 'wpwcl_options_add_page' );
/**
 * Load up the options page
 */
if( !function_exists('wpwcl_options_add_page'))  {
	function wpwcl_options_add_page() {
		add_options_page(
			__( 'Word Count and Limit', 'word-count-and-limit' ), // Title for the page
			__( 'Word Count and Limit', 'word-count-and-limit' ), //  Page name in admin menu
			'manage_options', //  Minimum role required to see the page
			'wpwcl_options_page', // unique identifier
			'wpwcl_options_do_page'  // name of function to display the page
		);
		add_action( 'admin_init', 'wpwcl_options_settings' );
	}
}
/**
 * Create the options page
 */

if( !function_exists('wpwcl_options_do_page'))  {
	function wpwcl_options_do_page() { ?>

<div class="wrap">

        <h2><?php _e( 'Word Count and Limit Options', 'word-count-and-limit' ) ?></h2>

        <?php
        /*** To debug, here we can print the plugin options **/
        /*
        echo '<pre>';
        $options = get_option( 'wpwcl_settings_options' );
        print_r($options);
        echo '</pre>';
        */
         ?>

        <form method="post" action="options.php">
        		<?php settings_fields( 'wpwcl_settings_options' ); ?>
		  	<?php do_settings_sections('wpwcl_setting_section'); ?>
		  	<p><input class="button-primary"  name="Submit" type="submit" value="<?php esc_attr_e(__('Save Changes', 'word-count-and-limit')); ?>" /></p>
        </form>
        <script>
        jQuery(document).ready(function() {

          /* Toggle infos when switching limit or not */
          if (jQuery("#limit_true").prop("checked")) {
            jQuery("#impacted_users_option, #impacted_post_types_option, #limited_item_char, #maxchars_option, #warning_option, #maxwords_option, #words_warning_option, #warning_message_option, #words_warning_message_option").parent().parent().show();
          }
          else {
            jQuery("#impacted_users_option, #impacted_post_types_option, #limited_item_char, #maxchars_option, #warning_option, #maxwords_option, #words_warning_option, #warning_message_option, #words_warning_message_option").parent().parent().hide();
          }
          jQuery("#limit_true, #limit_false").on("change", function() {
              if (jQuery("#limit_true").prop("checked")) {
                jQuery("#impacted_users_option, #impacted_post_types_option, #limited_item_char").parent().parent().fadeIn();
                if (jQuery("#limited_item_char").prop("checked")) {
                  jQuery("#maxchars_option, #warning_option, #warning_message_option").parent().parent().fadeIn();
                  jQuery("#maxwrds_option, #words_warning_option, #words_warning_message_option").parent().parent().fadeOut();
                } else {
                  jQuery("#maxchars_option, #warning_option, #warning_message_option").parent().parent().fadeOut();
                  jQuery("#maxwrds_option, #words_warning_option, #words_warning_message_option").parent().parent().fadeIn();
                }
              }
              else {
                jQuery("#impacted_users_option, #impacted_post_types_option, #limited_item_char, #maxchars_option, #warning_option, #maxwords_option, #words_warning_option, #warning_message_option, #words_warning_message_option").parent().parent().fadeOut();
              }
          });

          /* Toggle infos when switching char or word limit */
          if (jQuery("#limited_item_char").prop("checked") && jQuery("#limit_true").prop("checked")) {
              jQuery("#maxchars_option, #warning_option, #warning_message_option").parent().parent().show();
              jQuery("#maxwords_option, #words_warning_option, #words_warning_message_option").parent().parent().hide();
          }
          else if(jQuery("#limit_true").prop("checked")) {
            jQuery("#maxchars_option, #warning_option, #warning_message_option").parent().parent().hide();
            jQuery("#maxwords_option, #words_warning_option, #words_warning_message_option").parent().parent().show();
          }
          jQuery("#limited_item_char, #limited_item_word").on("change", function() {
              if (jQuery("#limited_item_char").prop("checked")) {
                  jQuery("#maxchars_option, #warning_option, #warning_message_option").parent().parent().fadeIn();
                  jQuery("#maxwords_option, #words_warning_option, #words_warning_message_option").parent().parent().fadeOut();
              }
              else {
                jQuery("#maxchars_option, #warning_option, #warning_message_option").parent().parent().fadeOut();
                jQuery("#maxwords_option, #words_warning_option, #words_warning_message_option").parent().parent().fadeIn();
              }
          });
        });
        </script>
</div>

<?php
	} // end wpc_options_do_page
}

/**
 * Init plugin options to white list our options
 */
if( !function_exists('wpwcl_options_settings'))  {
	function wpwcl_options_settings(){
		/* Register wpwcl settings. */
		register_setting(
			'wpwcl_settings_options',  //$option_group , A settings group name. Must exist prior to the register_setting call. This must match what's called in settings_fields()
			'wpwcl_settings_options', // $option_name The name of an option to sanitize and save.
			'wpwcl_options_validate' // $sanitize_callback  A callback function that sanitizes the option's value.
    );

		/** Add a section **/
		add_settings_section(
			'wpwcl_option_main', //  section name unique ID
			'&nbsp;', // Title or name of the section (to be output on the page), you can leave nbsp here if not wished to display
			'wpwcl_option_section_text',  // callback to display the content of the section itself
			'wpwcl_setting_section' // The page name. This needs to match the text we gave to the do_settings_sections function call
    );

		/** Register each option **/
		add_settings_field(
			'ask_limitation_option',
			__( 'Set a limit?', 'word-count-and-limit' ),
			'wpwcl_func_ask_limitation_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

		add_settings_field(
			'impacted_users_option',
			__( 'Impacted users', 'word-count-and-limit' ),
			'wpwcl_func_impacted_users_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

    add_settings_field(
			'impacted_post_types_option',
			__( 'Impacted post types', 'word-count-and-limit' ),
			'wpwcl_func_impacted_post_types_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

    add_settings_field(
			'limited_item_option',
			__( 'What should be limited', 'word-count-and-limit' ),
			'wpwcl_func_limited_item_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

		add_settings_field(
			'maxchars_option',
			__( 'Max characters allowed', 'word-count-and-limit' ),
			'wpwcl_func_maxchars_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

		add_settings_field(
			'warning_option',
			__( 'Warning for characters count', 'word-count-and-limit' ),
			'wpwcl_func_warning_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

    add_settings_field(
			'warning_message_option',
			__( 'Warning message for characters limitation', 'word-count-and-limit' ),
			'wpwcl_func_warning_message_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

    add_settings_field(
			'maxwords_option',
			__( 'Max words allowed', 'word-count-and-limit' ),
			'wpwcl_func_maxwords_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

		add_settings_field(
			'words_warning_option',
			__( 'Warning for words count', 'word-count-and-limit' ),
			'wpwcl_func_words_warning_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

    add_settings_field(
			'words_warning_message_option',
			__( 'Warning message for words limitation', 'word-count-and-limit' ),
			'wpwcl_func_words_warning_message_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

		add_settings_field(
			'format_option',
			__( 'Output Format', 'word-count-and-limit' ),
			'wpwcl_func_format_option',
			'wpwcl_setting_section',
			'wpwcl_option_main'
    );

    add_settings_field(
			'contributor_message_option',  //$id a unique id for the field
			__( 'Contributor message', 'word-count-and-limit' ), // the title for the field
			'wpwcl_func_contributor_message_option',  // the function callback, to display the input box
			'wpwcl_setting_section',  // the page name that this is attached to (same as the do_settings_sections function call).
			'wpwcl_option_main' // the id of the settings section that this goes into (same as the first argument to add_settings_section).
        );
    }
}

/** the theme section output**/
if( !function_exists('wpwcl_option_section_text'))  {
	function wpwcl_option_section_text(){
	echo '<p>'.__( 'Here you can set the options of WP Word Count and Limit plugin. If you set a limit, the author of the post will be warned if he exceeds the character/word count limit by changing the characters/words display color (<span style="color: darkorange">orange</span>: near the limit, <span style="color: red">red</span>: over the limit). If he tries to submit his post as it exceeds the character limit, he will be prompted a message while and submission will be refused.', 'word-count-and-limit' ).'</p>';
	}
}

/** The Limitation (yes or no) radio buttons **/
if( !function_exists('wpwcl_func_ask_limitation_option'))  {
	function wpwcl_func_ask_limitation_option() {
		 /* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$ask_limitation_option = (isset($options['ask_limitation_option'])) ? $options['ask_limitation_option'] : 0 ;

		/* Echo the field. */ ?>
		<label for="limit_true" > <?php _e( 'Yes', 'word-count-and-limit' ); ?></label>
		<input type="radio" <?php if ($ask_limitation_option == 1) echo'checked="checked"' ; ?> id="limit_true" name="wpwcl_settings_options[ask_limitation_option]" value="1" />
		<label for="limit_false" > <?php _e( 'No', 'word-count-and-limit' ); ?></label>
		<input type="radio" id="limit_false" <?php if ($ask_limitation_option == 0) echo'checked="checked"' ; ?> name="wpwcl_settings_options[ask_limitation_option]" value="0" />
    <?php }
}

/** The Impacted users Checkboxes **/
if( !function_exists('wpwcl_func_impacted_users_option'))  {
	function wpwcl_func_impacted_users_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$impacted_users_option =  (isset($options['impacted_users_option']) && is_array($options['impacted_users_option'])) ? $options['impacted_users_option'] : array('contributor');
		/* Echo the field. */ ?>
		<div id="impacted_users_option">
		<input type="checkbox" id="impacted_users_option_contributor" name="wpwcl_settings_options[impacted_users_option][]" value="contributor"<?php if (in_array('contributor', $impacted_users_option)) echo ' checked'; ?> /> <?php _e( 'Contributors', 'word-count-and-limit' ); ?><br>
		<input type="checkbox" id="impacted_users_option_author" name="wpwcl_settings_options[impacted_users_option][]" value="author"<?php if (in_array('author', $impacted_users_option)) echo ' checked'; ?> /> <?php _e( 'Authors', 'word-count-and-limit' ); ?><br>
		<input type="checkbox" id="impacted_users_option_editor" name="wpwcl_settings_options[impacted_users_option][]" value="editor"<?php if (in_array('editor', $impacted_users_option)) echo ' checked'; ?> /> <?php _e( 'Editors', 'word-count-and-limit' ); ?><br>
		<input type="checkbox" id="impacted_users_option" name="wpwcl_settings_options[impacted_users_option][]" value="administrator"<?php if (in_array('administrator', $impacted_users_option)) echo ' checked'; ?> /> <?php _e( 'Administrators', 'word-count-and-limit' ); ?><br>
		<p class="description">
		    <?php _e( 'The users that should be limited (multiple users role possible).', 'word-count-and-limit' ); ?>
        </p>
        </div>
	<?php }
}

/** The Impacted post types Checkboxes **/
if( !function_exists('wpwcl_func_impacted_post_types_option'))  {
	function wpwcl_func_impacted_post_types_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$impacted_post_types_option =  (isset($options['impacted_post_types_option']) && is_array($options['impacted_post_types_option'])) ? $options['impacted_post_types_option'] : array('post');
		/* Echo the field. */ ?>
		<div id="impacted_post_types_option">
		<input type="checkbox" id="impacted_post_types_option_contributor" name="wpwcl_settings_options[impacted_post_types_option][]" value="post"<?php if (in_array('post', $impacted_post_types_option)) echo ' checked'; ?> /> post<br>
		<input type="checkbox" id="impacted_post_types_option_author" name="wpwcl_settings_options[impacted_post_types_option][]" value="page"<?php if (in_array('page', $impacted_post_types_option)) echo ' checked'; ?> /> page<br>
		<?php /* listing of public custom post types */
		    $custom_post_types = get_post_types( array('public' => true, '_builtin' => false) );
            if (!empty($custom_post_types)) {
                foreach ( $custom_post_types  as $custom_post_type ) { ?>
                    <input type="checkbox" id="impacted_post_type_option_author" name="wpwcl_settings_options[impacted_post_types_option][]" value="<?php echo $custom_post_type ?>"<?php if (in_array($custom_post_type, $impacted_post_types_option)) echo ' checked'; ?> /> <?php echo $custom_post_type ?><br>
                <?php } // end foreach
            } // end if post_types
        ?>
		<p class="description">
		    <?php _e( 'The post types that should be limited.', 'word-count-and-limit' ); ?>
        </p>
        </div>
	<?php }
}

/** The limited item radio buttons **/
if( !function_exists('wpwcl_func_limited_item_option'))  {
	function wpwcl_func_limited_item_option() {
		 /* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$limited_item_option = (isset($options['limited_item_option'])) ? $options['limited_item_option'] : 'char';

		/* Echo the field. */ ?>
		<label for="limited_item_char" > <?php _e( 'Characters', 'word-count-and-limit' ); ?></label>
		<input type="radio" <?php if ($limited_item_option == 'char') echo'checked="checked"' ; ?> id="limited_item_char" name="wpwcl_settings_options[limited_item_option]" value="char" />
		<label for="limited_item_word" > <?php _e( 'Words', 'word-count-and-limit' ); ?></label>
		<input type="radio" id="limited_item_char" <?php if ($limited_item_option == 'word') echo'checked="checked"' ; ?> name="wpwcl_settings_options[limited_item_option]" value="word" />
    <?php }
}

/* ****************** */
/* For the characters */
/* ****************** */

/** The Max characters field **/
if( !function_exists('wpwcl_func_maxchars_option'))  {
	function wpwcl_func_maxchars_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$maxchars_option = (isset($options['maxchars_option']) && $options['maxchars_option'] != '') ? $options['maxchars_option'] : '1000';
		/* Echo the field. */ ?>
		<input type="number" id="maxchars_option" name="wpwcl_settings_options[maxchars_option]" value="<?php echo esc_attr($maxchars_option); ?>" />
		<p class="description">
		    <?php _e( 'The max count of characters the author of a post can write.', 'word-count-and-limit' ); ?>
        </p>
	<?php }
}

/** The warning field */
if( !function_exists('wpwcl_func_warning_option'))  {
	function wpwcl_func_warning_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$warning_option = (isset($options['warning_option']) && $options['warning_option']  != '') ? $options['warning_option'] : '100';
		/* Echo the field. */ ?>
		<input type="number" id="warning_option" name="wpwcl_settings_options[warning_option]" value="<?php echo esc_attr($warning_option); ?>" />
		<p class="description">
		    <?php _e( 'The number of characters before the max value the warning is fired.', 'word-count-and-limit' ); ?>
        </p>
	<?php }
}

/** The warning message when counting characters field **/
if( !function_exists('wpwcl_func_warning_message_option'))  {
	function wpwcl_func_warning_message_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$warning_message_option = (isset($options['warning_message_option']) && $options['warning_message_option'] != '') ? $options['warning_message_option'] : __( 'Sorry, but you exceeded the characters limit!', 'word-count-and-limit');
		/* Echo the field. */ ?>
		<input style="width: 95%;" type="text" id="warning_message_option" name="wpwcl_settings_options[warning_message_option]" value="<?php echo esc_attr($warning_message_option); ?>" />
		<p class="description">
		    <?php _e( 'The message that will display when user exceeded the allowed characters count (no HTML tags allowed).', 'word-count-and-limit' ) ?>
        </p>
    <?php }
}

/* ************* */
/* For the words */
/* ************* */

/** The Max words field **/
if( !function_exists('wpwcl_func_maxwords_option'))  {
	function wpwcl_func_maxwords_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$maxwords_option = (isset($options['maxwords_option']) && $options['maxwords_option'] != '') ? $options['maxwords_option'] : '500';
		/* Echo the field. */ ?>
		<input type="number" id="maxwords_option" name="wpwcl_settings_options[maxwords_option]" value="<?php echo esc_attr($maxwords_option); ?>" />
		<p class="description">
		    <?php _e( 'The max count of words the author of a post can write.', 'word-count-and-limit' ); ?>
        </p>
	<?php }
}

/** The words limit warning field */
if( !function_exists('wpwcl_func_words_warning_option'))  {
	function wpwcl_func_words_warning_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$words_warning_option = (isset($options['words_warning_option']) && $options['words_warning_option']  != '') ? $options['words_warning_option'] : '20';
		/* Echo the field. */ ?>
		<input type="number" id="words_warning_option" name="wpwcl_settings_options[words_warning_option]" value="<?php echo esc_attr($words_warning_option); ?>" />
		<p class="description">
		    <?php _e( 'The number of words before the max value the warning is fired.', 'word-count-and-limit' ); ?>
        </p>
	<?php }
}

/** The warning message when counting words field **/
if( !function_exists('wpwcl_func_words_warning_message_option'))  {
	function wpwcl_func_words_warning_message_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$words_warning_message_option = (isset($options['words_warning_message_option']) && $options['words_warning_message_option'] != '') ? $options['words_warning_message_option'] : __( 'Sorry, but you exceeded the words limit!', 'word-count-and-limit');
		/* Echo the field. */ ?>
		<input style="width: 95%;" type="text" id="words_warning_message_option" name="wpwcl_settings_options[words_warning_message_option]" value="<?php echo esc_attr($words_warning_message_option); ?>" />
		<p class="description">
		    <?php _e( 'The message that will display when user exceeded the allowed words count (no HTML tags allowed).', 'word-count-and-limit' ) ?>
        </p>
    <?php }
}

/* ************ */
/* Format field */
/* ************ */

/** The format field **/
if( !function_exists('wpwcl_func_format_option'))  {
	function wpwcl_func_format_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$format_option = (isset($options['format_option']) && $options['format_option'] != '') ? $options['format_option'] : '#chars characters | #words words';
		/* Echo the field. */ ?>
		<input type="text" style="width: 40%;"  id="format_option" name="wpwcl_settings_options[format_option]" value="<?php echo esc_attr($format_option); ?>" />
				<p class="description"><?php _e( 'You can define the output display using the following placeholders:', 'word-count-and-limit' ); ?></p>
        <ul style="margin: 0; padding: 0.3rem 1rem;">
          <li><?php _e( 'When <b>no limit set</b>: <code>#chars</code> (the number of characters), <code>#words</code> (the number of words)', 'word-count-and-limit'); ?></li>
          <li><?php _e( 'When <b>limited characters</b>: <code>#chars</code> (the number of characters), <code>#words</code> (the number of words),  <code>#maxChars</code> (the max characters allowed), <code>#leftChars</code> (the remaining characters)', 'word-count-and-limit'); ?></li>
          <li><?php _e( 'When <b>limited words</b>: <code>#chars</code> (the number of characters), <code>#words</code> (the number of words),  <code>#maxWords</code> (the max words allowed), <code>#leftWords</code> (the remaining words)', 'word-count-and-limit'); ?></li>
        </ul>
        <p class="description"><?php echo __( 'The following HTML tags are allowed: ', 'word-count-and-limit' ).'<code>'.allowed_tags().'</code>'; ?></p>

        <p class="description" style="margin-top: 1rem;"><?php _e( 'The format output in action:', 'word-count-and-limit' ); ?></p>
        <ul style="margin: 0; padding: 0.3rem 1rem;">
          <li><?php _e( 'Regular use (<b>without limitation</b>): <code>&lt;b&gt;#chars&lt;/b&gt; characters | &lt;b&gt;#words&lt;/b&gt; words</code> will display <q style="padding: 2px 4px; border: #e0e0e0 1px solid; background: #f7f7f7;"><b>123</b> characters | <b>36</b> words.</q>.', 'word-count-and-limit' ) ?></li>
          <li><?php _e( 'Use when <b>characters limit set</b>: <code>#chars/#maxChars &lt;i&gt;characters&lt;/i&gt;, #leftChars &lt;i&gt;left&lt;/i&gt; | #words &lt;i&gt;words&lt;/i&gt;</code> will display <q style="padding: 2px 4px; border: #e0e0e0 1px solid; background: #f7f7f7;">123/250 <i>characters</i>, 127 <i>left</i> | 36 <i>words</i></q> or <q style="padding: 2px 4px; border: #e0e0e0 1px solid; background: #f7f7f7; color: red;">256/250 <i>characters</i>, 0 <i>left</i> | 68 <i>words</i></q>.', 'word-count-and-limit' ) ?></li>
        </ul>
      </div>
    <?php }
}

/** The contributor message field **/
if( !function_exists('wpwcl_func_contributor_message_option'))  {
	function wpwcl_func_contributor_message_option(){
	/* Get the option value from the database. */
		$options = get_option( 'wpwcl_settings_options' );
		$contributor_message_option = (isset($options['contributor_message_option']) && $options['contributor_message_option'] != '') ? $options['contributor_message_option'] : __( 'Your Post has been submitted to the editorial team for validation and publish. Thanks for your contribution!', 'word-count-and-limit');
		/* Echo the field. */ ?>
		<input style="width: 95%;" type="text" id="contributor_message_option" name="wpwcl_settings_options[contributor_message_option]" value="<?php echo esc_attr($contributor_message_option); ?>" />
		<p class="description">
		    <?php _e( 'The message that will display when a contributor submit a post (no HTML tags allowed).', 'word-count-and-limit' ) ?>
        </p>
    <?php }
}


/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
if( !function_exists('wpwcl_options_validate'))  {
	function wpwcl_options_validate( $input ) {
	$options = get_option( 'wpwcl_settings_options' );

	/** Radio buttons (ask limit) validation **/
	$options['ask_limitation_option'] = $input['ask_limitation_option'];

	/** Impacted Users	validation **/
	$options['impacted_users_option'] = $input['impacted_users_option'];

	/** Impacted post types	validation **/
	$options['impacted_post_types_option'] = $input['impacted_post_types_option'];

	/** Radio buttons (char or word limitation) validation **/
  $options['limited_item_option'] = $input['limited_item_option'];

	/** maxchars number validation */
	$options['maxchars_option'] = wp_filter_nohtml_kses( intval( $input['maxchars_option'] ) );

	/** warning number validation */
	$options['warning_option'] = wp_filter_nohtml_kses( intval( $input['warning_option'] ) );

  /** maxwords number validation */
	$options['maxwords_option'] = wp_filter_nohtml_kses( intval( $input['maxwords_option'] ) );

	/** words warning number validation */
	$options['words_warning_option'] = wp_filter_nohtml_kses( intval( $input['words_warning_option'] ) );

	/** clean text field, HTML allowed for the format */
	$options['format_option'] = wp_filter_kses($input['format_option'] );

	/** warning message validation */
	$options['warning_message_option'] = wp_filter_nohtml_kses( $input['warning_message_option'] );

  /** words warning message validation */
	$options['words_warning_message_option'] = wp_filter_nohtml_kses( $input['words_warning_message_option'] );

	/** contributor message validation */
	$options['contributor_message_option'] = wp_filter_nohtml_kses( $input['contributor_message_option'] );

	return $options;
	}
}

/**
 * Adds the script after tinymce script
 */
if (!function_exists('wpwcl_scripts')) {
    function wpwcl_scripts($post) {
    // Retrieving settings values
    $options = get_option( 'wpwcl_settings_options' );
    $set_limit = (isset($options['ask_limitation_option']) && $options['ask_limitation_option'] == 1) ? 1 : 0;
    $imp_user = (isset($options['impacted_users_option']) && is_array($options['impacted_users_option'])) ? $options['impacted_users_option'] : array('contributor'); // This is an array of roles
    $imp_p_types = (isset($options['impacted_post_types_option']) && is_array($options['impacted_post_types_option'])) ? $options['impacted_post_types_option'] : array('post'); // This is an array of post types
    $limited_item = (isset($options['limited_item_option'])) ? $options['limited_item_option'] : 'char'; // char or word
    $charmax = (isset($options['maxchars_option']) && $options['maxchars_option'] > 0) ? $options['maxchars_option'] : 1000;
    $chars_warn = (isset($options['warning_option']) && $options['warning_option'] > 0) ? $options['warning_option'] : 100;
    $chars_w_message = (isset($options['warning_message_option']) && $options['warning_message_option'] != '') ? $options['warning_message_option'] : __( 'Sorry, but you exceeded the characters limit!', 'word-count-and-limit');
    $wordmax = (isset($options['maxwords_option']) && $options['maxwords_option'] > 0) ? $options['maxwords_option'] : 500;
    $words_warn = (isset($options['words_warning_option']) && $options['words_warning_option'] > 0) ? $options['words_warning_option'] : 20;
    $words_w_message = (isset($options['words_warning_message_option']) && $options['words_warning_message_option'] != '') ? $options['words_warning_message_option'] : __( 'Sorry, but you exceeded the words limit!', 'word-count-and-limit');
    $format = (isset($options['format_option']) && $options['format_option'] != '') ? $options['format_option'] : '#chars characters | #words words';
    $c_message = (isset($options['contributor_message_option']) && $options['contributor_message_option'] != '') ? $options['contributor_message_option'] : __( 'Your Post has been submitted to the editorial team for validation and publish. Thanks for your contribution!', 'word-count-and-limit');
    // post type fetching
    $p_id = get_the_ID();
    $post_type = get_post_type($p_id);
    // Only if no limit set or if the post type is in impacted post types
    if ($set_limit == 0 || ($set_limit > 0 && in_array($post_type, $imp_p_types))) :

    // Looking if user is impacted by limitation
    $c_user = wp_get_current_user();
		$user_r = $c_user->roles; // User roles array
		$user_role = $user_r[0];
		$is_impacted = count(array_intersect($user_r, $imp_user)); // > 0 if impacted
    echo "<script>\n";
    echo "jQuery(window).load(function() {\n";
    // This counter doesn't work if the textarea field is first opened (I don't know why...)
    if (version_compare ( get_bloginfo('version'), '4.3') < 0) {
      echo "switchEditors.switchto(jQuery('#content-tmce').get(0));";
    } else {
      echo "switchEditors.go('content', 'tmce');";
    }

    // Printing the scripts
    echo "/* The textarea and the iframe */
		var textarea_cont = jQuery('#content');
		var wysiwyg_cont = jQuery('#content_ifr').contents();

		/* Variables Initial define */
		var setLimit = ".$set_limit."; // Limit = 1, no limit = 0
    var limitedItem = '".$limited_item."'; // char or word
		var maxCharacters = ".$charmax."; // max characters count if limit is set
		var charWarning = ".$chars_warn."; // number of characters before limit where the user is warned
    var maxWords = ".$wordmax."; // max words count if limit is set
		var wordWarning = ".$words_warn."; // number of words before limit where the user is warned
		var formatString = '".$format."'; // The syntax used to display the output
		var charInfo = jQuery('#wp-word-count'); // Output container, same as Default WP Word count
		var contentLength = 0;
    var numChars = 0;
		var numCharsLeft = 0;
		var numWords = 0;
    var numWordsLeft = 0;

		/* The events on each container */
		textarea_cont.on('keyup', function(event){getTheWpwclCount('textarea');})
                  .on('paste', function(event){setTimeout(function(){getTheWpwclCount('textarea');}, 10);});

    wysiwyg_cont.on('keyup', 'body', function(event){getTheWpwclCount('wysiwig');})
                .on('paste', 'body', function(event){setTimeout(function(){getTheWpwclCount('wysiwig');}, 10);});


		/* Function to find and display the characters count */
        function getTheWpwclCount(cont){
			charInfo.html(wpwclFormatDisplay(cont));
		}

		/* Counting the characters and the words */
		function wpwclFormatDisplay(cont) {
		    if (cont == 'textarea') {
		        // Textarea case
		        var raw_content = textarea_cont.val();
		    } else {
            // WysiWyg case
            var raw_content = jQuery('#content_ifr').contents().find('body').html();
        }

        /* Characters count */
        var content = raw_content.replace(/(\\r\\n)+|\\n+|\\r+|\s+|(&nbsp;)+/gm,' '); // Replace newline, tabulations, &nbsp; by space to preserve word count
        content = content.replace(/<[^>]+>/ig,''); // Remove HTML tags
        content = content.replace(/(&lt;)[^(\&gt;)]+(\&gt;)/ig,''); // Remove HTML tags (when entities)
        content = content.replace(/\[[^\]]+\]/ig,''); // Remove shortcodes
	      numChars = content.length;

        /* Words count */
        // Cleaning and splitting wordstring (tags and shortcodes are already stripped)
  			var rawContent = content;
  			var cleanedContent = rawContent.replace(/[\.,:!\?;\)\]…\"]+/gi, ' '); //Replacing ending ponctuation with spaces to get right word number.
  			var cleanedContent = cleanedContent.replace(/\s+/ig,' ') // Multiple spaces case (after punctuation replacement) replaced by one space
  			var splitString = cleanedContent.split(' ');
  			// Word Count defining
  			numWords = splitString.length - 1;

        /* Treatment if limit set (change color by status) */
        if(setLimit > 0){
          if (limitedItem == 'char') {
            /* Case of Characters limitation */
            if (numChars <= maxCharacters - charWarning)
              charInfo.css('color', 'inherit');
            else if (numChars <= maxCharacters && contentLength >= maxCharacters - charWarning && ".$is_impacted." > 0)
              charInfo.css('color', 'orange');
            else if(numChars > maxCharacters && ".$is_impacted." > 0)
              charInfo.css('color', 'red');
            numCharsLeft = (maxCharacters - numChars > 0) ? maxCharacters - numChars : 0;
          }
          else {
            /* Case of words limitation */
            if (numWords <= maxWords - wordWarning)
              charInfo.css('color', 'inherit');
            else if (numWords <= maxWords && numWords >= maxWords - wordWarning && ".$is_impacted." > 0)
              charInfo.css('color', 'orange');
            else if(numWords > maxWords && ".$is_impacted." > 0)
              charInfo.css('color', 'red');
            numWordsLeft = (maxWords - numWords > 0) ? maxWords - numWords : 0;
          }
        }

        /* Output the result */
        var output = formatString;
		    output = output.replace(/#input|#chars/gi, numChars); // #input for backward compatibility
			  output = output.replace(/#words/gi, numWords);
       //When no limit set, #maxChars, #leftChars, #maxWords, #leftWords cannot be substituted.
			if(setLimit > 0){
        if (limitedItem == 'char') {
          /* Chararacters case */
				  output = output.replace(/#max|#maxChars/gi, maxCharacters); // #max for backward compatibility
				  output = output.replace(/#left|#leftChars/gi, numCharsLeft);
        } else {
          /* Words case */
				  output = output.replace(/#maxWords/gi, maxWords);
				  output = output.replace(/#leftWords/gi, numWordsLeft);
        }
			}
			return output;
    }"."\n";

		// Launching word count on load
    echo "getTheWpwclCount('wysiwig');"."\n";


		if ($set_limit > 0 && $is_impacted > 0) {
      $w_message = ($limited_item == 'char') ? $chars_w_message : $words_w_message;
      echo "jQuery('input#publish').on('click', function(e) {
        if ((limitedItem == 'char' && numChars > maxCharacters) || (limitedItem == 'word' && numWords > maxWords)) {

                /* Refuse saving if too many characters or words only for the defined users */
                e.preventDefault();
                alert('$w_message');
            }
            else if ('$user_role' == 'contributor') {
                /* Message for contributor */
                alert('$c_message');
            }
          });\n";
        } // End if limit set and user must be impacted

        echo "});\n"; // End jQuery handling
        echo "</script>\n";
    endif; // End if post-type = post
    }
add_action( 'after_wp_tiny_mce', 'wpwcl_scripts');
}

/**
 * Function to avoid post save if characters limit is reached and JS deactivated
 */
 if (!function_exists('wpwcl_maxreached')) {
    function wpwcl_maxreached(){
        // Get some options values
        $options = get_option( 'wpwcl_settings_options' );
        $setLimit = (isset($options['ask_limitation_option'])) ? $options['ask_limitation_option'] : '0';
        $imp_user = (isset($options['impacted_users_option']) && is_array($options['impacted_users_option'])) ? $options['impacted_users_option'] : array('contributor'); // This is an array of roles
        $limited_item = (isset($options['limited_item_option'])) ? $options['limited_item_option'] : 'char'; // char or word
        $maxchars = (isset($options['maxchars_option']) && $options['maxchars_option'] != '') ? $options['maxchars_option'] : '1000';
        $maxwords = (isset($options['maxwords_option']) && $options['maxwords_option'] != '') ? $options['maxwords_option'] : '500';
        // See if current user belongs to impacted users
        $c_user = wp_get_current_user();
        $user_r = $c_user->roles; // User roles array
        $inters = array_intersect($user_r, $imp_user);
        if ($setLimit == 1 && count($inters) > 0) {
            global $post;
            $content = wp_filter_nohtml_kses($post->post_content);
            if (($limited_item == 'char' && strlen($content) > $maxchars) || ($limited_item == 'word' && str_word_count($content) > $maxwords))
                wp_die( 'Sorry, too much characters or words in this post!' );
        }
    }
    add_action('draft_to_publish', 'wpwcl_maxreached');
    add_action('pending_to_publish', 'wpwcl_maxreached');
    add_action('draft_to_pending', 'wpwcl_maxreached');
}
