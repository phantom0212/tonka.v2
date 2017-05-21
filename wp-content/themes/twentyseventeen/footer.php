<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
    <div id="menu_footer" class="hidden-xs hidden-xs">
        <div class="container">
        <?php wp_nav_menu(array('theme_location' => 'FooterMenu', 'menu_class' => 'menu_footer',)); ?>
        </div>
    </div>
    <footer id="wrapper_footer">
        <div class="container">
            <div id="footer" class="width_common">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-tn-12">
                        <div class="title_footer">Công ty Dược phẩm Nhất Nhất</div>
                        <div class="item_footer"><i class="fa fa-map-marker" aria-hidden="true"></i> 6A/508 Đường Láng, Quận Đống Đa, Hà Nội, Việt Nam</div>
                        <div class="item_footer"><i class="fa fa-phone" aria-hidden="true"></i> 04.35 62 5766</div>
                        <div class="item_footer"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#">lienhe@nhatnhat.com</a></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-tn-12">
                        <div class="title_footer">Hỗ trợ khách hàng</div>
                        <div class="item_footer"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="#">Tuyển dụng</a></div>
                        <div class="item_footer"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="#">Chương trình khuyến mãi</a></div>
                        <div class="item_footer"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="#">Tra cứu thông tin sản phẩm chính hãng</a></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-tn-12">
                        <div class="title_footer">Chia sẻ &nbsp; <a href="#" class="item_share_footer"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#" class="item_share_footer"><i class="fa fa-google-plus" aria-hidden="true"></i></a> <a href="#" class="item_share_footer"><i class="fa fa-youtube" aria-hidden="true"></i></a></div>
<!--                        <div class="space_bottom_10">Đăng ký nhận bản tin</div>-->
                        <div class="space_bottom_10">
                            <div class="block_search_footer">
                                <div class="relative">
<!--                                    <input type="text" value="Email">-->
<!--                                    <button>Đăng ký</button>-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="coppy_right">
            <div class="container">
                <p>Giấy phép số: 540/GP-TTĐT ngày 09/03/2015 của Sở thông tin và truyền thông, UBND TP Hà Nội</p>
                <p>Bản quyền @2013 thuộc về CÔNG TY TNHH NHẤT NHẤT </p>
            </div>
        </div>

    </footer>
</div>

<?php wp_footer(); ?>
  <script src="<?php  echo get_theme_file_uri(); ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php  echo get_theme_file_uri(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php  echo get_theme_file_uri(); ?>/assets/js/mouseWhell.js"></script>
<script src="<?php  echo get_theme_file_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
<script src="<?php  echo get_theme_file_uri(); ?>/assets/js/common.js"></script>
<script>
    $(function(){

    })
</script>
</body>
</html>
