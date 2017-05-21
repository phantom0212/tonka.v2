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
                <div class="title_box">
                    <h3><a href="/category/kho-video" class="text-uppercase">Kho video</a> <i
                                class="fa fa-caret-right"></i> <a href=""
                                                                  class="txt_site"><?php echo get_the_title() ?> </a>
                    </h3>
                </div>
                <?php
                $i = 1;
                while (have_posts()) {
                    the_post(); ?>
                    <?php if ($i === 1) : ?>
                        <div class="content_box">
                            <div class="block_videohot width_common">
                                <div class="block_thumb_video width_common">
                                    <?php
                                    $video_id = 'I123haN8na4';
                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', get_the_content(), $match)) {
                                        $video_id = $match[1];
                                    }
                                    ?>
                                    <iframe width="630" height="480"
                                            src="https://www.youtube.com/embed/<?php echo $video_id; ?>"
                                            frameborder="0" allowfullscreen></iframe>
                                </div>
                                <h1 class="title_box_video_hot width_common">
                                    <a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                                </h1>
                                <div class="cate_video txt_666 width_common space_bottom_10"><a
                                            href="<?php echo get_the_permalink() ?>" class="txt_site">Kiến
                                        thức về bệnh gan</a> - <?php echo get_the_time() ?>
                                </div>
                                <div class="lead_video"><?php echo get_the_content() ?></div>
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
    <div id="box_video_khac" class="width_common space_bottom_20">

        <?php do_shortcode('[postCategory category_id=1 number_post=10 type="Video" name="Video Khác" link="" icon="/wp-content/themes/twentysixteen/tonka/images/icon/ico_video.png" ]') ?>
    </div>

</div>
<script language="javascript" type="text/javascript"
        src="/wp-content/themes/twentysixteen/tonka/js/mouseWhell.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/jquery.flexslider-min.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/common.js"></script>