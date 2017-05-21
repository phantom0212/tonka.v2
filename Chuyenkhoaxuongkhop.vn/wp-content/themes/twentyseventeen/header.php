<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php  echo get_theme_file_uri(); ?>/XKNN.ico" type="image/x-icon" />
<?php wp_head(); ?>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans300,400,700,800&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500,900&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?php  echo get_theme_file_uri(); ?>/assets/bootstrap/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="<?php  echo get_theme_file_uri(); ?>/assets/font-awesome-4.7.0/css/font-awesome.min.css" media="all" />
    <link rel="stylesheet" href="<?php  echo get_theme_file_uri(); ?>/assets/css/flexslider.css" media="all" />
    <link rel="stylesheet" href="<?php  echo get_theme_file_uri(); ?>/assets/css/sknn.css?v=4" media="all" />
<link rel="stylesheet" href="<?php  echo get_theme_file_uri(); ?>/style.css" media="all" />
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WVHLWJ5');</script>
<!-- End Google Tag Manager -->
</head>
<style>
</style>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WVHLWJ5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="page" class="homepage">
    <div id="banner_top_site">
        <div class="container">
            <div class="text-center"><img src="<?php  echo get_theme_file_uri(); ?>/assets/css/images/graphics/img_960x120.jpg" alt="" /></div>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_site visible-lg visible-md"></a>
        </div>
    </div>
    <header class="hidden-sm hidden-xs">
        <div id="wrapper_header" class="width_common">
            <div class="container">
                <div class="relative">
                    <div id="main_menu">
                        <div class="">
                            <?php wp_nav_menu(array('theme_location' => 'MainMenu', 'menu_class' => 'menu_web')); ?>
                        </div>
                    </div>
                    <div class="block_search_header">
                        <div class="relative">

                            <form role="search" method="get" class="search-form"
                            action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" placeholder="Tìm Kiếm ..."
                            value="<?php echo get_search_query(); ?>" name="s">
                                <input type="hidden" value="post" name="post_type" id="post_type" />
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="menu_tablet" class="width_common hidden-lg hidden-md">
       <!-- <a href="#" class="logo"><img src="<?php  //echo get_theme_file_uri(); ?>/assets/images/graphics/img_logo_site.png" alt="" /></a>-->
        <div class="block_hamber_menu">
            <div class="hamber"> <span>&nbsp;</span> <span>&nbsp;</span> <span>&nbsp;</span> </div>
            <div class="block_menu">
                <div class="width_common">
                    <?php wp_nav_menu(array('theme_location' => 'MainMenu', 'menu_class' => 'menu_web fa fa-caret-down')); ?>
                </div>
            </div>
        </div>
    </div>
