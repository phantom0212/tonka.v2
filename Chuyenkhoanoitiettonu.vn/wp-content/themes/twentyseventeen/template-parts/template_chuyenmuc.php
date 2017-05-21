<?php
get_header(); ?>

<div id="wrapper_container">
    <div class="container">
        <div class="row">

            <?php global $post;

            global $wp;
            $current_url = home_url(add_query_arg(array(),$wp->request));
            $end = explode('/', rtrim($current_url, '/'));
            $end = end($end);
            $id_cate = get_category_by_slug($end);
            $tag = get_term_by('slug', $end, 'post_tag');
            $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
            if(isset($id_cate) && $id_cate != null){
                if($end == 'bai-viet-moi-nhat') {
                    $args = array('posts_per_page' => 11, 'order' => 'DESC', 'orderby' => 'post_date','paged'=>$paged);
                }else if($end == 'tin-xem-nhieu') {
                    $args = array(
                        'numberposts' => 11,  /* get 4 posts, or set -1 to display all posts */
                        'orderby' => 'meta_value',  /* this will look at the meta_key you set below */
                        'meta_key' => 'post_views_count',
                        'order' => 'DESC',
                        'paged'=>$paged ,
                        'post_type' => 'post',
                        'post_status' => 'publish'
                    );
                }else{
                    $args = array('posts_per_page' => 11, 'order' => 'DESC', 'orderby' => 'post_date','paged'=>$paged , 'category' => $id_cate->term_id);
                }
            }else{
                $args = array('posts_per_page' => 11, 'order' => 'DESC', 'orderby' => 'post_date','paged'=>$paged ,'tag_id' => $tag->term_id);
            }
            $postslist_cate = get_posts($args);
            $stt=0; ?>

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
                <div class="breadcrumb">
                    <a href="<?php echo home_url('/'); ?>">Trang chủ</a> <i class="fa fa-caret-right"></i> <a class="active_breadcrumb"><?php echo $id_cate->name; ?></a>
                </div>
                <?php foreach ($postslist_cate as $post) :
                    setup_postdata($post); if($stt==0){ ?>
                    <div id="box_hot_folder" class="space_bottom_20">
                        <div class="content_box">
                            <div class="block_news width_common">
                                <div class="block_thumb_news">
                                    <a class="thunb_image thumb_5x3" href="<?php echo the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                </div>
                                <h2 class="title_box_news">
                                    <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                                </h2>
                                <h4 class="lead_box_news"><?php the_excerpt() ?></h4>
                            </div>
                        </div>
                    </div>
                <?php } $stt++; if($stt ==1) break;
                endforeach; ?>

                <?php global $post;
                $args    = array(
                    'numberposts' => 6,  /* get 4 posts, or set -1 to display all posts */
                    'orderby'     => 'meta_value',  /* this will look at the meta_key you set below */
                    'meta_key'    => 'post_views_count',
                    'order'       => 'DESC',
                    'post_type'   => 'post',
                    'post_status' => 'publish'
                );
                $postslist = get_posts( $args ); ?>
                <div id="box_tinxemnhieu_folder" class="width_common space_bottom_20">
                    <div class="title_box"><h3><a href="<?php echo get_site_url() ?>/category/tin-xem-nhieu">Tin xem nhiều</a></h3></div>
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
                            $image = get_post_thumb(get_the_ID(), 200, 120);
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
                                    <h4 class="lead_box_news"><?php the_excerpt() ?></h4>
                                </div>
                            <?php } $stt++;
                        endforeach;
                        wp_reset_postdata(); ?>
                    </div>

                    <?php
                    global $wp;
                    $current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
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

<?php get_footer(); ?>
