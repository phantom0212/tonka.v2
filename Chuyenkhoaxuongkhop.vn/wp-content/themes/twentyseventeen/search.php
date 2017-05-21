<?php
get_header();
global $wp_query;
?>

	<div id="wrapper_container">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
					<div class="breadcrumb">
						<a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a> <i class="fa fa-caret-right"></i> <a class="active_breadcrumb">Tìm kiếm</a>
					</div>

					<div id="box_search_page">
						<?php get_search_form() ?>
						<div class="width_common space_bottom_20"><strong><?php echo $wp_query->found_posts; ?></strong> kết quả cho từ khóa <strong class="txt_site"><?php the_search_query(); ?></strong></div>
					</div>

					<div class="list_news_folder space_bottom_20 width_common">
						<div class="list_sub_news width_common">
							<?php if ( have_posts() ) { ?>
								<?php while ( have_posts() ) { the_post(); ?>
									<div class="item_list_news_folder">
										<div class="block_thumb_news">
											<a class="thunb_image thumb_5x3" href="<?php echo get_permalink(); ?>"><?php  the_post_thumbnail('medium') ?></a>
										</div>
										<h2 class="title_box_news">
											<a href="<?php echo get_permalink(); ?>"> <?php the_title();  ?></a>
										</h2>
										<h4 class="lead_box_news"><?php echo substr(get_the_excerpt(), 0,200); ?></h4>
									</div>
								<?php } ?>
								<?php paginate_links(); ?>
							<?php } ?>
						</div>


 <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    global $wp;
                    $current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
                    ?>
                    <?php if($wp_query->found_posts -($paged)*10 > 0){ ?>

						<div class="block_xemthem text-right">
							<a href="<?php echo $current_url.'&paged='.($paged+1); ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
						</div>
<?php } ?>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12 space_bottom_10">
					<?php get_sidebar() ?>

				</div>
			</div>

			<div class="block_banner_960x90 width_common text-center space_bottom_20">
				<?php dynamic_sidebar('sidebar-2'); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>