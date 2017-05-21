<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	
	do_action('qa_action_breadcrumb');
	
	
	
	$class_qa_functions = new class_qa_functions();
	
	if( empty($qa_post_per_page) ) 
	$qa_post_per_page = get_option( 'qa_question_item_per_page', 10 );
	
	
	if ( get_query_var('paged') ) { $paged = get_query_var('paged');} 
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
	else { $paged = 1; }
	
	?>  
    <div class="questions-archive"> 
	
	<?php 

	if( !empty($_GET['keywords']) ){
		$keywords = sanitize_text_field($_GET['keywords']);
	}
	
	$filter_by 	= isset( $_GET['filter_by'] ) ? sanitize_text_field( $_GET['filter_by'] ) : '';
	$user_slug 	= isset( $_GET['user_slug'] ) ? sanitize_text_field( $_GET['user_slug'] ) : '';
	$order_by	= empty( $_GET['order_by'] ) ? '' : sanitize_text_field( $_GET['order_by'] );
	$order		= ( $order_by == 'title' ) ? 'ASC' : sanitize_text_field($order);
	

	if( $order_by === 'date_older' ) {
		
		$order_by = 'date';
		$order = 'ASC';
		
	}
	
	$tax_query = array();
	if( !empty($_GET['category']) || !empty($category) ){
				
		$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : $category;
		$tax_query[] = array(
			array(
			   'taxonomy' => 'question_cat',
			   'field' => 'slug',
			   'terms' => $category,
			)
		);
	}
	
	$date_query = array();
	if( !empty( $_GET['date'] ) || !empty( $date ) ) {
			
		$date = isset( $_GET['date'] ) ? sanitize_text_field($_GET['date']) : '';
		$arr_date = explode( "-", $date );
		
		$date_query = array(
			'year'  => intval($arr_date[2]),
			'month' => intval($arr_date[1]),
			'day'   => intval($arr_date[0]),
		);
	}
	
	$meta_query = array();
	if( !empty( $_GET['filter_by'] ) || !empty( $filter_by ) ) {
			
		$filter_by = isset( $_GET['filter_by'] ) ? sanitize_text_field($_GET['filter_by']) : '';
		
		$meta_query[] = array(
			'key'     => 'qa_question_status',
			'value'   => $filter_by,
			'compare' => '=',
		);
	}
	
	?>


	<form class="question_serch_filter" method="GET">
		
        <div class="form-meta">
		<input type="search" name="keywords" placeholder="<?php echo __('keywords', QA_TEXTDOMAIN); ?>" value="<?php echo $keywords; ?>" />
		</div>
        
        <div class="form-meta">
		<select id="category" name="category">
			<option value=""><?php echo __('Select a category', QA_TEXTDOMAIN); ?></option> <?php

			foreach( qa_get_categories() as $cat_id => $cat_info ) { ksort($cat_info);
				$this_category = get_category( $cat_id );
				foreach( $cat_info as $key => $value ) {
					
					if( $key == 0 )  {
						?><option <?php selected( $this_category->slug, $category ); ?> value="<?php echo $this_category->slug; ?>"><?php echo $value; ?></option><?php
					} else {
						$this_category = get_category( $key );
						
						?><option <?php selected( $this_category->slug, $category ); ?> value="<?php echo $this_category->slug; ?>">  - <?php echo $value; ?></option> <?php
					}
				}
			} ?>
		</select>
        </div>
		
        <div class="form-meta">
		<select id="order_by" name="order_by"> <?php 
			$sorter = $class_qa_functions->qa_question_archive_filter_options();
			foreach( $sorter as $key => $value ) {
				?><option <?php selected( $key, $order_by ); ?> value="<?php echo $key; ?>"><?php echo $value; ?></option><?php
			} ?>
		</select>
		</div>
        
<!-- 

        <div class="form-meta">
		<input type="text" placeholder="<?php echo __('username', QA_TEXTDOMAIN); ?>" name="user_slug" value="<?php echo $user_slug; ?>"/>
		</div>
        
-->
        
   	 	<div class="form-meta">
		<select id="filter_by" name="filter_by"> <?php 
			$status = $class_qa_functions->qa_question_status();
			foreach( $status as $key => $value ) {
				?><option <?php selected( $key, $filter_by ); ?> value="<?php echo $key; ?>"><?php echo $value; ?></option><?php
			} ?>
		</select>
		</div>
		
        <div class="form-meta">
		<input type="submit" value="<?php echo __('Search', QA_TEXTDOMAIN); ?>" />
		</div>
	</form>
	<?php 
	
	if( !empty( $keywords ) ) 	{ ?> <div class="filter"><span><?php echo __('Keyword:', QA_TEXTDOMAIN); ?> </span> <span class="value"><?php echo $keywords; ?></span></div><?php }
	if( !empty( $date ) ) 		{ ?> <div class="filter"><span><?php echo __('Date:', QA_TEXTDOMAIN); ?> </span> <span class="value"><?php echo $date; ?></span></div><?php }
	if( !empty( $category) ) 	{ ?> <div class="filter"><span><?php echo __('Category:', QA_TEXTDOMAIN); ?> </span><span class="value"><?php echo ucwords($category); ?></span></div><?php }
	if( !empty( $order_by) ) 	{ ?> <div class="filter"><span><?php echo __('Sort By:', QA_TEXTDOMAIN); ?> </span><span class="value"><?php echo $order_by; ?></span></div><?php }
	if( !empty( $user_slug) ) 		{ ?> <div class="filter"><span><?php echo __('Author:', QA_TEXTDOMAIN); ?> </span><span class="value"><?php echo $user_slug; ?></span></div><?php }

	
	
	$wp_query = new WP_Query( array (
		'post_type' => 'question',
		'post_status' => empty( $filter_by ) ? array( 'publish', 'private' ) : $filter_by,
		'author_name' => $user_slug,
		's' => $keywords,
		'order' => empty( $order ) ? 'DESC' : $order,
		'orderby' => empty( $order_by ) ? 'date' : $order_by,
		'tax_query' => $tax_query,
		'meta_query' => $meta_query,
		'date_query' => $date_query,		
		'posts_per_page' => $qa_post_per_page,
		'paged' => $paged,
	) );
			
	?> 
	
	<!-- 
    <div class="question_found"><b><?php echo __('Total:', QA_TEXTDOMAIN); ?> <em><?php echo $wp_query->found_posts; ?> <?php echo __('Questions', QA_TEXTDOMAIN); ?></em></b></div>
    --> 
	
	<?php 
		
	if ( $wp_query->have_posts() ) : 
	while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
		do_action( 'qa_action_question_archive_single', $wp_query );
	
	endwhile;

	$big = 999999999;
	$paginate = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $wp_query->max_num_pages
	);
			
	?><div class="paginate"> <?php echo paginate_links($paginate); ?> </div> <?php		
	
	wp_reset_query();
			
	else: ?><span><?php echo __('No question found', QA_TEXTDOMAIN); ?></span> <?php 
	endif; ?>
			
	</div>
			