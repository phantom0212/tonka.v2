<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1809357332636523";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

<?php $cate = get_the_category(get_the_ID()); ?>
<?php if (isset($cate) && $cate[0]->term_id != KHOVIDEO) { ?>
    <div id="wrapper_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
                    <div class="breadcrumb">

                        <?php $cate = get_the_category(get_the_ID());
                        if (isset($cate)) {
                            $cate = $cate[0]->term_id;
                        } else {
                            $cate = 1;
                        } ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a> <i
                            class="fa fa-caret-right"></i> <?php echo get_category_parents($cate, true, ' '); ?>
                    </div>
                    <div id="detail_page">
                        <div id="box_detail">
                            <h1 class="title_detail_page"><?php the_title() ?></h1>
                            <div class="author_detail_page"><b><?php the_author(); ?></b>
                                | <?php the_date('l ,d/m/Y H:i:s', '', ''); ?>
                            </div>
                            <div class="block_social_page">

                                <?php $curr_url = get_permalink(); ?>
                                <div class="pull-left social_left">
                                    <div class="fb-like" data-href="<?php echo $curr_url; ?>" data-layout="standard"
                                         data-action="like" data-size="small" data-show-faces="false"
                                         data-share="true"></div>
                                </div>
                                <div class="pull-right social_right"><span><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/images/graphics/img_chat_fb.jpg"/></span>
                                    <a href="javascript:void(0)" class="btn_send_email_deatail"><i
                                            class="fa fa-envelope"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <h3 class="lead_detail_page"><?php the_excerpt() ?></h3>
                            <div class="relative_news_detail">
                                <?php
                                //for use in the loop, list 5 post titles related to first tag on current post
                                $tags = wp_get_post_tags(get_the_ID());
                                if ($tags) {
                                    $first_tag = $tags[0]->term_id;
                                    $args = array(
                                        'tag__in' => array($first_tag),
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page' => 7,
                                        'caller_get_posts' => 1
                                    );
                                    $my_query = new WP_Query($args);
                                }
                                $relate = 0; ?>

                                <?php if (isset($my_query) && $my_query->have_posts()) {
                                    while ($my_query->have_posts()) : $my_query->the_post(); ?>

                                        <div class="item_relative_news"><a
                                                href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                                        <?php
                                        $relate++;
                                        if ($relate = 2) break;
                                    endwhile;
                                }
                                wp_reset_query();
                                ?>

                            </div>
                            <div class="fck_detail">
                                <?php the_content() ?>
                            </div>
                            <div class="block_social_page social_bottom_detail">
                                <div class="pull-left social_left">
                                    <div class="fb-like" data-href="<?php echo $curr_url; ?>" data-layout="standard"
                                         data-action="like" data-size="small" data-show-faces="false"
                                         data-share="true"></div>
                                </div>
                                <div class="pull-right social_right"><span><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/images/graphics/img_chat_fb.jpg"/></span>
                                    <a href="javascript:void(0)" class="btn_send_email_deatail"><i
                                            class="fa fa-envelope"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="block_tag_page_detail">
                                <?php $tags = wp_get_post_tags(get_the_ID());
                                ?>
                                <span>Tag</span> <?php if ($tags) {
                                    foreach ($tags as $tag) {
                                        $tag_link = get_tag_link($tag->term_id); ?>
                                        <a href="<?php echo $tag_link; ?>"><?php echo $tag->name ?></a>
                                    <?php }
                                } ?>
                            </div>

                            <div id="box_tin_lienquan_detail" class="item_box_col_right space_bottom_10">
                                <div class="title_box"><h3><a href="#">tin liên quan</a></h3>
                                    <div class="block_xemthem text-right">
                                        <a href="#" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                                    </div>
                                </div>
                                <div class="content_box">

                                    <?php $relate = 0;
                                    if (isset($my_query) && $my_query->have_posts()) {
                                        while ($my_query->have_posts()) : $my_query->the_post();
                                            if ($relate > 2) ; ?>
                                            <h5 class="item_tinlienquan_detail"><a href="<?php the_permalink() ?>"
                                                                                   title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                <span class="txt_666">(<?php the_date('d-m-Y', '', ''); ?>)</span></h5>
                                            <?php
                                            $relate++;
                                        endwhile;
                                    }
                                    wp_reset_query();
                                    ?>

                                </div>
                            </div>

                            <div id="box_comment" class="space_bottom_20">
                                <div class="fb-comments" data-href="<?php echo $curr_url; ?>" data-numposts="5"
                                     data-width="100%"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12 space_bottom_10">
                    <?php get_sidebar() ?>
                </div>
            </div>

            <div class="block_banner_960x90 width_common text-center space_bottom_20">
                <?php dynamic_sidebar('sidebar-2'); ?>
            </div>
        </div>
    </div>
<?php } else { ?>

    <div id="wrapper_container">
        <div class="container">
            <div id="video_page">
                <div class="row">
                    <?php global $post;
                    $args = array('posts_per_page' => 6, 'order' => 'ASC', 'orderby' => 'title', 'category' => KHOVIDEO);
                    $postslist = get_posts($args);
                    $stt = 0; ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                        <div id="video_hot" class="space_bottom_10">
                            <div class="title_box"><h3><a class="text-uppercase">Kho video</a></h3></div>
                            <div class="content_box">

                                <div class="block_videohot width_common">
                                    <div class="block_thumb_video width_common">
                                        <a href="<?php echo the_permalink() ?>"><?php the_content() ?></a>
                                    </div>
                                    <h1 class="title_box_video_hot width_common">
                                        <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                                    </h1>
                                    <div class="cate_video txt_666 width_common space_bottom_10"><a href=""
                                                                                                    class="txt_site"><?php the_category(', '); ?></a>
                                        - <?php echo get_the_date('d/m/Y H:i:s'); ?></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                    $args = array(
                        'posts_per_page' => 5,
                        'meta_key' => 'meta-checkbox',
                        'meta_value' => 'yes',
                        'category' => KHOVIDEO
                    );
                    $featured = new WP_Query($args); ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
                        <div id="box_video_noibat" class="space_bottom_20 width_common">
                            <div class="title_box">
                                <h3><a href="">Video nổi bật</a></h3>
                                <div class="icon_title"><img
                                        src="<?php echo get_template_directory_uri() ?>/assets/images/icon/ico_video.png"
                                        alt=""></div>
                            </div>
                            <div class="content_box_video width_common">
                                <div class="list_video_noibat width_common">
                                    <?php if ($featured->have_posts()): while ($featured->have_posts()): $featured->the_post(); ?>
                                        <div class="item_video_noibat active">
                                            <div class="item_video relative format_video">
                                                <div class="thumb_video relative">
                                                    <div class="thunb_image thumb_5x3"><a
                                                            href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                                    </div>
                                                    <a href="<?php the_permalink(); ?>" class="masking_video1"> <i
                                                            class="fa fa-pause" aria-hidden="true"></i></a>
                                                    <a href="<?php the_permalink(); ?>" class="masking_video2">
                                                        &nbsp;</a>
                                                </div>
                                                <h3 class="title_video"><a
                                                        href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
                                            </div>
                                        </div>
                                    <?php endwhile;
                                    else: endif; ?>
                                </div>
                                <div class="width_common block_btn_pagination_video text-center">
                                    <a href="#" class="btn_pagination"><i class="fa fa-caret-up"></i></a> <a href="#"
                                                                                                             class="btn_pagination"><i
                                            class="fa fa-caret-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block_banner_960x90 width_common text-center space_bottom_20">
                    <?php dynamic_sidebar('sidebar-2') ?>
                </div>

                <!--                //Video khác-->

                <div id="box_video_khac" class="width_common space_bottom_20">
                    <div class="title_box_video width_common">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/ico_video.png"
                             class="icon_title">
                        <a class="text_title_box" href="#">video khác</a>
                    </div>
                    <div class="content_box_video width_common">
                        <div class="flexslider">
                            <ul class="slides">
                                <?php foreach ($postslist as $post) :
                                    setup_postdata($post); ?>
                                    <li>
                                        <div class="item_video format_video">
                                            <div class="thumb_video relative">
                                                <div class="thunb_image thumb_5x3"><?php the_post_thumbnail() ?>
                                                </div>
                                                <a href="<?php echo the_permalink() ?>" class="masking_video1">
                                                    &nbsp;</a>
                                                <a href="<?php echo the_permalink() ?>" class="masking_video2">
                                                    &nbsp;</a>
                                            </div>
                                            <h2 class="title_video"><a
                                                    href="<?php echo the_permalink() ?>"><?php the_title() ?></a></h2>
                                        </div>
                                    </li>
                                <?php endforeach;
                                wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>