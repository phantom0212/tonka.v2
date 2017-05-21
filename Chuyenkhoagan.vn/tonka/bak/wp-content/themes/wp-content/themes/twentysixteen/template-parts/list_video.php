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
<div id="video_page">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
            <div id="video_hot" class="space_bottom_10">
                <div class="title_box"><h3><a href="" class="text-uppercase"><?php echo get_the_archive_title() ?></a>
                    </h3></div>
                <?php
                $i = 1;
                while (have_posts()) {
                    the_post(); ?>
                    <?php if ($i === 1) : ?>
                        <div class="content_box">
                            <div class="block_videohot width_common">
                                <div class="block_thumb_video width_common">
                                    <a href="<?php echo get_the_permalink() ?>"><img alt=""
                                                                                     src="<?php echo get_the_post_thumbnail_url() ?>">
                                    </a>
                                </div>
                                <h1 class="title_box_video_hot width_common">
                                    <a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                                </h1>
                                <div class="cate_video txt_666 width_common space_bottom_10"><a
                                            href="<?php echo get_the_permalink() ?>" class="txt_site">Kiến
                                        thức về bệnh gan</a> - <?php echo get_the_time() ?>
                                </div>
                                <div class="lead_video"><?php echo get_the_excerpt() ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $i++;
                } ?>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
            <?php do_shortcode('[postCategory category_id=1 number_post=5 type="Video-Sidebar" name="Video Nổi Bật" link="" icon="/wp-content/themes/twentysixteen/tonka/images/icon/ico_non.png" ]') ?>
        </div>
    </div>

    <div class="block_banner_960x90 width_common text-center space_bottom_20">
        <a href="#"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_960x90.jpg" alt=""></a>
    </div>
    <div class="row" id="block_cate_video">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-tn-12 space_bottom_10 pull-right">
            <div class="item_box_col_right space_bottom_10" id="block_category_video">
                <div class="title_box"><h3><a href="#">Bệnh gan</a></h3></div>
                <div class="content_box">
                    <div class="list_category_video">
                        <a href="#" class="item_category">Viêm gan</a>
                        <a href="#" class="item_category active">Viêm gan</a>
                        <a href="#" class="item_category">Viêm gan</a>
                        <a href="#" class="item_category">Viêm gan</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 col-tn-12 space_bottom_10">
            <div class="list_video_folder">
                <?php
                while (have_posts()) {
                    the_post(); ?>
                    <?php if ($i >= 2) : ?>
                        <div class="item_video_noibat">
                            <div class="item_video relative format_video">
                                <div class="thumb_video relative">
                                    <div class="thunb_image thumb_5x3"><a href="<?php echo get_the_permalink() ?>"><img
                                                    src="<?php echo get_the_post_thumbnail() ?>"
                                                    alt=""></a></div>
                                    <a href="<?php echo get_the_permalink() ?>" class="masking_video1"> &nbsp;</a>
                                    <a href="<?php echo get_the_permalink() ?>" class="masking_video2"> &nbsp;</a>
                                </div>
                                <h3 class="title_video"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $i++;
                } ?>
            </div>
            <div class="block_xemthem text-right">
                <a href="#" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
            </div>
        </div>

    </div>

</div>
