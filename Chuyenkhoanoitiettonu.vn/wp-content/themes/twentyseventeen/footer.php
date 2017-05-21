<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>


<div id="menu_footer">
    <?php wp_nav_menu(array('theme_location' => 'MainMenu', 'menu_class' => 'menu_footer')); ?>
</div>
 <?php dynamic_sidebar('footer'); ?>
</div>

<div class="block_floating_page">
    <div class="space_bottom_20"><a href="javascript:;" id="to_top" ><img src="<?php  echo get_theme_file_uri(); ?>/assets/images/graphics/img_totop.png" alt="" /></a></div>
    <div class="block_hotline_floating"><img src="<?php  echo get_theme_file_uri(); ?>/assets/images/graphics/img_hotline.png" alt="" /></div>
</div>

<?php wp_footer(); ?>

<script src="<?php  echo get_theme_file_uri(); ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php  echo get_theme_file_uri(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php  echo get_theme_file_uri(); ?>/assets/js/mouseWhell.js"></script>
<script src="<?php  echo get_theme_file_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
<script src="<?php  echo get_theme_file_uri(); ?>/assets/js/jquery.bxslider.js"></script>
<script src="<?php  echo get_theme_file_uri(); ?>/assets/js/common.js"></script>

</body>
</html>
