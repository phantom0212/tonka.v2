<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
            <div id="box_moinhat" class="space_bottom_10">
                <div class="title_box"><h3><a href="#">Bài viết mới nhất</a></h3></div>
                <div class="block_news width_common">
                    <?php if (have_posts()) : ?>
                        <?php
                        $i = 1;
                        while (have_posts()) : the_post();
                            ?>

                            <div class="block_thumb_news">
                                <a class="thunb_image thumb_5x3" href="<?php echo esc_url(get_permalink()); ?>">
                                    <img
                                            alt=""
                                            src="<?php the_post_thumbnail(); ?>"></a>
                            </div>
                            <h2 class="title_box_news">
                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
                            </h2>
                            <h4 class="lead_box_news"><?php the_excerpt(); ?></h4>

                            <?php
                            if ($i == 1) break;
                            $i++;
                        endwhile;
                    endif;
                    ?>
                </div>
                <div class="list_sub_news width_common">
                    <?php if (have_posts()) : ?>
                        <?php
                        $i = 1;
                        while (have_posts()) : the_post();
                            if ($i > 1) :
                                ?>
                                <div class="item_sub_news">
                                    <div class="block_thumb_news">
                                        <a class="thunb_image thumb_5x3" href="<?php echo esc_url(get_permalink()); ?>"><img
                                                    alt=""
                                                    src="<?php the_post_thumbnail('medium'); ?>"></a>
                                    </div>
                                    <h2 class="title_box_news">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
                                    </h2>
                                    <h4 class="lead_box_news"><?php the_excerpt(); ?></h4>
                                </div>
                                <?php
                            endif;
                            $i++;

                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="width_common block_banner_640 space_bottom_10"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_640x90.jpg" alt=""></div>
            <?php do_shortcode('[postCategory category_id=1 number_post=4 type="Normal" name="KIẾN THỨC HÀN LÂM" link="" icon="/wp-content/themes/twentysixteen/tonka/images/icon/ico_non.png" ]') ?>
            <?php do_shortcode('[postCategory category_id=1 number_post=10 type="Video" name="Kho Video" link="" icon="/wp-content/themes/twentysixteen/tonka/images/icon/ico_video.png" ]') ?>
            <?php get_sidebar(); ?>
        </div>
    </div><!-- .content-area -->
</div>
<script language="javascript" type="text/javascript" src="/wp-content/themes/twentysixteen/tonka/js/mouseWhell.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/jquery.flexslider-min.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/common.js"></script>

<?php get_footer(); ?>
