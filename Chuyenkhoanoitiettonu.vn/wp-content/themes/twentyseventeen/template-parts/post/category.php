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

<?php global $post;
global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
$end = explode('/', rtrim($current_url, '/'));
$end = end($end);
$id_cate = get_category_by_slug($end);
$tag = get_term_by('slug', $end, 'post_tag');
$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; ?>

<?php if($end != NAME_KHOVIDEO){ ?>
<div id="wrapper_container">
    <div class="container">
        <div class="row">
             <?php
                if(isset($id_cate) && $id_cate != null){
                    if($end == NAME_TINMOINHAT) {
                        $args = array('posts_per_page' => 11, 'order' => 'DESC', 'orderby' => 'post_date','paged'=>$paged);
                        $postslist_cate = get_posts($args);
                    }else if($end == NAME_TINXEMNHIEU) {
                        $defaults = array(
                        'number_of_posts'		 => 11,
                        'post_type'				 => array( 'post' ),
                        'order'					 => 'desc',
                        'thumbnail_size'		 => 'thumbnail',
                        'show_post_views'		 => true,
                        'show_post_thumbnail'	 => false,
                        'show_post_excerpt'		 => false,
                        'no_posts_message'		 => __( 'No Posts', 'post-views-counter' )
                    );

                    $args = apply_filters( 'pvc_most_viewed_posts_args', wp_parse_args( $args, $defaults ) );

                    $args['show_post_views'] = (bool) $args['show_post_views'];
                    $args['show_post_thumbnail'] = (bool) $args['show_post_thumbnail'];
                    $args['show_post_excerpt'] = (bool) $args['show_post_excerpt'];

                    $postslist_cate = pvc_get_most_viewed_posts(
                        array(
                            'posts_per_page' => (isset( $args['number_of_posts'] ) ? (int) $args['number_of_posts'] : $defaults['number_of_posts']),
                            'order'			 => (isset( $args['order'] ) ? $args['order'] : $defaults['order']),
                            'post_type'		 => (isset( $args['post_type'] ) ? $args['post_type'] : $defaults['post_type']),
                            'paged'=>$paged
                        )
                    );
                    }else{
                        $args = array('posts_per_page' => 11, 'order' => 'DESC', 'orderby' => 'post_date','paged'=>$paged , 'category' => $id_cate->term_id);
                    $postslist_cate = get_posts($args);
                    }
                }else{
                    $args = array('posts_per_page' => 11, 'order' => 'DESC', 'orderby' => 'post_date','paged'=>$paged ,'tag_id' => $tag->term_id);
                    $postslist_cate = get_posts($args);
                }
                
                $stt=0; ?>

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
                <div class="breadcrumb">
                    <a href="<?php echo home_url('/'); ?>">Trang chủ</a> <i class="fa fa-caret-right"></i> <a class="active_breadcrumb">
                        <?php
                        if($end == 'bai-viet-moi-nhat') {
                            echo 'Bài viết mới nhất';
                        }else if($end == 'tin-xem-nhieu') {
                            echo 'Tin xem nhiều';
                        }else{
                           echo $id_cate->name;
                        }
                    ?></a>
                </div>
                <?php foreach ($postslist_cate as $post) :
                setup_postdata($post); if($stt==0){
                    $image = get_post_thumb(get_the_ID(), 336, 200);
                    $src = $image['src'];
                    ?>
                <div id="box_hot_folder" class="space_bottom_20">
                    <div class="content_box">
                        <div class="block_news width_common">
                            <div class="block_thumb_news">
                                <a class="thunb_image thumb_5x3" href="<?php echo the_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                            </div>
                            <h2 class="title_box_news">
                                <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                            </h2>
                            <h4 class="lead_box_news">
                                <?php
                                if(get_post_meta(get_the_ID(),'description', true) !=""){
                                    $des =  get_post_meta(get_the_ID(),'description')[0];
                                    echo wp_trim_words( $des, 56, null );
                                }else{
                                    $myExcerpt = get_the_excerpt();
                                    $tags = array("<p>", "</p>");
                                    $myExcerpt = str_replace($tags, "", $myExcerpt);
                                    echo $myExcerpt;
                                }  ?>
                            </h4>
                        </div>
                    </div>
                </div>
                    <?php } $stt++; if($stt ==1) break;
                endforeach; ?>

                <?php
                if($end != NAME_TINXEMNHIEU) {
                    $defaults = array(
                        'number_of_posts' => 6,
                        'post_type' => array('post'),
                        'order' => 'desc',
                        'thumbnail_size' => 'thumbnail',
                        'show_post_views' => true,
                        'show_post_thumbnail' => false,
                        'show_post_excerpt' => false,
                        'no_posts_message' => __('No Posts', 'post-views-counter')
                    );

                    $args = apply_filters('pvc_most_viewed_posts_args', wp_parse_args($args, $defaults));

                    $args['show_post_views'] = (bool)$args['show_post_views'];
                    $args['show_post_thumbnail'] = (bool)$args['show_post_thumbnail'];
                    $args['show_post_excerpt'] = (bool)$args['show_post_excerpt'];

                    $postslist = pvc_get_most_viewed_posts(
                        array(
                            'posts_per_page' => 8,
                            'order' => (isset($args['order']) ? $args['order'] : $defaults['order']),
                            'post_type' => (isset($args['post_type']) ? $args['post_type'] : $defaults['post_type'])
                        )
                    );
                }else{
                    $args = array('posts_per_page' => 8, 'order' => 'DESC', 'orderby' => 'post_date');
                    $postslist = get_posts($args);
                }
                ?>
                <div id="box_tinxemnhieu_folder" class="width_common space_bottom_20">
                    <?php if($end != NAME_TINXEMNHIEU) { ?>
                        <div class="title_box"><h3><a href="<?php echo get_site_url().SLUG_TINXEMNHIEU; ?>">Tin xem nhiều</a></h3></div>
                    <?php }else{ ?>
                        <div class="title_box"><h3><a href="<?php echo get_site_url().SLUG_TINMOINHAT; ?>">Tin mới nhất</a></h3></div>
                    <?php } ?>
                    <div class="content_box">
                        <div class="flexslider">
                            <ul class="slides">
                                <?php foreach ($postslist as $post) :
                                    setup_postdata($post);
                                    $image = get_post_thumb(get_the_ID(), 300, 200);
                                    $src = $image['src'];
                                    ?>
                                    <li>
                                        <div class="item_news_xemnhieu">
                                            <div class="thumb_news relative">
                                                <div class="thunb_image thumb_5x3"><a href="<?php  the_permalink() ?>"><img
                                                                alt="no image"
                                                                src="<?php echo $src ?>"></a></div>

                                            </div>
                                            <h2 class="title_news_xemnhieu"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                        </div>
                                    </li>
                                    <?php
                                endforeach;
                                wp_reset_postdata(); ?>

                            </ul>
                        </div>
                        <div class="clear-fixed"></div>
                    </div>
                </div>

                <div class="list_news_folder space_bottom_20 width_common">
                    <div class="list_sub_news width_common">
                        <?php $stt=0; ?>
                        <?php foreach ($postslist_cate as $post) :
                        setup_postdata($post);
                            $image = get_post_thumb(get_the_ID(), 250, 150);
                            $src = $image['src'];
                        if($stt !=0){ ?>
                        <div class="item_list_news_folder">
                            <div class="block_thumb_news">
                                <a class="thunb_image thumb_5x3" href="<?php echo the_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                            </div>
                            <h2 class="title_box_news">
                                <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                            </h2>
                            <h4 class="lead_box_news">
                                <?php
                                if(get_post_meta(get_the_ID(),'description', true) !=""){
                                    $des =  get_post_meta(get_the_ID(),'description')[0];
                                    echo wp_trim_words( $des, 48, null );
                                }else{
                                    $myExcerpt = get_the_excerpt();
                                    $tags = array("<p>", "</p>");
                                    $myExcerpt = str_replace($tags, "", $myExcerpt);
                                    echo $myExcerpt;
                                }  ?>
                            </h4>
                        </div>
                            <?php if($stt%11 == 1){ ?>
                            <div class="item_list_news_folder">
                               <?php //dynamic_sidebar('quangcao'); ?>
							   <div class="textwidget"><p><a href="javascript:void(0)"><img src="http://chuyenkhoanoitiettonu.vn/wp-content/themes/twentyseventeen/630x90.jpg" alt=""></a></p>
</div>
                            </div>
                                <?php } ?>
                        <?php } $stt++;
                        endforeach;
                        wp_reset_postdata(); ?>
                    </div>

                    <?php
                    global $wp;
                    $current_url = add_query_arg( '', '', home_url( $wp->request ) );
                    ?>

                    <?php if(count($postslist_cate) >= 11){ ?>
                    <div class="block_xemthem text-right">
                        <a href="<?php echo $current_url.'?page='.($paged+1);  ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12 space_bottom_10">
                <?php  get_sidebar() ?>
            </div>
        </div>

        <div class="block_banner_960x90 width_common text-center space_bottom_20">


            <?php dynamic_sidebar('sidebar-2'); ?>
        </div>
    </div>
</div>

<?php }else{ ?>
    <?php $OTduplicateArray = array(); ?>
    <div id="wrapper_container">
        <div class="container">
            <div id="video_page">
                <div class="row">
                    <?php global $post;
                    $stt=0;
                    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
                    $args = array('posts_per_page' => 13, 'order' => 'DESC', 'orderby' => 'post_date' ,'paged'=> $paged, 'category' => KHOVIDEO);
                    $postslist = get_posts($args);  ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                        <div id="video_hot" class="space_bottom_10">
                            <div class="title_box"><h3><a class="text-uppercase">Kho video</a></h3></div>
                            <div class="content_box">
                                <?php foreach ($postslist as $post) :
                                    setup_postdata($post);  $image = get_post_thumb(get_the_ID(), 633, 380);
                                    $src = $image['src']; ?>
                                    <div class="block_videohot width_common">
                                        <div class="block_thumb_video width_common">
                                            <div class="item_video relative format_video">
                                                <div class="thumb_video relative">
                                                    <div class="thunb_image thumb_5x3"><a href="<?php echo the_permalink() ?>"><img
                                                            alt="no image"
                                                            src="<?php echo $src ?>"></a></div>
                                                    <a href="<?php echo the_permalink() ?>" class="masking_video1"></a>
                                                    <a href="<?php echo the_permalink() ?>" class="masking_video2"> &nbsp;</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="title_box_video_hot width_common">
                                            <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                                        </h1>
                                        <div class="cate_video txt_666 width_common space_bottom_10"><a href="" class="txt_site"><?php the_category(', '); ?></a> - <?php echo get_the_date('d/m/Y H:i:s'); ?></div>
                                    </div>
                                <?php $stt++; if($stt == 1) break;  endforeach; wp_reset_postdata(); ?>
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
                                    <li>
                                        <div class="list_video_noibat width_common">
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
                                        </div>

                                        <div class="clearfix"></div>
                                    </li>
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
                <div class="row" id="block_cate_video">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-tn-12 space_bottom_10">
                        <div class="list_video_folder">

                            <?php $stt=0;  foreach ($postslist as $post) :
                                setup_postdata($post);
                                $image = get_post_thumb(get_the_ID(), 250, 150);
                                $src = $image['src'];

if($stt!=0){ ?>
                                <div class="item_video_noibat">
                                    <div class="item_video relative format_video">
                                        <div class="thumb_video relative">
                                            <div class="thunb_image thumb_5x3"><a href="<?php the_permalink() ?>"><img
                                                            alt="no image"
                                                            src="<?php echo $src ?>"</a></div>
                                            <a href="<?php the_permalink() ?>" class="masking_video1"> &nbsp;</a>
                                            <a href="<?php the_permalink() ?>" class="masking_video2"> &nbsp;</a>
                                        </div>
                                        <h3 class="title_video"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                    </div>
                                </div>
                            <?php  } $stt++; endforeach; wp_reset_postdata(); ?>
                        </div>

                        <?php
                        $current_url = add_query_arg( '', '', home_url( $wp->request ) );
                        $paged = $paged+1; ?>
                        <?php if(count($postslist)>=13){ ?>
                            <div class="block_xemthem text-right">
                                <a href="<?php echo $current_url.'?page='.$paged; ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                            </div>
                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>
    </div>
<?php } ?>
