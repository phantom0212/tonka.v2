<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
require 'BFI_Thumb.php';
require 'thumbs.php';
CONST KIENTHUCHANLAM = 3;
CONST TINXEMNHIEU = 2;
CONST SUCKHOELAMDEP = 4;

CONST KIENTHUCBENHHOC = 5;


CONST KHOVIDEO = 9;
CONST VIDEONOIBAT = 36;
CONST SLIDERIGHT = 10;

define("SLUG_TINMOINHAT" ,'/chuyen-muc/bai-viet-moi-nhat');
define("SLUG_TINXEMNHIEU" ,'/chuyen-muc/tin-xem-nhieu');

define("NAME_TINMOINHAT" ,'bai-viet-moi-nhat');
define("NAME_TINXEMNHIEU" ,'tin-xem-nhieu');
define("NAME_KHOVIDEO" ,'kho-video');

function getChildCate($id_cate){
    $term_id = $id_cate;
    $taxonomy_name = 'category';
    $term_children = get_term_children( $term_id, $taxonomy_name );
    return $term_children;
}


if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'MainMenu'    => __( 'Main Menu', 'twentyseventeen' ),
		'FooterMenu' => __( 'Footer Menu', 'twentyseventeen' ),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
        'name'          => __( 'banner foooter 960x90', 'twentyseventeen' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'banner ảnh dưới footer', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Quản lý địa chỉ', 'twentyseventeen' ),
        'id'            => 'manage_adress',
        'description'   => __( 'Quản lý địa chỉ', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Quản lý bản đồ googlemap', 'twentyseventeen' ),
        'id'            => 'manage_googlemap',
        'description'   => __( 'Quản bản đồ googlemap', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Main googlemap Liên hệ', 'twentyseventeen' ),
        'id'            => 'main_googlemap',
        'description'   => __( 'Main googlemap Liên hệ', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Form gửi liên hệ', 'twentyseventeen' ),
        'id'            => 'from_contact',
        'description'   => __( 'Form gửi liên hệ', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Box đặt câu hỏi FAQ', 'twentyseventeen' ),
        'id'            => 'form_faq',
        'description'   => __( 'Box đặt câu hỏi FAQ', 'twentyseventeen' ),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Thanh chuyên mục kho video', 'twentyseventeen' ),
        'id'            => 'bar_khovideo',
        'description'   => __( 'Thanh chuyên mục kho video', 'twentyseventeen' ),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer dưới trang web', 'twentyseventeen' ),
        'id'            => 'footer',
        'description'   => __( 'Footer dưới trang web', 'twentyseventeen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name'          => __( 'Tin xem nhieu nhat', 'twentyseventeen' ),
        'id'            => 'most-view',
        'description'   => __( 'Tin xem nhieu nhat', 'twentyseventeen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'banner quảng cáo', 'twentyseventeen' ),
        'id'            => 'quangcao',
        'description'   => __( 'banner quảng cáo', 'twentyseventeen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
	register_sidebar( array(
        'name'          => __( 'banner QC Category', 'twentyseventeen' ),
        'id'            => 'quangcao_cate',
        'description'   => __( 'banner QC Category', 'twentyseventeen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

add_filter('widget_text', 'do_shortcode');

function get_category_parents_custom( $id, $link = false, $separator = '/', $nicename = false, $visited = array()) {
	        $chain = '';
	        $parent = get_term( $id, 'category' );
        if ( is_wp_error( $parent ) )
 	                return $parent;

	        if ( $nicename )
     	                $name = $parent->slug;
	        else
	                $name = $parent->name;

        if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
      	                $visited[] = $parent->parent;
                $chain .= get_category_parents_custom( $parent->parent, $link, $separator, $nicename, $visited );
        }

	        if ( $link )
                      $chain = esc_url( get_category_link( $parent->term_id ) );

	        return $chain;
	}


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



// chen quang cao vao bai viet
//add_filter( 'the_content', 'prefix_insert_post_ads' );
//function prefix_insert_post_ads($content ) {
//    $ad_code = '<div>'.wp_get_sidebars_widgets('quangcao').'</div>';
//    if ( is_single() && ! is_admin() ) {
//        return prefix_insert_after_paragraph( $ad_code, 2, $content );
//    }
//    return $content;
//}
//
//// Parent Function that makes the magic happen
//
//function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
//    $closing_p = '</p>';
//    $paragraphs = explode( $closing_p, $content );
//    foreach ($paragraphs as $index => $paragraph) {
//
//        if ( trim( $paragraph ) ) {
//            $paragraphs[$index] .= $closing_p;
//        }
//
//        if ( $paragraph_id == $index + 1 ) {
//            $paragraphs[$index] .= $insertion;
//        }
//    }
//
//    return implode( '', $paragraphs );
//}



















add_action('delete_attachment', 'mr_delete_resized_images');
function mr_image_resize($url, $width=null, $height=null, $crop=true, $align='c', $retina=false) {
  global $wpdb;
  // Get common vars (func_get_args() only get specified values)
  $common = mr_common_info($url, $width, $height, $crop, $align, $retina);
  
  // Unpack vars if got an array...
  if (is_array($common)) extract($common);
  // ... Otherwise, return error, null or image
  else return $common;
  if (!file_exists($dest_file_name)) {
    // We only want to resize Media Library images, so we can be sure they get deleted correctly when appropriate.
    $query = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE guid='%s'", $url);
    $get_attachment = $wpdb->get_results($query);
    // Load WordPress Image Editor
    $editor = wp_get_image_editor($file_path);
    
    // Print possible wp error
    if (is_wp_error($editor)) {
      if (is_user_logged_in()) print_r($editor);
      return null;
    }
    if ($crop) {
      $src_x = $src_y = 0;
      $src_w = $orig_width;
      $src_h = $orig_height;
      $cmp_x = $orig_width / $dest_width;
      $cmp_y = $orig_height / $dest_height;
      // Calculate x or y coordinate and width or height of source
      if ($cmp_x > $cmp_y) {
        $src_w = round ($orig_width / $cmp_x * $cmp_y);
        $src_x = round (($orig_width - ($orig_width / $cmp_x * $cmp_y)) / 2);
      } else if ($cmp_y > $cmp_x) {
        $src_h = round ($orig_height / $cmp_y * $cmp_x);
        $src_y = round (($orig_height - ($orig_height / $cmp_y * $cmp_x)) / 2);
      }
      // Positional cropping. Uses code from timthumb.php under the GPL
      if ($align && $align != 'c') {
        if (strpos ($align, 't') !== false) {
          $src_y = 0;
        }
        if (strpos ($align, 'b') !== false) {
          $src_y = $orig_height - $src_h;
        }
        if (strpos ($align, 'l') !== false) {
          $src_x = 0;
        }
        if (strpos ($align, 'r') !== false) {
          $src_x = $orig_width - $src_w;
        }
      }
      
      // Crop image
      $editor->crop($src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height);
    } else {
     
      // Just resize image
      $editor->resize($dest_width, $dest_height);
     
    }
    // Save image
    $saved = $editor->save($dest_file_name);
    
    // Print possible out of memory error
    if (is_wp_error($saved)) {
      if (is_user_logged_in()) {
        print_r($saved);
        unlink($dest_file_name);
      }
      return null;
    }
    // Add the resized dimensions and alignment to original image metadata, so the images
    // can be deleted when the original image is delete from the Media Library.
    if ($get_attachment) {
      $metadata = wp_get_attachment_metadata($get_attachment[0]->ID);
      if (isset($metadata['image_meta'])) {
        $md = $saved['width'] . 'x' . $saved['height'];
        if ($crop) $md .= ($align) ? "_${align}" : "_c";
        $metadata['image_meta']['resized_images'][] = $md;
        wp_update_attachment_metadata($get_attachment[0]->ID, $metadata);
      }
    }
    // Resized image url
    $resized_url = str_replace(basename($url), basename($saved['path']), $url);
  } else {
    // Resized image url
    $resized_url = str_replace(basename($url), basename($dest_file_name), $url);
  }
  // Return resized url
  return $resized_url;
}
// Returns common information shared by processing functions
function mr_common_info($url, $width, $height, $crop, $align, $retina) {
  // Return null if url empty
  if (empty($url)) {
    return is_user_logged_in() ? "image_not_specified" : null;
  }
  // Return if nocrop is set on query string
  if (preg_match('/(\?|&)nocrop/', $url)) {
    return $url;
  }
  
  // Get the image file path
  $urlinfo = parse_url($url);
  $wp_upload_dir = wp_upload_dir();
  
  if (preg_match('/\/[0-9]{4}\/[0-9]{2}\/.+$/', $urlinfo['path'], $matches)) {
    $file_path = $wp_upload_dir['basedir'] . $matches[0];
  } else {
    $pathinfo = parse_url( $url );
    $uploads_dir = is_multisite() ? '/files/' : '/wp-content/';
    $file_path = ABSPATH . str_replace(dirname($_SERVER['SCRIPT_NAME']) . '/', '', strstr($pathinfo['path'], $uploads_dir));
    $file_path = preg_replace('/(\/\/)/', '/', $file_path);
  }
  
  // Don't process a file that doesn't exist
  if (!file_exists($file_path)) {
    return null; // Degrade gracefully
  }
  
  // Get original image size
  $size = is_user_logged_in() ? getimagesize($file_path) : @getimagesize($file_path);
  // If no size data obtained, return error or null
  if (!$size) {
    return is_user_logged_in() ? "getimagesize_error_common" : null;
  }
  // Set original width and height
  list($orig_width, $orig_height, $orig_type) = $size;
  // Generate width or height if not provided
  if ($width && !$height) {
    $height = floor ($orig_height * ($width / $orig_width));
  } else if ($height && !$width) {
    $width = floor ($orig_width * ($height / $orig_height));
  } else if (!$width && !$height) {
    return $url; // Return original url if no width/height provided
  }
  // Allow for different retina sizes
  $retina = $retina ? ($retina === true ? 2 : $retina) : 1;
  // Destination width and height variables
  $dest_width = $width * $retina;
  $dest_height = $height * $retina;
  // Some additional info about the image
  $info = pathinfo($file_path);
  $dir = $info['dirname'];
  $ext = $info['extension'];
  $name = wp_basename($file_path, ".$ext");
  // Suffix applied to filename
  $suffix = "${dest_width}x${dest_height}";
  // Set align info on file
  if ($crop) {
    $suffix .= ($align) ? "_${align}" : "_c";
  }
  // Get the destination file name
  $dest_file_name = "${dir}/${name}-${suffix}.${ext}";
  
  // Return info
  return array(
    'dir' => $dir,
    'name' => $name,
    'ext' => $ext,
    'suffix' => $suffix,
    'orig_width' => $orig_width,
    'orig_height' => $orig_height,
    'orig_type' => $orig_type,
    'dest_width' => $dest_width,
    'dest_height' => $dest_height,
    'file_path' => $file_path,
    'dest_file_name' => $dest_file_name,
  );
}
// Deletes the resized images when the original image is deleted from the WordPress Media Library.
function mr_delete_resized_images($post_id) {
  // Get attachment image metadata
  $metadata = wp_get_attachment_metadata($post_id);
  
  // Return if no metadata is found
  if (!$metadata) return;
  // Return if we don't have the proper metadata
  if (!isset($metadata['file']) || !isset($metadata['image_meta']['resized_images'])) return;
  
  $wp_upload_dir = wp_upload_dir();
  $pathinfo = pathinfo($metadata['file']);
  $resized_images = $metadata['image_meta']['resized_images'];
  
  // Delete the resized images
  foreach ($resized_images as $dims) {
    // Get the resized images filename
    $file = $wp_upload_dir['basedir'] . '/' . $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $dims . '.' . $pathinfo['extension'];
    // Delete the resized image (if it has not yet been deleted)
    @unlink($file);
  }
}