<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans300,400,700,800&subset=latin,vietnamese,latin-ext'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500,900&subset=latin,vietnamese,latin-ext'
          rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/bootstrap/css/bootstrap.min.css" media="all"/>
    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/font-awesome-4.7.0/css/font-awesome.min.css"
          media="all"/>
    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/css/flexslider.css" media="all"/>
    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/css/tonka.css" media="all"/>
    <script src="/wp-content/themes/twentysixteen/tonka/js/jquery-2.1.4.min.js"></script>
    <script src="/wp-content/themes/twentysixteen/tonka/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<div id="page" class="homepage">
    <header class="hidden-sm hidden-xs">
        <div id="wrapper_header" class="width_common">
            <div class="container">
                <div class="relative">
                    <?php dynamic_sidebar('content-bottom-1'); ?>
                    <div class="block_search_header">
                        <div class="relative">
                            <form method="get" action="/">
                                <input name="s" type="text">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div><!-- .site-header-main -->

<?php if (get_header_image()) : ?>
    <?php
    /**
     * Filter the default twentysixteen custom header sizes attribute.
     *
     * @since Twenty Sixteen 1.0
     *
     * @param string $custom_header_sizes sizes attribute
     * for Custom Header. Default '(max-width: 709px) 85vw,
     * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
     */
    $custom_header_sizes = apply_filters('twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px');
    ?>
    <div class="header-image">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img src="<?php header_image(); ?>"
                 srcset="<?php echo esc_attr(wp_get_attachment_image_srcset(get_custom_header()->attachment_id)); ?>"
                 sizes="<?php echo esc_attr($custom_header_sizes); ?>"
                 width="<?php echo esc_attr(get_custom_header()->width); ?>"
                 height="<?php echo esc_attr(get_custom_header()->height); ?>"
                 alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
        </a>
    </div><!-- .header-image -->
<?php endif; // End header image check. ?>
</header><!-- .site-header -->
<div id="banner_top_site" class="width_common">
    <div class="container">
        <div class="banner_site"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_720x90.jpg"
                                      alt=""></div>
        <a href="#" class="logo_site visible-lg visible-md"><img
                    src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_logo_site.png" alt=""></a>
    </div>
</div>
<div id="wrapper_container">
