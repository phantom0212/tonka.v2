<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	
	function qa_breadcrumb_menu(){
		
			$class_qa_functions = new class_qa_functions();
			$menu_items = $class_qa_functions->qa_breadcrumb_menu_items_function();
		
		
			foreach( $menu_items as $item_key => $item_details ) {
				
				$link 	= isset( $item_details['link'] ) ? $item_details['link'] : '';
				$title 	= isset( $item_details['title'] ) ? $item_details['title'] : '';
				
				echo  '<div class="item '.$item_key.'"><a href="'.$link.'">'.$title.'</a></div>';
				
			}
		
		}
		
		
	add_action('qa_breadcrumb_menu','qa_breadcrumb_menu');
	
	
	
	function qa_breadcrumb_menu_notifications(){
		
		if( ! is_user_logged_in() ) return;
		
		echo '<div class="notifications">';
		echo '<div class="title">'.__('Notifications', QA_TEXTDOMAIN).'</div>';
		$userid = get_current_user_id();
		global $wpdb;
		$limit = 10;
	
		$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}qa_notification WHERE status='unread' AND subscriber_id='$userid' ORDER BY id DESC LIMIT $limit" );
			
		foreach( $entries as $entry ){
				
				
			$id = $entry->id;			
			$q_id = $entry->q_id;
			$a_id = $entry->a_id;	
			$c_id = $entry->c_id;				
			$user_id = $entry->user_id;			
			$subscriber_id = $entry->subscriber_id;			
			$action = $entry->action;
			$datetime = $entry->datetime;					
				
			$entry_date = new DateTime($datetime);
			$datetime = $entry_date->format('M d, Y h:i A');	
				
			$user = get_user_by( 'ID', $user_id);
		
			if(!empty($user->display_name)){
				$usen_display_name = $user->display_name;
				}
			else{
				$usen_display_name = __('Anonymous', QA_TEXTDOMAIN);
				}
		
		
		
			$notify_mark_html = '<span class="notify-mark" notify_id="'.$id.'" ><i class="fa fa-bell-o" aria-hidden="true"></i></span>';
					
		
			if( $action == 'new_question' ) {
	 
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> '.__('posted', QA_TEXTDOMAIN).' <span class="action">'.__('New Question',  QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'" class="link">'.get_the_title($q_id).'</a> ';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';
			}
					
			elseif( $action == 'new_answer' ) {
				
				
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> <span class="action">'.__('Answered', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'#single-answer-'.$a_id.'" class="link">'.get_the_title($q_id).'</a> ';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';
			}				
			
			
			elseif( $action == 'best_answer' ) {

				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> <span class="action">'.__('Choosed best answer', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'#single-answer-'.$a_id.'" class="link">'.get_the_title($a_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';

			}			
			
			elseif( $action == 'best_answer_removed' ) {

				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> <span class="action">'.__('Removed best answer', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'#single-answer-'.$a_id.'" class="link">'.get_the_title($a_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';

			}			
	
			elseif($action=='new_comment'){
				
				$q_id = get_post_meta( $a_id, 'qa_answer_question_id', true );
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> <span class="action">'.__('Commented', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'#comment-'.$c_id.'" class="link">'.get_the_title($a_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';
		
				
			}				
					
			elseif($action=='vote_up'){
				
				$q_id = get_post_meta( $a_id, 'qa_answer_question_id', true );
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> <span class="action">'.__('Vote Up', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'#single-answer-'.$a_id.'" class="link">'.get_the_title($a_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';

				
			}				
			elseif($action=='vote_down'){
				
				$q_id = get_post_meta( $a_id, 'qa_answer_question_id', true );
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> <span class="action">'.__('Vote Down', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'#single-answer-'.$a_id.'" class="link">'.get_the_title($a_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';

				
			}				
					
					
			elseif($action=='q_solved'){
	 
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> '.__('marked', QA_TEXTDOMAIN).' <span class="action">'.__('Solved', QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'" class="link">'.get_the_title($q_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';
				
			}	
					
			elseif($action=='q_not_solved'){
	 
				echo '<div class="item">'.$notify_mark_html.' <span class="name">'.$usen_display_name.'</span> '.__('marked', QA_TEXTDOMAIN).' <span class="action">'.__('Not Solved',QA_TEXTDOMAIN).'</span> <a href="'.get_permalink($q_id).'" class="link">'.get_the_title($q_id).'</a>';
				
				echo ' <span class="notify-time"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$datetime.'</span>';
				echo '</div>';

				
				
			}							
		}
		echo '</div>';
	
	}
	add_action('qa_breadcrumb_menu','qa_breadcrumb_menu_notifications');	
	
	
	
	
	
	
	
	
	
	function qa_breadcrumb_links($action){
		
		$archive_page_id = get_option( 'qa_page_question_archive' );
		$archive_page_title = empty( $archive_page_id ) ? __('Question Archive', QA_TEXTDOMAIN) : get_the_title( $archive_page_id );
		$archive_page_href = empty( $archive_page_id ) ? '#' : get_the_permalink( $archive_page_id );
		
		echo apply_filters( 'qa_filter_breadcrumb_question_archive_link_html', sprintf( '<i class="fa fa-angle-double-right separator" aria-hidden="true"></i> <a class="link" href="%s">%s</a>', $archive_page_href, $archive_page_title ) );
		
		if( is_single() ) 
		echo apply_filters( 'qa_filter_breadcrumb_single_question_title_html', sprintf( ' <i class="fa fa-angle-double-right separator" aria-hidden="true"></i> <a class="link" href="#" >%s</a>', get_the_title() ) );
		
	}
		
		
	add_action('qa_breadcrumb_links','qa_breadcrumb_links');
	
		
	
	
	
	
	
	
	
?>
	
	
<div class="qa-breadcrumb">
	
        <?php
		$userid = get_current_user_id();
		global $wpdb;
		$limit = 11;
		
		$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}qa_notification WHERE status='unread' AND subscriber_id='$userid' ORDER BY id DESC LIMIT $limit" );
		
		$total_found = count($entries);
		
		if($total_found>0){
			$pending_class= 'pending';
			if($total_found>10){
				
				$total_found = '10+';
				}
			}
		else{
			$pending_class= '';
			}
		
		?> 
    
    
    <div class="menu-box">
    	<i class="fa fa-bars"></i>
		<?php
        if(is_user_logged_in()){
			?>
            <i class="bubble <?php echo $pending_class; ?>"><?php echo $total_found; ?></i>    
            <?php
			
			}
		?>
        
        <div class="menu-box-hover">
        <?php do_action('qa_breadcrumb_menu'); ?>
        </div>
    </div>
    
	
	
    <div class="links">
    <?php do_action('qa_breadcrumb_links'); ?>
    </div> 

	
</div>