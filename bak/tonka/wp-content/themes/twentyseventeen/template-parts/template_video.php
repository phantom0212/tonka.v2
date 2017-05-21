<?php
/*
Template Name: Kho video
*/
get_header(); ?>

    <div id="wrapper_container">
        <div class="container">
            <div id="video_page">
                <div class="row">
                    <?php global $post;
                    $args = array('posts_per_page' => 13, 'order' => 'ASC', 'orderby' => 'title', 'category' => KHOVIDEO);
                    $postslist = get_posts($args); $stt = 0; ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                        <div id="video_hot" class="space_bottom_10">
                            <div class="title_box"><h3><a class="text-uppercase">Kho video</a></h3></div>
                            <div class="content_box">
                                <?php foreach ($postslist as $post) :
                                    setup_postdata($post);  if($stt ==0){ ?>
                                    <div class="block_videohot width_common">
                                        <div class="block_thumb_video width_common">
                                            <a href="<?php echo the_permalink() ?>"><?php the_post_thumbnail() ?></a>
                                        </div>
                                        <h1 class="title_box_video_hot width_common">
                                            <a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                                        </h1>
                                        <div class="cate_video txt_666 width_common space_bottom_10"><a href="" class="txt_site"><?php the_category(', '); ?></a> - <?php echo get_the_date('d/m/Y H:i:s'); ?></div>
                                    </div>
                                <?php } $stt++; if($stt == 1) break; endforeach; wp_reset_postdata(); ?>
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
                                <div class="icon_title"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/ico_video.png" alt=""></div>
                            </div>
                            <div class="content_box_video width_common">
                                <div class="list_video_noibat width_common">
                                    <?php   if ($featured->have_posts()): while($featured->have_posts()): $featured->the_post(); ?>
                                        <div class="item_video_noibat active">
                                            <div class="item_video relative format_video">
                                                <div class="thumb_video relative">
                                                    <div class="thunb_image thumb_5x3"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
                                                    <a href="<?php the_permalink(); ?>" class="masking_video1"> <i class="fa fa-pause" aria-hidden="true"></i></a>
                                                    <a href="<?php the_permalink(); ?>" class="masking_video2"> &nbsp;</a>
                                                </div>
                                                <h3 class="title_video"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
                                            </div>
                                        </div>
                                    <?php  endwhile; else: endif; ?>
                                </div>
                                <div class="width_common block_btn_pagination_video text-center">
                                    <a href="#" class="btn_pagination"><i class="fa fa-caret-up"></i></a> <a href="#" class="btn_pagination"><i class="fa fa-caret-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block_banner_960x90 width_common text-center space_bottom_20">
                    <?php dynamic_sidebar('sidebar-2') ?>
                </div>
                <div class="row" id="block_cate_video">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-tn-12 space_bottom_10 pull-right">
                        <div class="item_box_col_right space_bottom_10" id="block_category_video">

                            <?php
                            //                            $term_id = KHOVIDEO;
                            //                            $taxonomy_name = 'category';
                            //                            $term_children = get_term_children( $term_id, $taxonomy_name );
                            ?>

                            <?php //foreach ( $term_children as $child ) { $term = get_term_by( 'id', $child, $taxonomy_name ); ?>
                            <?php dynamic_sidebar('bar_khovideo'); ?>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 col-tn-12 space_bottom_10">
                        <div class="list_video_folder">
                            <?php $stt =0; foreach ($postslist as $post) :
                                setup_postdata($post);  if($stt !=0){ ?>
                                <div class="item_video_noibat">
                                    <div class="item_video relative format_video">
                                        <div class="thumb_video relative">
                                            <div class="thunb_image thumb_5x3"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a></div>
                                            <a href="<?php the_permalink() ?>" class="masking_video1"> &nbsp;</a>
                                            <a href="<?php the_permalink() ?>" class="masking_video2"> &nbsp;</a>
                                        </div>
                                        <h3 class="title_video"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                    </div>
                                </div>
                            <?php } $stt++; endforeach; wp_reset_postdata(); ?>
                        </div>
                        <div class="block_xemthem text-right">
                            <a href="" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>


<?php get_footer(); ?>