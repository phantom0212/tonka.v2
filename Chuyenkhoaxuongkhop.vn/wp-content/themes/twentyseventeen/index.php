<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
    <div id="wrapper_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
                    <div id="box_moinhat" class="space_bottom_10 box_common_site">
                        <div class="title_box"><h3><a href="<?php echo get_site_url() ?>/chuyen-muc/bai-viet-moi-nhat">Bài
                                    viết mới nhất</a></h3>
                        </div>
                        <div class="content_box">
                            <div class="block_news width_common">
                                <?php $the_query = new WP_Query(array('category__not_in' => SLIDERIGHT, 'posts_per_page' => 3));
                                $stt = 0; ?>
                                <?php if (have_posts()):while ($the_query->have_posts()) :
                                $the_query->the_post();
                                $image = get_post_thumb(get_the_ID(), 354, 212);
                                $src = $image['src'];
                                if ($stt == 0){ ?>
                                <div class="block_thumb_news">
                                    <a class="thunb_image thumb_5x3 top_img" href="<?php echo get_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                                </div>
                                <h2 class="title_box_news">
                                    <a href="<?php echo get_permalink() ?>"><?php the_title() ?></a>
                                </h2>
                                <h4 class="lead_box_news">
                                    <?php if (count(get_post_meta(get_the_ID(), 'description')) > 0) {
                                        $des = get_post_meta(get_the_ID(), 'description')[0];
                                        echo wp_trim_words($des, 48, null);
                                    } else {
                                        echo wp_trim_words(get_the_excerpt(), 48, null);
                                    } ?>
                                </h4>
                            </div>
                            <div class="list_sub_news width_common">
                                <?php } else { ?>
                                <div class="item_sub_news">
                                    <div class="block_thumb_news">
                                        <a class="thunb_image thumb_5x3 detail"
                                           href="<?php echo get_permalink() ?>"><img
                                                alt=""
                                                src="<?php echo $src ?>"></a>
                                    </div>
                                    <h2 class="title_box_news">
                                        <a href="<?php echo get_permalink() ?>"><?php the_title() ?></a>
                                    </h2>
                                    <h4 class="lead_box_news"><?php the_excerpt() ?></h4>
                                    <?php
                                    }
                                    $stt++;
                                    endwhile ?>
                                </div>
                                <?php endif ?>
                            </div>
                            <div class="block_xemthem text-right">
                                <a href="<?php echo get_site_url() ?>/chuyen-muc/bai-viet-moi-nhat" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
               

                <?php global $post;
                $args = array('posts_per_page' => 4, 'order' => 'ASC', 'orderby' => 'title', 'category' => KIENTHUCBENHHOC);
                $category = get_term(KIENTHUCBENHHOC, 'category');
                $link_cate = get_category_parents_custom(KIENTHUCBENHHOC, true, ''); ?>
                <div id="box_kienthuc_benhhoc" class="box_common_site">
                    <div class="title_box_common">
                        <h3 class="wap_title_box relative">
                            <div class="icon_title"><img
                                    src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_sach.png">
                            </div>
                            <a class="text_title_box"
                               href="<?php echo $link_cate; ?>"><?php echo $category->name; ?></a>
                        </h3>

                    </div>

                    <div class="content_box_common width_common">
                        <div class="row">
                            <?php $list_cate = getChildCate(KIENTHUCBENHHOC);
                            if (isset($list_cate)) {
                                foreach ($list_cate as $item => $value) { ?>
                                <?php if($value != 6 )  : ?>
                                    <?php global $post;
                                    $args = array('posts_per_page' => 3, 'order' => 'ASC', 'orderby' => 'title', 'category' => $value);
                                    $category = get_term($value, 'category');
                                    $link_cate = get_category_parents_custom($value, true, ''); ?>
                                    <div class="item_block_2_row">
                                        <div class="border_bottom_block width_common">

                                            <div class="block_group_benh width_common">
                                                <div class="block_thumb_news">
                                                    <a class="thunb_image thumb_1x1" href="<?php echo $link_cate; ?>"><img alt=""
                                                                                                   src="<?php echo get_theme_file_uri(); ?>/assets/images/graphics/img_160x160.jpg"></a>
                                                </div>
                                                <h2 class="title_group_benh">
                                                    <a href="<?php echo $link_cate; ?>"><?php echo $category->name; ?></a>
                                                </h2>
                                            </div>
                                            <div class="list_news_box width_common">

                                                <?php $postslist = get_posts($args);
                                                $stt = 0; ?>
                                                <?php foreach ($postslist as $post) :
                                                    setup_postdata($post);
                                                    $image = get_post_thumb(get_the_ID(), 380, 212);
                                                    $src = $image['src'];
                                                    ?>

                                                    <div class="block_news width_common">
                                                        <div class="block_thumb_news">
                                                            <a class="thunb_image thumb_5x3 small_img"
                                                               href="<?php the_permalink() ?>">
                                                                <img alt="no image" src="<?php echo $src ?>">
                                                            </a>
                                                        </div>
                                                        <h2 class="title_box_news title_normal">
                                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                        </h2>

                                                    </div>
                                                    <?php

                                                endforeach;
                                                wp_reset_postdata(); ?>
                                            </div>

                                            <div class="block_xemthem text-right">
                                                <a href="<?php echo $link_cate; ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                        <?php endif;?>
                                <?php }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12">
                <?php global $post;
                $args = array('posts_per_page' => 3, 'order' => 'ASC', 'orderby' => 'title', 'category' => PHONGNGUA);
                $category = get_term(PHONGNGUA, 'category');
                $category_link = get_category_link(PHONGNGUA); ?>
                <div id="box_phongngua" class="item_box_col_right space_bottom_20 width_common">
                    <div class="title_box">
                        <h3><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a></h3>
                        <div class="icon_title"><img
                                src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_dieutri.png"
                                alt=""/></div>
                    </div>
                    <div class="content_box">
                        <div class="list_news_box_right ">
                            <?php $postslist = get_posts($args);
                            $stt = 0; ?>
                            <?php foreach ($postslist as $post) :
                                setup_postdata($post);
                                $image = get_post_thumb(get_the_ID(), 380, 212);
                                $src = $image['src'];
                                ?>
                                <div class="item_box_right width_common">
                                    <div class="block_news width_common">
                                        <div class="block_thumb_news">
                                            <a class="thunb_image thumb_5x3 small_img"
                                               href="<?php the_permalink() ?>"><img
                                                    alt="no image"
                                                    src="<?php echo $src ?>"></a>
                                        </div>
                                        <h2 class="title_box_news title_normal">
                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                        </h2>

                                    </div>
                                </div>

                                <?php
                                $stt++;
                            endforeach;
                            wp_reset_postdata(); ?>
                            <div class="clearfix"></div>
                        </div>

                        <div class="block_xemthem text-right">
                            <a href="<?php echo esc_url($category_link); ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div id="box_tuvan" class="item_box_col_right space_bottom_20 width_common">
                    <div class="title_box">
                        <h3><a href="<?php echo esc_url(home_url('/tu-van-chia-se')) ?>">Hỏi chuyên gia</a></h3>
                        <div class="icon_title"><img
                                src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_tuvan.png" alt=""/>
                        </div>
                    </div>

                    <div class="content_box_common width_common">
                        <div class="list_tuvan width_common">
                            <div class="item_tuvan width_common">
                                <?php echo do_shortcode('[dwqa-list-questions]'); ?>
                            </div>
                            <div class="block_txt_datcauhoi text-center"><a
                                    href="<?php echo esc_url(home_url('/tu-van-chia-se')) ?>"
                                    class="text-uppercase txt_16 txt_site"><b>đặt câu hỏi</b></a></div>
                        </div>
                    </div>
                </div>
                <?php global $post;
                $args = array('posts_per_page' => 1,  'order' => 'DESC', 'orderby' => 'post_date', 'category' => KHOVIDEO);
                $category = get_term(KHOVIDEO, 'category');
                $category_link = get_category_link(KHOVIDEO);

                ?>
                <div id="box_video" class="item_box_col_right space_bottom_20 width_common">
                    <div class="title_box">
                        <h3><a href="/kho-video"><?php echo $category->name;?></a></h3>
                        <div class="icon_title"><img
                                src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_video.png" alt=""/>
                        </div>
                    </div>
                    <div class="content_box_video width_common">
                        <?php $postslist = get_posts($args);
                        ?>
                        <?php foreach ($postslist as $post) :
                        setup_postdata($post);
                        $image = get_post_thumb(get_the_ID(), 380, 250);
                        $src = $image['src'];
                        ?>
                        <div class="item_video relative">
                            <div class="thumb_video relative">
                                
                                <div class="thunb_image thumb_5x3"><img
                                        alt="no image"
                                        src="<?php echo $src ?>">
                                </div>
                                <a href="<?php the_permalink(); ?>" class="masking_video1"> <i class="fa fa-pause" aria-hidden="true"></i></a>
                                <a href="<?php the_permalink(); ?>" class="masking_video2"> &nbsp;</a><a href="<?php echo the_permalink() ?>" class="masking_video1"> </a>
                            </div>
                            <h2 class="title_video"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
                            </h2>
                            <?php

                            endforeach;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block_banner_960x90 width_commo n text-center space_bottom_20">
            <a href="#"><img
                    src="<?php echo get_theme_file_uri(); ?>/assets/images/graphics/img_960x90.jpg"
                    alt=""/></a>
        </div>
    </div>




<?php get_footer();
