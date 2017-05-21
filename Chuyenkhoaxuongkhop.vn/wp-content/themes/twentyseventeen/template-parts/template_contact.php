<?php
/*
Template Name: Liên hệ
*/
get_header(); ?>
    <div id="wrapper_container">
        <div class="container">
            <div id="lienhe_page">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                        <div id="lienhe_map" class="width_common space_bottom_20">
                            <div class="title_box"><h3><a class="text-uppercase">Bản đồ</a></h3></div>
                            <div class="content_box">
                                <div class="block_filter_erea">
                                    <div class="item_fillter">
                                        <div class="dropdown">
                                            <?php dynamic_sidebar('manage_googlemap'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="mapgoogle">
                                    <div class="google-map-canvas" id="map-canvas">
                                        <?php dynamic_sidebar('main_googlemap'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="block_input_lienhe" class="width_common space_bottom_10">
                            <div class="title_box"><h3><a href="#" class="text-uppercase">Gửi liên hệ</a></h3></div>
                            <div class="content_box">
                                <div class="lead_lienhe space_bottom_20">Quý khách có nhu cầu sử dụng dịch vụ của chúng tôi
                                    vui lòng điền thông tin theo mẫu dưới đây và gửi về hòm thư của chúng tôi. Chúng tôi xử
                                    lý và phản hồi lại quý khách sớm nhất có thể. Trân trọng cảm ơn!
                                </div>

                                <div class="main_form_input_lienhe width_common">


                                    <?php dynamic_sidebar('from_contact'); ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
                        <div id="box_diachi_lienhe" class="space_bottom_20 width_common">
                            <div class="title_box"><h3><a href="#" class="text-uppercase">Địa chỉ liên hệ</a></h3></div>
                            <div class="content_box_video width_common">
                                <?php dynamic_sidebar('manage_adress'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>