<?php
define('THEME_NAME','twentysixteen');
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.4-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twentysixteen_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * Create your own twentysixteen_setup() function to override in a child theme.
     *
     * @since Twenty Sixteen 1.0
     */
    function twentysixteen_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
         * If you're building a theme based on Twenty Sixteen, use a find and replace
         * to change 'twentysixteen' to the name of your theme in all the template files
         */
        load_theme_textdomain('twentysixteen');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         *
         *  @since Twenty Sixteen 1.2
         */
        add_theme_support('custom-logo', array(
            'height' => 240,
            'width' => 240,
            'flex-height' => true,
        ));

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 9999);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'twentysixteen'),
            'social' => __('Social Links Menu', 'twentysixteen'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', twentysixteen_fonts_url()));

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif; // twentysixteen_setup
add_action('after_setup_theme', 'twentysixteen_setup');

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width()
{
    $GLOBALS['content_width'] = apply_filters('twentysixteen_content_width', 840);
}

add_action('after_setup_theme', 'twentysixteen_content_width', 0);

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */

function postCategory($atts)
{
    try {
        if (isset($atts['type']) && isset($atts['number_post']) && isset($atts['category_id']) && isset($atts['link']) && isset($atts['name']) && isset($atts['icon'])) {
            $category = $atts['category_id'];
            $link_category = $atts['link'];
            $name_category = $atts['name'];
            $post = null ;
            $posts = null ;
            $string = '';
            $args = array(
                          'numberposts' => $atts['number_post'],
                          'offset' => 0,
                          'category' => $category
                          );
            $posts = get_posts($args);
            $items = '';
            if ($atts['type'] === 'Normal') {
                foreach ($posts as $post) {
                    $image = get_post_thumb($post->ID, 354, 212);
                    $thumbnail = $image['src'];
                    $Link = get_the_permalink($post->ID);
                    $items .= '<div class="item_block_2_row">
                                <div class="block_news width_common">
                                <div class="block_thumb_news">
                                    <a class="thunb_image thumb_5x3" href="' . $Link . '"><img alt="" src="' . $thumbnail . '"></a>
                                </div>
                                <h2 class="title_box_news title_normal">
                                    <a href="' . $Link . '">' . $post->post_title . '</a>
                                </h2>
                                
                            </div>
                                <div class="clearfix"></div>
                            </div>';
                }

                $string = "<div id=\"box_kienthuc_hanlam\" class=\"box_common_site\">
                    <div class=\"title_box_common\">
                        <h3 class=\"wap_title_box relative\">
                            <div class=\"icon_title\"><img src=\"" . $atts['icon'] . "\"></div>
                            <a class=\"text_title_box\" href=\"" . $link_category . "\">" . $name_category . "</a>
                        </h3>
                        <div class=\"block_xemthem text-right\">
                            <a href=\"" . $link_category . "\" class=\"txt_666\"><i class=\"fa fa-caret-down\"></i> Xem thêm</a>
                        </div>
                    </div>
                    <div class=\"content_box_common width_common\">
                    	<div class=\"row\">" . $items . "</div>
                    </div>
                </div>";
            } elseif ($atts['type'] === 'Video') {
                foreach ($posts as $post) {
                    $image = get_post_thumb($post->ID, 354, 212);
                    $thumbnail = $image['src'];
                    $Link = get_the_permalink($post->ID);
                    $items .= '<li>
                                    <div class="item_video">
                                        <div class="thumb_video relative">
                                            <div class="thunb_image thumb_5x3"><img src="' . $thumbnail . '" alt="" /></div>
                                            <a href="' . $Link . '" class="masking_video1"> &nbsp;</a>
                                            <a href="' . $Link . '" class="masking_video2"> &nbsp;</a>
                                        </div>
                                        <h2 class="title_video"><a href="#">' . $post->post_title . '</a></h2> 
                                    </div>
                                </li>';
                }

                $string = "<div id=\"box_video\" class=\"width_common space_bottom_20\"> 
                    <div class=\"title_box_video width_common\">                	
                            <img src=\"" . $atts['icon'] . "\" class=\"icon_title\">
                            <a class=\"text_title_box\" href=\"" . $link_category . "\">" . $name_category . "</a>
                    </div>
                    <div class=\"content_box_video width_common\">
                        <div class=\"flexslider\">
                            <ul class=\"slides\">
                                " . $items . "
                             </ul>
                         </div>                     	
                    </div>
            	</div>
            </div>";
            } elseif ($atts['type'] === 'Sidebar') {
                foreach ($posts as $post) {
                    $image = get_post_thumb($post->ID, 354, 212);
                    $thumbnail = $image['src'];
                    $Link = get_the_permalink($post->ID);
                    $items .= '<div class="block_news width_common">
                                    <div class="block_thumb_news">
                                        <a class="thunb_image thumb_5x3" href="' . $Link . '"><img alt="" src="' . $thumbnail . '"></a>
                                    </div>
                                    <h2 class="title_box_news title_normal">
                                        <a href="' . $Link . '">' . $post->post_title . '</a>
                                    </h2>
                                </div>';
                }
                $string = '<div class="item_box_col_right space_bottom_10">
                    <div class="title_box"><h3><a href="' . $link_category . '">' . $name_category . '</a></h3></div>
                    <div class="content_box">
                        <div class="list_news_box_right width_common">
                        	<div class="item_box_right width_common">
                            	 ' . $items . '                               
                            </div>
                        </div>
                        
                        <div class="block_xemthem text-right">
                            <a href="' . $link_category . '" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>';
            } elseif ($atts['type'] === 'Video-Sidebar') {
                foreach ($posts as $post) {
                    $image = get_post_thumb($post->ID, 354, 212);
                    $thumbnail = $image['src'];
                    $Link = get_the_permalink($post->ID);
                    $items .= '<div class="item_video_noibat active">
                            <div class="item_video relative format_video">
                                <div class="thumb_video relative">
                                    <div class="thunb_image thumb_5x3"><a href="' . $Link . '"><img
                                                    src="' . $thumbnail . '"
                                                    alt=""></a></div>
                                    <a href="' . $Link . '" class="masking_video1"> <i class="fa fa-play"
                                                                           aria-hidden="true"></i></a>
                                    <a href="' . $Link . '" class="masking_video2"> &nbsp;</a>
                                </div>
                                <h3 class="title_video"><a href="' . $Link . '">' . $post->post_title . '</a></h3>
                            </div>
                        </div>';
                }
                $string = '<div id="box_video_noibat" class="space_bottom_20 width_common">
                <div class="title_box">
                    <h3><a href="' . $link_category . '">' . $name_category . '</a></h3>
                    <div class="icon_title"><img src="/wp-content/themes/twentysixteen/tonka/images/icon/ico_video.png"
                                                 alt=""></div>
                </div>
                <div class="content_box_video width_common">
                    <div class="list_video_noibat width_common">
                        ' . $items . '
                    </div>
                </div>
            </div>';
            }

            echo $string;
        } else {
            echo "";
        }
    } catch (\Exception $e) {
        echo "";
    }


}


function twentysixteen_widgets_init()
{

    add_filter('widget_text', 'do_shortcode');
    add_shortcode('postCategory', 'postCategory');
    register_sidebar(array(
        'name' => __('Sidebar', 'twentysixteen'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'twentysixteen'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => __('Footer', 'theme-slug'),
        'id' => 'sidebar-12',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'theme-slug'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => __('Content Bottom 1', 'twentysixteen'),
        'id' => 'sidebar-2',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'twentysixteen'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Content Bottom 2', 'twentysixteen'),
        'id' => 'sidebar-3',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'twentysixteen'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __( 'Banner quảng cáo', 'twentysixteen' ),
        'id'            => 'quangcao',
        'description'   => __( 'Banner quảng cáo', 'twentysixteen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action('widgets_init', 'twentysixteen_widgets_init');

if (!function_exists('twentysixteen_fonts_url')) :
    /**
     * Register Google fonts for Twenty Sixteen.
     *
     * Create your own twentysixteen_fonts_url() function to override in a child theme.
     *
     * @since Twenty Sixteen 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function twentysixteen_fonts_url()
    {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Merriweather font: on or off', 'twentysixteen')) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Montserrat font: on or off', 'twentysixteen')) {
            $fonts[] = 'Montserrat:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Inconsolata font: on or off', 'twentysixteen')) {
            $fonts[] = 'Inconsolata:400';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection()
{
}


/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts()
{
    // Add custom fonts, used in the main stylesheet.


    // Add Genericons, used in the main stylesheet.


    // Theme stylesheet.


    // Load the Internet Explorer specific stylesheet.


}

add_action('wp_enqueue_scripts', 'twentysixteen_scripts');

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes($classes)
{
    // Adds a class of custom-background-image to sites with a custom background image.
    if (get_background_image()) {
        $classes[] = 'custom-background-image';
    }

    // Adds a class of group-blog to sites with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of no-sidebar to sites without active sidebar.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}

add_filter('body_class', 'twentysixteen_body_classes');

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb($color)
{
    $color = trim($color, '#');

    if (strlen($color) === 3) {
        $r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
        $g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
        $b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
    } else if (strlen($color) === 6) {
        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));
    } else {
        return array();
    }

    return array('red' => $r, 'green' => $g, 'blue' => $b);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array $size Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr($sizes, $size)
{
    $width = $size[0];

    840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

    if ('page' === get_post_type()) {
        840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    } else {
        840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
        600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    }

    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
    if ('post-thumbnail' === $size) {
        is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        !is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3);

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args($args)
{
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    return $args;
}

add_filter('widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args');

require_once('resize.php');
require_once('thumbs.php');
require_once('BFI_Thumb.php');

//	set mô tả bài viết

function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Mô tả bài viết', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>

    <p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <?php _e( 'Đoạn mô tả ngắn về bài viết (có thể nhập text hoặc html)', 'sm-textdomain' )?>

            <textarea name="meta-checkbox" rows="8" style="width: 100%;" id="description"><?php if ( isset ( $featured['description'] ) ) echo $featured['description'][0]; ?></textarea>
        </label>

    </div>
    </p>

    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );


function sm_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves
    if( isset( $_POST[ 'meta-checkbox' ] ) ) {
        update_post_meta( $post_id, 'description', $_POST[ 'meta-checkbox' ] );
    } else {
        update_post_meta( $post_id, 'description', '' );
    }

}
add_action( 'save_post', 'sm_meta_save' );