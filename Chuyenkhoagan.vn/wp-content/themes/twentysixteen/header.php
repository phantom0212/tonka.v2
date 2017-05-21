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
	
	<link rel="shortcut icon" href="<?php  echo get_theme_file_uri(); ?>/Tonka.ico" type="image/x-icon" />
	
    <?php wp_head(); ?>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans300,400,700,800&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500,900&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/bootstrap/css/bootstrap.min.css" media="all"/>
    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/font-awesome-4.7.0/css/font-awesome.min.css"
          media="all"/>
    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/css/flexslider.css" media="all"/>
    <link rel="stylesheet" href="/wp-content/themes/twentysixteen/tonka/css/tonka.css?v=2" media="all"/>
    <script src="/wp-content/themes/twentysixteen/tonka/js/jquery-2.1.4.min.js"></script>
    <script src="/wp-content/themes/twentysixteen/tonka/bootstrap/js/bootstrap.min.js"></script>
	
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NCHZNKH');</script>
<!-- End Google Tag Manager -->
</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCHZNKH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<style>
    .more-link{
        display: none !important;
    }
    
</style>
<div id="banner_top_site" class="width_common">
    <div class="container">
        <div class="banner_site"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_960x120.jpg"
                                      alt=""></div>
        <a href="/" class="logo_site visible-lg visible-md"></a>
    </div>
</div>
<div id="page" class="homepage">
    <header class="hidden-sm hidden-xs">
        <div id="wrapper_header" class="width_common">
            <?php
            global $wp;
            $array  = [] ;
            $array[1] = 'kho-video' ;
            $array = explode('/', $wp->request) ;
            ?> 
            <div class="container">
                <div class="relative">
                    <div id="main_menu">
                        <div class="menu_web">
                            <h2 class="item_menu_web <?php if(is_home()) : ?>active<?php endif ; ?>"><a href="/" class="parent_menu">Trang chủ </a></h2>
                            <h2 class="item_menu_web <?php if($array[1] === 'kien-thuc-benh-hoc' || $array[1] === 'xo-gan' || $array[1] === 'viem-gan' || $array[1] === 'benh-gan' || $array[1] === 'gan-nhiem-mo' || $array[1] === 'suy-gan' ) : ?>active<?php endif ; ?>">
                                <a href="/category/kien-thuc-benh-hoc" class="parent_menu">Kiến thức bệnh học<i class="fa fa-caret-down"></i> </a>
                                <div class="sub_main_menu">
                                    <a href="/category/kien-thuc-han-lam">Kiến thức hàn lâm</a>
                                        <a href="/category/benh-gan">Bệnh gan</a>
                                        <a href="/category/viem-gan"> Viêm gan</a>
                                        <a href="/category/xo-gan">Xơ gan</a>
									 <a href="/category/suy-gan"> Suy gan</a>
									 <a href="/category/ung-thu-gan">Ung thư gan</a>
                                </div>
                            </h2>
                            <h2 class="item_menu_web <?php if($array[1] === 'phong-ngua-dieu-tri'  ) : ?>active<?php endif ; ?>"><a href="/category/phong-ngua-dieu-tri" class="parent_menu">phòng ngừa - điều trị </a></h2>
                            <h2 class="item_menu_web <?php if($array[0] === 'hoi-dap'  ) : ?>active<?php endif ; ?>"><a href="/hoi-dap" class="parent_menu">tư vấn</a></h2>
                            <h2 class="item_menu_web <?php if($array[1] === 'kho-video'  ) : ?>active<?php endif ; ?>"><a href="/category/kho-video" class="parent_menu">kho video</a></h2>
                            <h2 class="item_menu_web <?php if($array[0] === 'lien-he'  ) : ?>active<?php endif ; ?>"><a href="/lien-he" class="parent_menu">liên hệ</a></h2>
                        </div>
                    </div>
                    <div class="block_search_header">
                        <div class="relative">
                            <form method="get" action="/">
                                <input name="s" placeholder="Tìm kiếm ..." type="text">
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

<div id="wrapper_container">
