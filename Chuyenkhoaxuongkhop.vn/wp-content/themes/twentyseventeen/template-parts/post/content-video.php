<?php
/**
 * Template part for displaying video posts
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

<?php $cate = get_the_category(get_the_ID());  ?>

<div id="wrapper_container">
    <div class="container">
        <div id="video_page">
            <div class="row">
                <?php $OTduplicateArray = array(); ?>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                    <div id="video_hot" class="space_bottom_10">
                        <div class="title_box"><h3><a class="text-uppercase">Kho video</a></h3></div>
                        <div class="content_box">

                            <div class="block_videohot width_common">
                                <div class="block_thumb_video width_common">
                                    <center>
                                        <?php
                                        try {
                                            if (strpos(get_the_content(), 'iframe')) {
                                                the_content();
                                            }else{
                                                $code = explode('watch?v=',get_the_content());
                                                $code = $code[1];
                                                echo '<iframe width="100%" height="350" src="https://www.youtube.com/embed/'.$code.'" frameborder="0" allowfullscreen></iframe>';
                                            }

                                        }catch(Exception $e){

                                        }
                                        ?>

                                    </center>
                                </div>
                                <h1 class="title_box_video_hot width_common">
                                    <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                                </h1>
                                <div class="cate_video txt_666 width_common space_bottom_10"><a href=""
                                                                                                class="txt_site"><?php the_category(', '); ?></a>
                                    - <?php echo get_the_date('d/m/Y H:i:s'); ?></div>

                                <div class="block_social_page">

                                    <?php $curr_url = get_permalink(); ?>
                                    <div class="pull-left social_left">
                                        <div class="fb-like" data-href="<?php echo $curr_url; ?>" data-layout="standard"
                                             data-action="like" data-size="small" data-show-faces="false"
                                             data-share="true"></div>
                                    </div>
                                    <div class="pull-right social_right">
                                        <!--                                    <span>-->
                                        <!--                                        <img-->
                                        <!--                                                src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/graphics/img_chat_fb.jpg"/></span>-->
                                        <!--                                    <a href="javascript:void(0)" class="btn_send_email_deatail"><i-->
                                        <!--                                                class="fa fa-envelope"></i></a>-->
                                    </div>
                                    <div id="box_comment" class="space_bottom_20">
                                        <?php //$curr_url?>
                                        <div class="fb-comments" data-href="<?php echo $curr_url; ?>" data-numposts="5"
                                             data-width="100%"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <?php
                $args = array('posts_per_page' => 5, 'order' => 'DESC', 'orderby' => 'post_date','category' => VIDEONOIBAT);
                $featured = get_posts($args);
                $category_link = get_category_link(VIDEONOIBAT);

                ?>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
                    <div id="box_video_noibat" class="space_bottom_20 width_common">
                        <div class="title_box">
                            <h3><a href="<?php echo esc_url($category_link); ?>">Video nổi bật</a></h3>
                            <div class="icon_title"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/ico_video.png" alt=""></div>
                        </div>
                        <div class="content_box_video width_common">
                            <div class="list_video_noibat width_common">
                                <?php $stt = 0; ?>
                                <?php foreach ($featured as $post) :
                                    setup_postdata($post);
                                    $image = get_post_thumb(get_the_ID(), 354, 212);
                                    $src = $image['src'];
                                    ?>
                                    <div class="item_video_noibat <?php if($stt==0) echo 'active'; ?> ">
                                        <div class="item_video relative format_video">
                                            <div class="thumb_video relative">
                                                <div class="thunb_image thumb_5x3"><a href="<?php the_permalink(); ?>"><img
                                                                alt="no image"
                                                                src="<?php echo $src ?>"></a></div>
                                                <a href="<?php the_permalink(); ?>" class="masking_video1"> <i class="fa fa-play" aria-hidden="true"></i></a>
                                                <a href="<?php the_permalink(); ?>" class="masking_video2"> &nbsp;</a>
                                            </div>
                                            <h3 class="title_video"><a href="<?php the_permalink(); ?>" class="four-lines"> <?php the_title(); ?></a></h3>
                                        </div>
                                    </div>
                                    <?php
                                    $stt++;
                                endforeach;
                                wp_reset_postdata(); ?>
                            </div>
                            <div class="width_common block_btn_pagination_video text-center">
                                <a href="" class="btn_pagination"><i class="fa fa-caret-up"></i></a> <a href="" class="btn_pagination"><i class="fa fa-caret-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block_banner_960x90 width_common text-center space_bottom_20">
                <?php dynamic_sidebar('sidebar-2') ?>
            </div>

            <div id="box_video_khac" class="width_common space_bottom_20">
                <div class="title_box_video width_common">
                    <?php $category_link = get_category_link(KHOVIDEO); ?>
                    <a class="text_title_box" href="<?php echo $category_link; ?>">video khác</a>
                </div>
                <div class="content_box_video width_common">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php global $post;
                            $args = array('posts_per_page' => 6, 'order' => 'DESC', 'orderby' => 'post_date', 'post__not_in' => $OTduplicateArray, 'category' => KHOVIDEO);
                            $postslist = get_posts($args);
                            $stt = 0; ?>

                            <?php foreach ($postslist as $post) :
                                setup_postdata($post);
                                $image = get_post_thumb(get_the_ID(), 300, 200);
                                $src = $image['src'];
                                ?>

                                <li>
                                    <div class="item_video format_video">
                                        <div class="thumb_video relative">
                                            <div class="thunb_image thumb_5x3"><img
                                                        alt="no image"
                                                        src="<?php echo $src ?>"></div>
                                            <a href="<?php echo the_permalink() ?>" class="masking_video1">
                                                &nbsp;</a>
                                            <a href="<?php echo the_permalink() ?>" class="masking_video2">
                                                &nbsp;</a>
                                        </div>
                                        <h2 class="title_video"><a
                                                    href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                                        </h2>
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
