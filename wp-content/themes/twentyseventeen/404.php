<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
				<div class="col-lg-12">
					<div class="width_common" id="search_404">
						<div class="block_404">
							<div class="title_404">
								<p class="txt_404"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/graphics/bg_title_404.gif" alt="">&nbsp; <strong> Không tìm thấy</strong> đường dẫn này
								</p>
								<p class="txt_center">Bạn có thể truy cập vào <a href="#">trang chủ</a> hoặc sử dụng ô dưới đây để tìm kiếm</p>
							</div>
							<div class="content_404">
								<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<div class="bor_search relative">
									<input value="Tìm kiếm thông tin" onblur="if(this.value=='') this.value=this.defaultValue" onfocus="if(this.value==this.defaultValue) this.value=''" class="txt_input_search" name="s" type="text">
									<input type="hidden" value="post" name="post_type" id="post_type" />
									<button class="btn btn_site">Tìm kiếm</button>
								</div>
									</form>
							</div>

						</div>

					</div>
				</div>
			</div>
			<div class="block_banner_960x90 width_common text-center space_bottom_20">
				<a href="#"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/graphics/img_960x90.jpg" alt="" /></a>
			</div>
		</div>
	</div>


<?php get_footer();
