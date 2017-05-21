<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<div class="col-lg-8 col-lg-offset-2">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="block_search_page">
			<div class="relative">
				<input type="text" placeholder="Nhập từ khóa tìm kiếm..."  name="s" >
				<input type="hidden" value="post" name="post_type" id="post_type" />
				<button type="submit" ><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
