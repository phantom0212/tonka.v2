<div id="row">
    <?php
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
                    <!--                        <div class="block_social_page">-->
                    <!--                            <div class="pull-left social_left"><img src="images/graphics/img_like_share_fb.jpg" alt="">-->
                    <!--                            </div>-->
                    <!--                            <div class="pull-right social_right"><span><img-->
                    <!--                                            src="images/graphics/img_chat_fb.jpg"></span>-->
                    <!--                                <a href="#" class="btn_send_email_deatail"><i class="fa fa-envelope"></i></a>-->
                    <!--                            </div>-->
                    <!--                            <div class="clearfix"></div>-->
                    <!--                        </div>-->
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
                        <!--                            <div class="pull-left social_left"><img src="images/graphics/img_like_share_fb.jpg" alt="">-->
                        <!--                            </div>-->
                        <!--                            <div class="pull-right social_right"><span><img-->
                        <!--                                            src="images/graphics/img_chat_fb.jpg"></span>-->
                        <!--                                <a href="#" class="btn_send_email_deatail"><i class="fa fa-envelope"></i></a>-->
                        <!--                            </div>-->
                        <!--                            <div class="clearfix"></div>-->
                    </div>

                    <div class="block_tag_page_detail">
                        <span>Tag</span>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name?></a>
                        <?php endforeach; ?>
                    </div>

                    <div id="box_tin_lienquan_detail" class="item_box_col_right space_bottom_10">
                        <div class="title_box"><h3><a href="#">tin liên quan</a></h3>
                            <div class="block_xemthem text-right">
                                <a href="#" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                            </div>
                        </div>
                        <div class="content_box">
                            <h5 class="item_tinlienquan_detail"><a href="#">khó cứu được lá gan trở lại trạng thái
                                    ban đầu.</a> <span class="txt_666">(22/12/2017)</span></h5>
                            <h5 class="item_tinlienquan_detail"><a href="#">khó cứu được lá gan trở lại trạng thái
                                    ban đầu.</a> <span class="txt_666">(22/12/2017)</span></h5>
                            <h5 class="item_tinlienquan_detail"><a href="#">khó cứu được lá gan trở lại trạng thái
                                    ban đầu.</a> <span class="txt_666">(22/12/2017)</span></h5>
                        </div>
                    </div>

                    <div id="box_comment" class="space_bottom_20">
                        <img src="images/graphics/img_comment.jpg" alt="" width="100%">
                    </div>

                </div>
            </div>

        </div>
        <?php
    endwhile;
    ?>
    <?php get_sidebar(); ?>
</div>