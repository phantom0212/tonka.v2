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
    'posts_per_page' => 6 ,
    'order' => 'desc',
    'post_type' => 'post'
]);
?>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
    <div class="breadcrumb">
        <a href="/">Trang chủ</a> <i class="fa fa-caret-right"></i> <a href=""
                                                                       class="active_breadcrumb"><?php echo get_the_archive_title() ?></a>
    </div>
    <?php
    $i = 1;
    while (have_posts()) {
        the_post(); ?>
        <?php if ($i === 1) : ?>
            <div id="box_hot_folder" class="space_bottom_20">
                <div class="content_box">
                    <div class="block_news width_common">
                        <div class="block_thumb_news">
                            <a class="thunb_image thumb_5x3" href="<?php echo get_the_permalink() ?>">
							<?php
							  $image = get_post_thumb($post->ID, 354, 212);
							?>
							 <img src="<?php echo $image['src'];?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>" /></a>
                        </div>
                        <h2 class="title_box_news">
                            <a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
                        </h2>
                        <h4 class="lead_box_news"><?php echo get_the_excerpt() ?></h4>
                    </div>
                </div>
            </div>

            <div id="box_tinxemnhieu_folder" class="width_common space_bottom_20">
                <div class="title_box"><h3><a href="javasript:void(0)">Tin xem nhiều</a></h3></div>
                <div class="content_box">
                    <div class="flexslider">

                        <div class="flex-viewport" style="overflow: hidden; position: relative;">
                            <ul class="slides"
                                style="width: 800%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                                <?php foreach ($most_posts as $post) : ?>
									<?php
										$image = get_post_thumb($post->ID, 354, 212);
									?> 
                                    <li data-thumb-alt=""
                                        style="width: 200px; margin-right: 20px; float: left; display: block;">
                                        <div class="item_news_xemnhieu">
                                            <div class="thumb_news relative">
                                                <div class="thunb_image thumb_5x3"><a
                                                            href="<?php echo get_the_permalink($post->ID); ?>  "><img
                                                                src="<?php echo $image['src']; ?>"
                                                                alt="<?php echo get_the_title($post->ID); ?>"
                                                                draggable="false"></a>
                                                </div>

                                            </div>
                                            <h2 class="title_news_xemnhieu"><a
                                                        href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
                                            </h2>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <ol class="flex-control-nav flex-control-paging">
                            <li><a href="#" class="flex-active">1</a></li>
                            <li><a href="#" class="">2</a></li>
                        </ol>
                        <ul class="flex-direction-nav">
                            <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li>
                            <li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li>
                        </ul>
                    </div>
                    <div class="clear-fixed"></div>
                </div>
            </div>
            <?php
            $i++;
        endif;
    } ?>
    <div class="list_news_folder space_bottom_20 width_common">
        <div class="list_sub_news width_common">
            <?php
            while (have_posts()) {
                the_post(); ?>
                <?php if ($i > 2 && $i < 10) : ?>
				<?php
							  $image = get_post_thumb(get_the_ID(), 354, 212);
							?>
                    <div class="item_list_news_folder">
                        <div class="block_thumb_news">
                            <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><img alt=""
                                                                                                  src="<?php echo $image['src'] ?>"></a>
                        </div>
                        <h2 class="title_box_news">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h2>
                        <h4 class="lead_box_news"><?php the_excerpt() ?></h4>
                    </div>
                    <?php
                endif;
                $i++;
            } ?>
        </div>
<div class="nav-previous alignleft"></div>
        <div class="width_common block_banner_640"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_640x90.jpg" alt=""></div>
        <div class="block_xemthem text-right">
			<?php next_posts_link( "<i class='fa fa-caret-down'></i>" .' Xem thêm' ); ?>
        </div>
    </div>
</div>
