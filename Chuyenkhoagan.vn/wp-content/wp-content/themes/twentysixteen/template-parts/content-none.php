<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<style>
    #wrapper_container > div > div > div.col-lg-4.col-md-4.col-sm-4.col-xs-6.col-tn-12.space_bottom_10{
        display:  none !important;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="width_common    " id="search_404">
                <div class="block_404">
                    <div class="title_404">
                        <p class="txt_404"><img
                                    src="/wp-content/themes/twentysixteen/tonka/images/graphics/bg_title_404.gif"
                                    alt="">&nbsp; <strong> Không tìm
                                thấy</strong> đường dẫn này
                        </p>
                        <p class="txt_center">Bạn có thể truy cập vào <a href="#">trang chủ</a> hoặc sử dụng ô dưới đây
                            để tìm kiếm</p>
                    </div>
                    <div class="content_404">
                        <div class="bor_search relative">
                            <form method="get" action="/">
                                <input name="s" value="Tìm kiếm thông tin"
                                       onblur="if(this.value=='') this.value=this.defaultValue"
                                       onfocus="if(this.value==this.defaultValue) this.value=''"
                                       class="txt_input_search"
                                       type="text">
                                <button class="btn btn_site">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="block_banner_960x90 width_common text-center space_bottom_20">
        <a href="#"><img src="/wp-content/themes/twentysixteen/tonka/images/graphics/img_960x90.jpg" alt=""></a>
    </div>
</div>
