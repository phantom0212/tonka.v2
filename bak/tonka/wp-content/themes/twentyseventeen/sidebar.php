<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="item_box_col_right item_box_type2 space_bottom_10">
    	<?php global $post;
    	$args = array('posts_per_page' => 3, 'order' => 'ASC', 'orderby' => 'title', 'category' => CATE_SIDEBAR1);
    	$category = get_term(CATE_SIDEBAR1, 'category');
    	$category_link = get_category_link(CATE_SIDEBAR1); $postslist = get_posts($args); ?>
    	<?php if(count($postslist)>0){ ?>
    		<div class="title_box"><h3><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a></h3></div>
    	<?php } ?>
    <div class="content_box">
        <div class="list_news_box_right width_common">
            <div class="item_box_right width_common">
                <?php foreach ($postslist as $post) :
                setup_postdata($post); ?>
                <div class="block_news width_common">
                    <div class="block_thumb_news">
                        <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                    </div>
                    <h2 class="title_box_news title_normal">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </h2>

                </div>
                    <?php
                endforeach;
                wp_reset_postdata(); ?>
            </div>
        </div>

        <?php if(count($postslist)>0){ ?>
            <div class="block_xemthem text-right">
                <a href="<?php echo esc_url($category_link); ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>
<div class="item_box_col_right item_box_type2 space_bottom_10">
    <?php global $post;
    $args = array('posts_per_page' => 3, 'order' => 'ASC', 'orderby' => 'title', 'category' => CATE_SIDEBAR1);
    $category = get_term(CATE_SIDEBAR1, 'category');
    $category_link = get_category_link(CATE_SIDEBAR1); $postslist = get_posts($args); ?>
    <?php if(count($postslist)>0){ ?>
        <div class="title_box"><h3><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a></h3></div>
    <?php } ?>
    <div class="content_box">
        <div class="list_news_box_right width_common">
            <div class="item_box_right width_common">
                <?php foreach ($postslist as $post) :
                    setup_postdata($post); ?>
                    <div class="block_news width_common">
                        <div class="block_thumb_news">
                            <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                        </div>
                        <h2 class="title_box_news title_normal">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h2>

                    </div>
                    <?php
                endforeach;
                wp_reset_postdata(); ?>
            </div>
        </div>

        <?php if(count($postslist)>0){ ?>
            <div class="block_xemthem text-right">
                <a href="<?php echo esc_url($category_link); ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>

<?php global $post;
$args = array('posts_per_page' => 3, 'order' => 'ASC', 'orderby' => 'title', 'category' => PHONGNGUA);
$category = get_term(PHONGNGUA, 'category');
$category_link = get_category_link(PHONGNGUA); ?>
<div id="box_phongngua" class="item_box_col_right space_bottom_20 width_common">
    <div class="title_box">
        <h3><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a></h3>
        <div class="icon_title"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_dieutri.png" alt="" /></div>
    </div>
    <div class="content_box">
        <div class="list_news_box_right ">
            <?php $postslist = get_posts($args);
            $stt = 0; ?>
            <?php foreach ($postslist as $post) :
            setup_postdata($post);
            ?>
            <div class="item_box_right width_common">
                <div class="block_news width_common">
                    <div class="block_thumb_news">
                        <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                    </div>
                    <h2 class="title_box_news title_normal">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </h2>

                </div>
            </div>
                <?php
                $stt++;
            endforeach;
            wp_reset_postdata(); ?>
            <div class="clearfix"></div>
        </div>

        <?php if(count($postslist)>0){ ?>
            <div class="block_xemthem text-right">
                <a href="<?php echo esc_url($category_link); ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>

<div id="box_tuvan" class="item_box_col_right space_bottom_20 width_common">
    <div class="title_box">
        <h3><a href="#">Hỏi chuyên gia</a></h3>
        <div class="icon_title"><img
                src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_tuvan.png" alt=""/>
        </div>
    </div>

    <div class="content_box_common width_common">
        <div class="list_tuvan width_common">
            <?php echo do_shortcode('[dwqa-list-questions]'); ?>
        </div>
        <div class="block_txt_datcauhoi text-center"><a href="#"
                                                        class="text-uppercase txt_16 txt_site"><b>đặt
                    câu hỏi</b></a></div>
    </div>
</div>


<?php global $post;
$args = array('posts_per_page' => 1, 'order' => 'ASC', 'orderby' => 'title', 'category' => KHOVIDEO);
$category = get_term(KHOVIDEO, 'category');
$category_link = get_category_link(KHOVIDEO); ?>
<div id="box_video" class="item_box_col_right space_bottom_20 width_common">
    <div class="title_box">
        <h3><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></h3>
        <div class="icon_title"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_video.png" alt=""/></div>
    </div>
    <div class="content_box_video width_common">
        <div class="item_video relative">
            <div class="thumb_video relative">
                <div class="thunb_image thumb_5x3"><img src="<?php the_post_thumbnail() ?>"
                                                        alt=""/></div>
                <a href="#" class="masking_video1"> &nbsp;</a>
                <a href="#" class="masking_video2"> &nbsp;</a>
            </div>
            <h2 class="title_video"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        </div>
    </div>
</div>
