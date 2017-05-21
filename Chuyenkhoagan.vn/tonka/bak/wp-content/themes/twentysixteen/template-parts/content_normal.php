<div id="row">
    <?php
    $args = array('numberposts' => 3, 'offset' => 1);
    $posts_related = get_posts($args);

    // Start the loop.
    while (have_posts()) :
        the_post();
        $tags = get_the_tags();
        ?>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
            <div class="breadcrumb">
                <?php
                $bread = '';
                $i = 1;
                foreach (get_the_category() as $category) {

                    $bread .= '<i class="fa fa-caret-right"></i> <a href="' . get_category_link($category->term_id) . '" class="active_breadcrumb">' . $category->name . '</a>';
                    if ($i == 1) break;
                    $i++;
                };
                ?>
                <a href="/">Trang chủ</a> <?php echo $bread; ?>
            </div>
            <div id="detail_page">
                <div id="box_detail">
                    <h1 class="title_detail_page"><?php echo get_the_title(); ?></h1>
                    <div class="author_detail_page"><b><?php echo get_the_author_meta('nickname'); ?></b>
                        | <?php echo get_the_time() ?>
                    </div>
                    <div class="block_social_page">
                        <div class="pull-left social_left">
                            <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>" data-layout="standard"
                                 data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!--                        <h3 class="lead_detail_page">Theo các chuyên gia y tế, chức năng của gan là tham gia quá trình-->
                    <!--                            tiêu hóa, hấp thụ thức ăn tạo ra các chất quan trọng cho cơ thể, chuyển hóa các hoạt chất-->
                    <!--                            thuốc chữa bệnh, lọc máu, giải độc, bài tiết các độc tố từ cơ thể ra ngoài. Khi vào cơ thể-->
                    <!--                            rượu được chuyển hóa thành acetaldehyd, rất độc đối với gan.</h3>-->
                    <!--                        <div class="relative_news_detail">-->
                    <!--                            <div class="item_relative_news">Đã đến ngày công an nhận định nạn nhân Cát Tường nổi</div>-->
                    <!--                            <div class="item_relative_news">Đã đến ngày công an nhận định nạn nhân Cát Tường nổi</div>-->
                    <!--                        </div>-->
                    <div class="fck_detail">
                        <?php echo get_the_content(); ?>
                    </div>
                    <div class="block_social_page social_bottom_detail">
                        <div class="pull-left social_left">
                            <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>" data-layout="standard"
                                 data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php if (!empty($tags)) : ?>
                        <div class="block_tag_page_detail">
                            <span>Tag</span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div id="box_tin_lienquan_detail" class="item_box_col_right space_bottom_10">
                        <div class="title_box"><h3><a href="#">tin liên quan</a></h3>
                            <div class="block_xemthem text-right">
                                <a href="#" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                            </div>
                        </div>
                        <div class="content_box">
                            <?php foreach ($posts_related as $post) : ?>
                                <h5 class="item_tinlienquan_detail"><a href="<?php echo get_the_permalink($post->postID);?>"><?php echo $post->post_title ; ?></a> <span class="txt_666"><?php echo get_the_time($d = '', $post->postID)?></span></h5>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="box_comment" class="space_bottom_20">
                        <div class="fb-comments" data-href="<?php echo get_the_permalink(); ?>" data-numposts="5"></div>
                    </div>

                </div>
            </div>

        </div>
        <?php
    endwhile;
    ?>
    <?php get_sidebar(); ?>
</div>