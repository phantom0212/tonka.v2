<div class="container">
    <div id="lienhe_page">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                <div id="lienhe_map" class="width_common space_bottom_20">
                    <div class="title_box"><h3><a href="#" class="text-uppercase">BẢn đồ</a></h3></div>
                    <div class="content_box">
                        <div class="block_filter_erea">
                            <div class="item_fillter">
                                <div class="dropdown">
                                    <?php
$adress = $_GET['adress'];
$link_map = 'Văn phòng Hà Nội';

if($adress == 'van-phong-ha-noi'){
	$link_map = 'Văn phòng Hà Nội';
}

if($adress == 'van-phong-ho-chi-minh'){
	$link_map = 'Văn phòng HCM';
}

if($adress == 'nha-may-san-xuat'){
	$link_map = 'Nhà máy sản xuất';
}

?>

<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <?php echo $link_map; ?>
                                            <span class="caret"></span>
                                        </button>
<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="?adress=van-phong-ha-noi">Văn phòng Hà Nội</a></li>
                                            <li><a href="?adress=van-phong-ho-chi-minh">Văn phòng HCM</a></li>
                                            <li><a href="?adress=nha-may-san-xuat">Nhà máy sản xuất</a></li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                        $adress = empty($_GET['adress']) ? 'van-phong-ha-noi' : $_GET['adress'];
                        $link_map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5618130958514!2d105.80977531450432!3d21.010194986008354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac9de454d8e9%3A0x706e520833b186d5!2zNTA4IEzDoW5nLCBUcnVuZyBIb8OgLCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1490466359356';

                        if ($adress == 'van-phong-ha-noi') {
                            $link_map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5618130958514!2d105.80977531450432!3d21.010194986008354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac9de454d8e9%3A0x706e520833b186d5!2zNTA4IEzDoW5nLCBUcnVuZyBIb8OgLCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1490466359356';
                        }

                        if ($adress == 'van-phong-ho-chi-minh') {
                            $link_map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.163208677266!2d106.67565331435057!3d10.798808992306304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528d7b5eb3e95%3A0xcdccdcf464009669!2zMTk0LzMgVHLhuqduIEh1eSBMaeG7h3UsIHBoxrDhu51uZyAxNSwgUGjDuiBOaHXhuq1uLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1490879642224';
                        }

                        if ($adress == 'nha-may-san-xuat') {
                            $link_map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2395599282972!2d106.4714590143505!3d10.792955392310297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310ad38faf6a1dcb%3A0x52400a870a1868ee!2z4bqkcCBCw6xuaCBUaeG7gW4gMiwgxJDhu6ljIEjDsmEgSOG6oSwgxJDhu6ljIEjDsmEsIExvbmcgQW4sIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1490879727399';
                        }

                        ?>

                        <iframe src="<?php echo $link_map; ?>" width="100%" height="450" frameborder="0"
                                style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div id="block_input_lienhe" class="width_common space_bottom_10">
                    <div class="title_box"><h3><a href="#" class="text-uppercase">Gửi liên hệ</a></h3></div>
                    <div class="content_box">
                        <div class="lead_lienhe space_bottom_20">Quý khách có nhu cầu sử dụng dịch vụ của chúng tôi
                            vui lòng điền thông tin theo mẫu dưới đây và gửi về hòm thư của chúng tôi. Chúng tôi xử
                            lý và phản hồi lại quý khách sớm nhất có thể. Trân trọng cảm ơn!
                        </div>

                        <?php echo do_shortcode('[contact-form-7 id=37 title="Contact form 1"]');?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
                <div id="box_diachi_lienhe" class="space_bottom_20 width_common">
                    <div class="title_box"><h3><a href="#" class="text-uppercase">Địa chỉ liên hệ</a></h3></div>
                    <div class="content_box_video width_common">
                        <div class="item_diachi_lienhe">
                            <div class="title_item_diachi">
                                Văn phòng Hà Nội
                            </div>
                            <div class="content_item_diachi">
                                <div class="wap_item_diachi">
                                    <i class="fa fa-home"></i>
                                    6A/508 Đường Láng, Quận Đống Đa, Hà Nội, Việt Nam
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-phone"></i>
                                    04.35 62 5766
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-fax"></i>
                                    04.35 62 7005
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                    18006689
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-envelope"></i>
                                    <a href="#">lienhe@nhatnhat.com</a>
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-link"></i>
                                    <a href="#">www.nhatnhat.com </a>
                                </div>
                            </div>
                        </div>
                        <div class="item_diachi_lienhe">
                            <div class="title_item_diachi">
                                Văn phòng TP. Hồ Chí Minh
                            </div>
                            <div class="content_item_diachi">
                                <div class="wap_item_diachi">
                                    <i class="fa fa-home"></i>
                                    194/3 Trần Huy Liệu, Phường 15, Q Phú Nhuận, Hồ Chí Minh
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-phone"></i>
                                    08.221 68 967
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-fax"></i>
                                    Fax:08.626 49 400
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                    18006689
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-envelope"></i>
                                    <a href="#">lienhe@nhatnhat.com</a>
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-link"></i>
                                    <a href="#">www.nhatnhat.com </a>
                                </div>
                            </div>
                        </div>
                        <div class="item_diachi_lienhe">
                            <div class="title_item_diachi">
                                Nhà máy sản xuất
                            </div>
                            <div class="content_item_diachi">
                                <div class="wap_item_diachi">
                                    <i class="fa fa-home"></i>
                                    Âp Bình Tiền 2, xã Đức Hòa Hạ, huyện Đức Hòa, tỉnh Long An
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-phone"></i>
                                    072.3817 117
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-fax"></i>
                                    072.3817 337
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                    18006689
                                </div>
                                <div class="wap_item_diachi">
                                    <i class="fa fa-envelope"></i>
                                    <a href="#">lienhe@nhatnhat.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page -->
<script language="javascript" type="text/javascript"
        src="/wp-content/themes/twentysixteen/tonka/js/mouseWhell.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/jquery.flexslider-min.js"></script>
<script src="/wp-content/themes/twentysixteen/tonka/js/common.js"></script>
<script>
    $(function () {

    })
</script>