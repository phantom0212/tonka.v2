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

<?php CONST CATE_SIDEBAR1 = 3;
CONST CATE_SIDEBAR2 = 4;
CONST CATE_SIDEBAR3 = 5;
CONST CATE_SIDEBAR4 = 9;

$list_array = array(CATE_SIDEBAR1,CATE_SIDEBAR2,CATE_SIDEBAR3,CATE_SIDEBAR4);
?>

<?php for($i=0; $i<count($list_array); $i++){ ?>
<div class="item_box_col_right space_bottom_10">
    <?php global $post;
    $args = array('posts_per_page' => 3, 'order' => 'ASC', 'orderby' => 'title', 'category' => $list_array[$i]);
    $category = get_term($list_array[$i], 'category');
    $category_link = get_category_link($list_array[$i]); $postslist = get_posts($args); ?>
    <?php if(count($postslist)>0){ ?>
    <div class="title_box"><h3><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a></h3></div>
    <?php } ?>
    <div class="content_box">
        <div class="list_news_box_right width_common">
            <div class="item_box_right width_common">
                <?php foreach ($postslist as $post) :
                setup_postdata($post);
                    $image = get_post_thumb(get_the_ID(), 354, 212);
                    $src = $image['src'];
                    ?>
                <div class="block_news width_common">
                    <div class="block_thumb_news">
                        <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><img
                                    alt="no image"
                                    src="<?php echo $src ?>"></a>
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

<?php } ?>



