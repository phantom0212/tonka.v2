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
<?php global $post;
global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
$end = explode('/', rtrim($current_url, '/'));
$end = end($end);
$id_cate = get_category_by_slug($end);
$tag = get_term_by('slug', $end, 'post_tag');
$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; ?>

<div id="wrapper_container">
    <div class="container">
        <div id="video_page">
            <div class="row">
                <?php $OTduplicateArray = array(); ?>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                    <div id="video_hot" class="space_bottom_10">
                        <div class="title_box">
                            <h3><a href="<?php  echo '/chuyen-muc/kho-video'; ?>" class="text-uppercase">Kho video</a> <i class="fa fa-caret-right"></i> <a class="txt_site"></a></h3>
                        </div>
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
                                <div class="cate_video txt_666 width_common space_bottom_10"><a href="" class="txt_site"><?php the_category(', '); ?></a> - <?php echo get_the_date('d/m/Y H:i:s'); ?></div>
                            </div>
							<div class="block_social_page social_bottom_detail">
                        <div class="pull-left social_left">
                            <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>" data-layout="standard"
                                 data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                            <div class="lead_video">
                                <?php
                                if(get_post_meta(get_the_ID(),'description', true) !=""){
                                    $des =  get_post_meta(get_the_ID(),'description')[0];
                                    echo $des;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $args = array('posts_per_page' => 8, 'order' => 'DESC', 'orderby' => 'post_date','category' => VIDEONOIBAT);
                $featured = get_posts($args);
                $category_link = get_category_link(VIDEONOIBAT);
                ?>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
                    <div id="box_video_noibat" class="space_bottom_20 width_common">
                        <div class="title_box">
                            <h3><a href="<?php echo $category_link; ?>">Video nổi bật</a></h3>
                            <div class="icon_title"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/ico_video.png" alt=""></div>
                        </div>
                        <div class="content_box_video width_common">
                            <ul class="bxslider">
                                <?php $stt = 0; ?>
                                <?php foreach ($featured as $post) :
                                    setup_postdata($post);
                                    $image = get_post_thumb(get_the_ID(), 354, 212);
                                    $src = $image['src'];
                                    ?>
                                    <?php if($stt%4 ==0){ ?>       <li>
                                    <div class="list_video_noibat width_common">  <?php } ?>
                                    <div class="item_video_noibat">
                                        <div class="item_video relative format_video">
                                            <div class="thumb_video relative">
                                                <div class="thunb_image thumb_5x3"><a href="<?php the_permalink(); ?>"><img
                                                                alt="no image"
                                                                src="<?php echo $src ?>"></a></div>
                                                <a href="<?php the_permalink(); ?>" class="masking_video1"> <i class="fa fa-pause" aria-hidden="true"></i></a>
                                                <a href="<?php the_permalink(); ?>" class="masking_video2"> &nbsp;</a>
                                            </div>
                                            <h3 class="title_video"><a href="<?php the_permalink(); ?>" class="four-lines"> <?php the_title(); ?></a></h3>
                                        </div>
                                    </div>
                                    <?php if($stt%4 ==0){ ?>       </div>

                                    <div class="clearfix"></div>
                                    </li>  <?php } ?>
                                    <?php
                                    $stt++;
                                endforeach;
                                wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block_banner_960x90 width_common text-center space_bottom_20">
                <?php dynamic_sidebar('sidebar-2') ?>
            </div>

            <div id="box_video_khac" class="width_common space_bottom_20">
                <div class="title_box_video width_common">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/ico_video.png"
                         class="icon_title">
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