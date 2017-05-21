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
<?php
	$args = array(
                          'category__in' => [26] ,
                          'posts_per_page' => 7,
						  'caller_get_posts' => 0
				);
    
	$posts_new = new WP_Query($args);
?> 
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
            <div id="box_moinhat" class="space_bottom_10">
                <div class="title_box"><h3><a href="/category/bai-viet-moi-nhat">Bài viết mới nhất</a></h3></div>
                <div class="block_news width_common">
                    <?php if ($posts_new->have_posts()) : ?>
                        <?php
                        $i = 1;
                        while ($posts_new->have_posts()) : $posts_new->the_post();
                            ?>

                            <div class="block_thumb_news">
                                <a class="thunb_image thumb_5x3" href="<?php echo esc_url(get_permalink()); ?>">
                            <?php
							  $image = get_post_thumb(get_the_ID(), 354, 212);
                            $src = $image['src'];
							?>
							 <img src="<?php echo $src;?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>" />
									</a>
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
                    <?php if ($posts_new->have_posts()) : ?>
                        <?php
                        $i = 1;
                        while ($posts_new->have_posts()) : $posts_new->the_post();
                            if ($i > 1) :
                                ?>
                                <div class="item_sub_news">
                                    <div class="block_thumb_news">
                                        <a class="thunb_image thumb_5x3" href="<?php echo esc_url(get_permalink()); ?>">
										 <?php
							  $image = get_post_thumb($post->ID, 158, 95);
							?>
							 <img src="<?php echo $image['src'];?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>" />
										</a>
                                    </div>
                                    <h2 class="title_box_news">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
                                    </h2>
                                    <h4 class="lead_box_news"><?php the_excerpt(); ?></h4>
                                </div>
                                <?php
                            endif;
							if ($i == 3) break;
                            $i++;

                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="width_common block_banner_640 space_bottom_10"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_640x90.jpg" alt=""></div>
            <?php do_shortcode('[postCategory category_id=8 number_post=4 type="Normal" name="Nghiên cứu lâm sàng" link="/category/kien-thuc-han-lam" icon="/wp-content/themes/twentysixteen/tonka/images/icon/ico_non.png" ]') ?>
            <div id="box_tuvan" class="box_common_site">
                <div class="title_box_common">
                    <h3 class="wap_title_box relative">
                        <div class="icon_title"><img src="/wp-content/themes/twentysixteen/tonka/images/icon/ico_tuvan.png"></div>
                        <a class="text_title_box" href="/hoi-dap">Hỏi chuyên gia</a>
                    </h3>
                </div>
                <div class="content_box_common width_common">
                    <?php echo  do_shortcode('[dwqa-list-questions]') ?>
                    <div class="block_txt_datcauhoi text-center"><a href="/hoi-dap" class="text-uppercase txt_16 txt_site"><b>đặt câu hỏi</b></a></div>
                </div>
            </div>
            <?php do_shortcode('[postCategory category_id=4 number_post=10 type="Video" name="Kho Video" link="/category/kho-video  " icon="/wp-content/themes/twentysixteen/tonka/images/icon/ico_video.png" ]') ?>
            <?php get_sidebar(); ?>
        </div>
    </div><!-- .content-area -->
</div>
<script language="javascript" type="text/javascript" src="/wp-content/themes/twentysixteen/tonka/js/mouseWhell.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/jquery.flexslider-min.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/common.js"></script>
<style>
    .author_answear{
        text-align: right;
        font-weight: bold;
    }
</style>
<?php get_footer(); ?>