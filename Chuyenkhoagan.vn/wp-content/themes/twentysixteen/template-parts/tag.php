<style>
    .more-link {
        display: none !important;
    }

    #box_tinxemnhieu_folder .flex-control-nav {
        z-index: -1 !important;
    }
</style>
<?php
$most_posts = pvc_get_most_viewed_posts([
    'posts_per_page' => 10,
    'order' => 'desc',
    'post_type' => 'post'
]);
?>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
    <div class="breadcrumb">
        <a href="/">Trang chủ</a> <i class="fa fa-caret-right"></i> <a href="/?s=" class="active_breadcrumb">Tìm
            kiếm</a>
    </div>

    <div id="box_tag_page">

        <div class="width_common space_bottom_20 txt_999">Từ khóa: <strong class="txt_site txt_24"><?php echo get_the_archive_title() ?></strong>
        </div>
    </div>

    <div class="list_news_folder space_bottom_20 width_common">
        <div class="list_sub_news width_common">
            <?php
            $i = 1;
            while (have_posts()) {
                the_post(); ?>
                <div class="item_list_news_folder">
                    <div class="block_thumb_news">
                        <a class="thunb_image thumb_5x3" href="<?php echo get_the_permalink() ?>"><img alt="" src="<?php echo get_the_post_thumbnail() ?>"></a>
                    </div>
                    <h2 class="title_box_news">
                        <a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                    </h2>
                    <h4 class="lead_box_news"><?php echo get_the_excerpt() ?></h4>
                </div>
            <?php } ?>
        </div>
<!--        <div class="block_xemthem text-right">-->
<!--            <a href="#" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>-->
<!--        </div>-->
    </div>
</div>
