<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	












	function qa_filter_poll_input_fields($input_fields){
		
		$qa_enable_poll = get_option('qa_enable_poll');
		
		if($qa_enable_poll == 'yes'){
			
			$meta_fields = array(
		
								'polls'=>array(
									'meta_key'=>'polls',
									'css_class'=>'polls',
									'placeholder'=>'',
									'required'=>'no',														
									'title'=>__('Polls', QA_TEXTDOMAIN),
									'option_details'=>__('Add your polls', QA_TEXTDOMAIN),					
									'input_type'=>'text_multi', // text, radio, checkbox, select,
									'input_values'=>array(time()=>'',), // could be array
									'field_args'=> array('dummy'=>'Dummy',),
									),
															
								);
			
			
			$input_fields['meta_fields'] = $meta_fields;
			
			
			}
		

		return $input_fields;
		
		
		
		}
		
	add_filter('qa_filter_question_input_fields', 'qa_filter_poll_input_fields');

















	function qa_all_roles() {
		
		 global $wp_roles;
		 $roles = $wp_roles->get_names();
		
		return  $roles;
		 // Below code will print the all list of roles.
		 //echo '<pre>'.var_export($wp_roles, true).'</pre>';  
		
		}

	add_shortcode('qa_all_roles','qa_all_roles');





	function qa_time_ago($post_time) {

		$gmt_offset = get_option('gmt_offset');
		$today = date('Y-m-d h:i:s', strtotime('+'.$gmt_offset.' hour'));
		$today = strtotime($today);
		//var_dump(strtotime($today));

		$post_time = get_post_time();
		//$today = time();		
		
		//var_dump($today);
		
		
		$diff = $today - $post_time;
		
		$minute = floor(($diff % 3600)/60);
		$hour = floor(($diff % 86400)/3600);
		$day = floor(($diff % 2592000)/86400);
		$month = floor($diff/2592000);
		$year = floor($diff/(86400*365));		
		
		if($year>0){
			return number_format_i18n($year) .' '.__('year ago', QA_TEXTDOMAIN);
			}
				
		elseif($month > 0 && $day<=12 ){
			return number_format_i18n($month) .' '.__('month ago', QA_TEXTDOMAIN);
			}
			
		elseif($day > 0 && $day<=30){
			return number_format_i18n($day).' '.__('day ago', QA_TEXTDOMAIN);
			}
			
		elseif($hour > 0 && $hour<=24){
			return number_format_i18n($hour).' '.__('hour ago', QA_TEXTDOMAIN);
			}		
			
		elseif($minute > 0 && $minute<60){
			return number_format_i18n($minute).' '.__('minute ago', QA_TEXTDOMAIN);
			}	
				
		else{
			return $diff.' '.__('second ago', QA_TEXTDOMAIN);;
			}
		
	}	
	
	
	
	function qa_post_duration($post_id) {


		$gmt_offset = get_option('gmt_offset');
		$today = date('Y-m-d h:i:s', strtotime('+'.$gmt_offset.' hour'));
		$today = strtotime($today);
		//var_dump(strtotime($today));

		$post_time = get_post_time();
		//$today = time();		
		
		//var_dump($today);
		
		
		$diff = $today - $post_time;
		
		$minute = floor(($diff % 3600)/60);
		$hour = floor(($diff % 86400)/3600);
		$day = floor(($diff % 2592000)/86400);
		$month = floor($diff/2592000);
		$year = floor($diff/(86400*365));		
		
		if($year>0){
			return number_format_i18n($year) .' '.__('year ago', QA_TEXTDOMAIN);
			}
				
		elseif($month > 0 && $day<=12 ){
			return number_format_i18n($month) .' '.__('month ago', QA_TEXTDOMAIN);
			}
			
		elseif($day > 0 && $day<=30){
			return number_format_i18n($day).' '.__('day ago', QA_TEXTDOMAIN);
			}
			
		elseif($hour > 0 && $hour<=24){
			return number_format_i18n($hour).' '.__('hour ago', QA_TEXTDOMAIN);
			}		
			
		elseif($minute > 0 && $minute<60){
			return number_format_i18n($minute).' '.__('minute ago', QA_TEXTDOMAIN);
			}	
				
		else{
			return $diff.' '.__('second ago', QA_TEXTDOMAIN);
			}
		
	}	
	
	
	
	
	
	
	

function qa__get_terms($taxonomy){

		
		//$cat_id = (int)$_POST['cat_id'];
		if(!isset($taxonomy)){
			$taxonomy = 'ads_cat';
			}

		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  );
		
		$categories = get_categories($args);

			
		$html = '';

		foreach($categories as $category){
			
				$name = $category->name;
				$cat_ID = $category->cat_ID;	
			
				$terms[$cat_ID] = 	$name;	
				//$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name;
				//$html.= '</li>';
			
			}

		return $terms;
	}



	
	
	// save notifications
	
	add_action('qa_action_notification_save','add_question_track_notification', 10, 5);
	
	function add_question_track_notification($q_id, $a_id, $c_id, $user_id, $action){

		global $wpdb;
		$table = $wpdb->prefix . "qa_notification";	

		$status = 'unread';
		
		$gmt_offset = get_option('gmt_offset');
		$datetime = date('Y-m-d h:i:s', strtotime('+'.$gmt_offset.' hour'));
		//$today = strtotime($today);
		//$datetime = date('Y-m-d h:i:s');		
		
		$subscriber_id = '';
		
		if($action=='new_answer'){
			
			$qa_answer_question_id = get_post_meta($a_id, 'qa_answer_question_id', true);
			
			$question_post = get_post($qa_answer_question_id);
			$question_author = $question_post->post_author;
			
			$subscriber_id = $question_author;
			
			}

		elseif($action=='new_question'){
			
			//$qa_answer_question_id = get_post_meta($a_id, 'qa_answer_question_id', true);
			$admin_email = get_option('admin_email');	
			$admin = get_user_by( 'email', $admin_email );
			
			$subscriber_id = $admin->ID;
			
			}



		elseif($action=='q_solved' || $action=='q_not_solved'){
			
			//$qa_answer_question_id = get_post_meta($a_id, 'qa_answer_question_id', true);
			
			$question_post = get_post($q_id);
			$question_author = $question_post->post_author;
			
			$subscriber_id = $question_author;
			
			}

		elseif($action=='vote_up' || $action=='vote_down'){
			
			//$qa_answer_question_id = get_post_meta($a_id, 'qa_answer_question_id', true);
			
			$question_post = get_post($a_id);
			$question_author = $question_post->post_author;
			
			$subscriber_id = $question_author;
			
			}


		elseif($action=='new_comment'){
			
			//$qa_answer_question_id = get_post_meta($a_id, 'qa_answer_question_id', true);
			
			$question_post = get_post($a_id);
			$question_author = $question_post->post_author;
			
			$subscriber_id = $question_author;
			
			}

		elseif($action=='best_answer'){
			
/*


			$qa_meta_best_answer = get_post_meta($q_id, 'qa_meta_best_answer', true);
			
			if(!empty($qa_meta_best_answer) && $qa_meta_best_answer ==$a_id ){
				
				//$action=='best_answer_removed';
				//$wpdb->delete( $table, array( 'q_id' => $q_id, 'action' => 'best_answer' ), array( '%d' , '%s') );
				//$wpdb->delete( $table, array( 'q_id' => $q_id, 'action' => 'best_answer_removed' ), array( '%d' , '%s') );	
				
				$wpdb->update( 
					$table, 
					array( 
						'action' => 'best_answer_removed',	// string
					), 
					array( 'q_id' => $q_id, 'action' => 'best_answer' ), 
					array( 
						'%s',	// value1
					), 
					array( '%d', '%s' ) 
				);
								
				
				
							
				}
			else{
				
				}

*/
			
			
			$question_post = get_post($a_id);
			$question_author = $question_post->post_author;
			
			$subscriber_id = $question_author;
			
			}


		elseif($action=='best_answer_removed'){
			
			//$qa_answer_question_id = get_post_meta($a_id, 'qa_answer_question_id', true);
			
			$question_post = get_post($a_id);
			$question_author = $question_post->post_author;
			
			$subscriber_id = $question_author;
			
			}



	
		$wpdb->query( $wpdb->prepare("INSERT INTO $table 
									( id, q_id, a_id, c_id, user_id, subscriber_id,  action, status, datetime )
									VALUES	( %d, %d, %d, %d, %d, %d, %s, %s, %s )",
									array	( '', $q_id, $a_id, $c_id, $user_id, $subscriber_id, $action, $status, $datetime)
									
									));
	}
	
















	function qa_shorten_string($string, $wordcount = 3, $RemoveHtml = true, $Extension = ' ...' ) {
		
		if( $RemoveHtml ) $string = strip_tags($string); 
		$array = explode( " ", $string );
		if ( count($array) > $wordcount ) {
			array_splice($array, $wordcount);
			return implode(" ", $array) . $Extension;
		}
		else return $string;
    }

	function qa_single_question_template($single_template) {
		
		 global $post;
	
		 if ($post->post_type == 'question') {
			  $single_template = QA_PLUGIN_DIR . 'templates/single-question/single-question.php';
		 }
		 
		 return $single_template;
	}
	add_filter( 'single_template', 'qa_single_question_template' );
	
	
/*

	function qa_single_answer_template($single_template) {
		 global $post;
	
		 if ($post->post_type == 'answer') {
			  $single_template = QA_PLUGIN_DIR . 'templates/single-answer.php';
		 }
		 return $single_template;
	}
	add_filter( 'single_template', 'qa_single_answer_template' );	
	
*/



	
	
	
	
	function qa_ajax_best_answer() {
		
		$answer_id 	= (int)sanitize_text_field($_POST['answer_id']);
		$question_id 	= get_post_meta( $answer_id, 'qa_answer_question_id', true );
		$best_answer_id	= get_post_meta( $question_id, 'qa_meta_best_answer', true );

		$question_data = get_post($question_id); 
		$q_author = $question_data->post_author;
		
		$response 	= array();
		
		
		if(!is_user_logged_in()){
			
			$response['toast'] .= '<i class="fa fa-check"></i> ' . __('Please login first.', QA_TEXTDOMAIN);
			echo json_encode($response);
			die(); 
			}		
		
		if($q_author != get_current_user_id()){
			
			$response['toast'] .= '<i class="fa fa-check"></i> ' . __('Sorry you can\'t choose best answer.', QA_TEXTDOMAIN);
			echo json_encode($response);
			die(); 
			}
		
		
		if( $best_answer_id == $answer_id ) {
			
			update_post_meta( $question_id, 'qa_meta_best_answer', '' );
			$response['status'] = 'removed';
			$response['toast'] .= '<i class="fa fa-times"></i> ' .__('Removed Best answer', QA_TEXTDOMAIN);

			$userid = get_current_user_id();
			$q_id = $question_id;
			$a_id = $answer_id;
			$c_id = '';
			$user_id = $userid;
			$action = 'best_answer_removed';
	
			do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);

			} 
		
		else{
			
			update_post_meta( $question_id, 'qa_meta_best_answer', $answer_id );
			$response['status'] = 'updated';
			$response['toast'] .= '<i class="fa fa-check"></i> ' . __('Marked as Best answer', QA_TEXTDOMAIN);
			
			$userid = get_current_user_id();
			$q_id = $question_id;
			$a_id = $answer_id;
			$c_id = '';
			$user_id = $userid;
			$action = 'best_answer';
	
			do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
	
		}

		echo json_encode($response);
		die();
	}

	add_action('wp_ajax_qa_ajax_best_answer', 'qa_ajax_best_answer');
	add_action('wp_ajax_nopriv_qa_ajax_best_answer', 'qa_ajax_best_answer');	



	function qa_ajax_notify_mark() {
		
		$notify_id 	= (int)sanitize_text_field($_POST['notify_id']);		
		global $wpdb;
		$table = $wpdb->prefix . "qa_notification";	
		
		$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}qa_notification WHERE  id='$notify_id'" );

		$status = $entries[0]->status;
		
		if($status == 'unread'){
			
				$wpdb->update( 
					$table, 
					array( 
						'status' => 'read',	// string
					), 
					array( 'id' => $notify_id ), 
					array( 
						'%s',	// value1
					), 
					array( '%d' ) 
				);
				
				$response['status'] =  'read';
				
				$response['icon'] =  '<i class="fa fa-bell-slash"></i>';				
			}
		elseif($status == 'read'){
				$wpdb->update( 
					$table, 
					array( 
						'status' => 'unread',	// string
					), 
					array( 'id' => $notify_id ), 
					array( 
						'%s',	// value1
					), 
					array( '%d' ) 
				);
			
				$response['status'] =  'unread';
				$response['icon'] =  '<i class="fa fa-bell-o"></i>';
				
		}

		echo json_encode($response);
		die();
	}


	add_action('wp_ajax_qa_ajax_notify_mark', 'qa_ajax_notify_mark');
	add_action('wp_ajax_nopriv_qa_ajax_notify_mark', 'qa_ajax_notify_mark');
	
	
	
	
	
	
	
	
	function qa_ajax_featured_switch() {
		
		$post_id = (int)sanitize_text_field($_POST['post_id']);
		
		$response = array();
		
		if( !empty( $post_id ) ) {
		
			$qa_featured_questions = get_option( 'qa_featured_questions', array() );
		
			if ( ($key = array_search( $post_id , $qa_featured_questions)) !== false ) {
				
				unset($qa_featured_questions[$key]);
				$response['featured_class'] = 'qa-featured-no';
				$response['toast'] = '<i class="fa fa-times"></i> '.__( 'Removed from featured', QA_TEXTDOMAIN );
				
			} else {
				
				array_push( $qa_featured_questions, $post_id );
				$response['featured_class'] = 'qa-featured-yes';
				$response['toast'] = '<i class="fa fa-check"></i> '.__( 'Successfully featured', QA_TEXTDOMAIN );
			}
			update_option( 'qa_featured_questions', $qa_featured_questions );
		}	
		
		echo json_encode($response);
		die();
	}

	add_action('wp_ajax_qa_ajax_featured_switch', 'qa_ajax_featured_switch');
	add_action('wp_ajax_nopriv_qa_ajax_featured_switch', 'qa_ajax_featured_switch');
	
	function qa_do_comment_flag_action() {
		
		$qa_flag_comment = '';
		$action 	= sanitize_text_field($_POST['act']);
		$comment_id = (int)sanitize_text_field($_POST['comment_id']);
		$user_id 	= sanitize_text_field($_POST['user_id']);
		
		$qa_flag_comment = get_comment_meta( $comment_id, 'qa_flag_comment', true );
	
		if( empty($qa_flag_comment) ) 
			add_comment_meta( $comment_id, 'qa_flag_comment', $qa_flag_comment ); 
		
		if ( $action == 'flag' ) {
		
			if( !qa_search_user($user_id,$qa_flag_comment) ) {
				$qa_flag_comment .= $user_id . ',';
				update_comment_meta( $comment_id, 'qa_flag_comment', $qa_flag_comment );
				
				
				
				$userid = get_current_user_id();
				$q_id = '';
				$a_id = '';
				$c_id = $comment_id;
				$user_id = $userid;
				$action = 'comment_flag';
	
				do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
				
				do_action('qa_action_comment_flag', $comment_id);
				
				
			} 
		}
		
		if ( $action == 'unflag' ) {
			
			
			$qa_flag_comment = str_replace( $user_id.',', ' ', $qa_flag_comment);
			update_comment_meta( $comment_id, 'qa_flag_comment', $qa_flag_comment );
			
			do_action('qa_action_comment_unflag', $comment_id);
		} 
		
		
		$count_flag = count(explode(',', $qa_flag_comment ) ) - 1;
		if( !empty($user_id) && qa_search_user($user_id, $qa_flag_comment) ) {
			$flag_html = __('Unflag',QA_TEXTDOMAIN).' ('.$count_flag.')<span class="qa_ttt qa_w_160"><i class="fa fa-undo"></i> '.__('Undo Report', QA_TEXTDOMAIN).'</span>';
		} else {
			$flag_html =  __('Flag',QA_TEXTDOMAIN).' ('.$count_flag.')<span class="qa_ttt qa_w_160"><i class="fa fa-thumbs-down"></i> '.__('Report this', QA_TEXTDOMAIN).'</span>';
		}

		echo $flag_html;
		die();
	}

	add_action('wp_ajax_qa_do_comment_flag_action', 'qa_do_comment_flag_action');
	add_action('wp_ajax_nopriv_qa_do_comment_flag_action', 'qa_do_comment_flag_action');
	
	
	
	function qa_answer_reply_action() {

		if(is_user_logged_in()):
		
		
			$post_id 	= (int)sanitize_text_field($_POST['post_id']);
			$reply_msg 	= esc_textarea($_POST['reply_msg']);
			
			$current_user = wp_get_current_user();
			$userid = get_current_user_id();
			
			$data = array(
				'comment_post_ID' 		=> $post_id,
				'comment_author' 		=> $current_user->user_login,
				'comment_author_email' 	=> $current_user->user_email,
				'comment_content' 		=> $reply_msg,
				'comment_date' 			=> current_time('mysql'),
				'comment_approved' 		=> 1,
			);
	
			if( !empty( $reply_msg ) ) {
				$new_comment_ID = wp_insert_comment($data);
				
				
				
				$a_subscriber = get_post_meta($post_id, 'a_subscriber', true);
				
				if(empty($a_subscriber)){
					update_post_meta($post_id,'a_subscriber',array($userid) );
					
					}
				else{
					
					if(!in_array($userid,$a_subscriber)){
						
						$a_subscriber = array_merge($a_subscriber, array($userid));
						update_post_meta($post_id,'a_subscriber',$a_subscriber );
						
						}
					}	
				
				
				
				
				
				$userid = get_current_user_id();
				$q_id = '';
				$a_id = $post_id;
				$c_id = $new_comment_ID;
				$user_id = $userid;
				$action = 'new_comment';
	
				do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
				
				do_action('qa_action_answer_comment', $new_comment_ID);
				
				
				
			}
			
			if ( !empty($new_comment_ID) ) {
				
				$comment_data = get_comment($new_comment_ID);
				
				echo '
				<div class="qa-single-comment single-reply">
					
					<div class="qa-avatar float_left">'.get_avatar( $current_user->user_email, "30" ).'</div>
					<div class="qa-comment-content">
						<div class="ap-comment-header">
							<a href="#" class="ap-comment-author">'.$current_user->display_name.'</a>'; 
							
							$comment_date = new DateTime();
							$comment_date = $comment_date->format('M d, Y h:i A');
							
							echo '<span> - '.$comment_date.' </span>
						</div>
						<div class="ap-comment-texts">'.(qa_filter_badwords(wpautop($comment_data->comment_content))).'</div>
					</div>
				
				</div>';
			} else {
				echo __('Something went wrong !', QA_TEXTDOMAIN);
			}
			
			
		else:
			echo __('Please login to post comments', QA_TEXTDOMAIN);
		
		endif;


		die();
	}

	add_action('wp_ajax_qa_answer_reply_action', 'qa_answer_reply_action');
	add_action('wp_ajax_nopriv_qa_answer_reply_action', 'qa_answer_reply_action');
	
	
	
	
	
	
	function qa_ajax_poll(){	
	
		$q_id = sanitize_text_field($_POST['q_id']);
		$data_id = sanitize_text_field($_POST['data_id']);		
		
		if(is_user_logged_in()){
			
			$user_id = get_current_user_id();
			$polls = get_post_meta($q_id, 'polls', true);	
			$polls = unserialize($polls);
				
			$poll_result = get_post_meta($q_id, 'poll_result', true);
			
			$poll_result[$user_id] =  $data_id;
	
			update_post_meta( $q_id, 'poll_result', $poll_result );
	
			
			//echo $data_id;
		
			$total = count($poll_result);
			$count_values = array_count_values($poll_result);		
			//var_dump($count_values);
			$response['html'] = '<div class="">'.__('Total:', QA_TEXTDOMAIN).' '.$total.'</div>';
			//var_dump($count_values);
			foreach($count_values as $id=>$value){
				
				$response['html'].= '<div class="poll-line"><div style="width:'.(($value/$total)*100).'%" class="fill">&nbsp;'.$polls[$id].' - ('.$value.')'.' </div></div>';
				
				}
			
			}
		else{
			$response['error'] = __('Please login.', QA_TEXTDOMAIN);
			}
		

		
		
		echo json_encode($response);
		die();
	
	}
	add_action('wp_ajax_qa_ajax_poll', 'qa_ajax_poll');
	add_action('wp_ajax_nopriv_qa_ajax_poll', 'qa_ajax_poll');
	
	
	
	
	
	
	
	
	
	
	function qa_answer_thumbsup_action() {
		$response = array();
		
		$post_id 		= (int)sanitize_text_field($_POST['post_id']);
		$current_user 	= wp_get_current_user();
		
		$qa_answer_review 	= get_post_meta( $post_id, 'qa_answer_review', true );
		
		if( empty( $current_user->ID ) ) {
			$response['error'] = __('Login first to Review !', QA_TEXTDOMAIN);
		} else {

			$review_count = empty( $qa_answer_review['reviews'] ) ? 0 : (int)$qa_answer_review['reviews'];
			
			$status = isset( $qa_answer_review['users'][$current_user->ID]['type'] ) ? $qa_answer_review['users'][$current_user->ID]['type'] : '';
			if( $status != 'up' ) {
			
				$qa_answer_review['reviews'] = ++$review_count;
				$qa_answer_review['users'][$current_user->ID]['type'] =  'up';
			
				update_post_meta( $post_id, 'qa_answer_review', $qa_answer_review );
				$response['review_value'] = $review_count;
				
				$userid = get_current_user_id();
				$q_id = '';
				$a_id = $post_id;
				$c_id = '';
				$user_id = $userid;
				$action = 'vote_up';
	
				do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
				
				do_action('qa_action_answer_vote_up', $post_id);
				
			
			} else $response['error'] = __( 'Already Reviewed !', QA_TEXTDOMAIN );
		}
		
		$response['status'] = $status;
		
		echo json_encode($response);
		die();
	}

	add_action('wp_ajax_qa_answer_thumbsup_action', 'qa_answer_thumbsup_action');
	add_action('wp_ajax_nopriv_qa_answer_thumbsup_action', 'qa_answer_thumbsup_action');
	
	function qa_answer_thumbsdown_action() {
		$response = array();
		
		$post_id 		= (int)sanitize_text_field($_POST['post_id']);
		$current_user 	= wp_get_current_user();
		
		$qa_answer_review 	= get_post_meta( $post_id, 'qa_answer_review', true );
		
		if( empty( $current_user->ID ) ) {
			$response['error'] = __('Login first to Review !', QA_TEXTDOMAIN);
		} else {

			$review_count = empty( $qa_answer_review['reviews'] ) ? 0 : (int)$qa_answer_review['reviews'];
			
			$status = isset( $qa_answer_review['users'][$current_user->ID]['type'] ) ? $qa_answer_review['users'][$current_user->ID]['type'] : '';
			if( $status != 'down' ) {
			
				$qa_answer_review['reviews'] = --$review_count;
				$qa_answer_review['users'][$current_user->ID]['type'] =  'down';
			
				update_post_meta( $post_id, 'qa_answer_review', $qa_answer_review );
				$response['review_value'] = $review_count;
			
				$userid = get_current_user_id();
				$q_id = '';
				$a_id = $post_id;
				$c_id = '';
				$user_id = $userid;
				$action = 'vote_down';
	
				do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);

				do_action('qa_action_answer_vote_down', $post_id);
			
			
			} else $response['error'] = __( 'Already Reviewed!', QA_TEXTDOMAIN );
		}
		
		$response['status'] = $status;
		
		echo json_encode($response);
		die();
	}

	add_action('wp_ajax_qa_answer_thumbsdown_action', 'qa_answer_thumbsdown_action');
	add_action('wp_ajax_nopriv_qa_answer_thumbsdown_action', 'qa_answer_thumbsdown_action');
	
	
	// is solved
	function qa_subscribe_action() {
		$html = array();
		
		$post_id 		= (int)sanitize_text_field($_POST['post_id']);
		$current_user 	= wp_get_current_user();
		//$author_id 		= get_post_field( 'post_author', $post_id );
		
		if( is_user_logged_in() ) {
			
			$q_subscriber = get_post_meta( $post_id, 'q_subscriber', true );
			
			if(!is_array($q_subscriber)){
				$q_subscriber = array();
				}
			
			
			if(in_array($current_user->ID, $q_subscriber)){
				
				$html['toast'] = __('Unsubscribe from this question', QA_TEXTDOMAIN);
				$html['html'] = '<i class="fa fa-bell-slash"></i>';
				$html['subscribe_class'] = 'not-subscribed';	

				//unset($q_subscriber);

				$q_subscriber = array_diff($q_subscriber, array($current_user->ID));
				update_post_meta($post_id,'q_subscriber', $q_subscriber );

				do_action('qa_action_question_subscribe', $post_id);

				}
			else{
				
				$html['toast'] = __('Subscribed to this question', QA_TEXTDOMAIN);
				$html['html'] = '<i class="fa fa-bell"></i>';
				$html['subscribe_class'] = 'subscribed';
				
				$q_subscriber = array_merge($q_subscriber, array($current_user->ID));
				update_post_meta($post_id,'q_subscriber', $q_subscriber );
				
				do_action('qa_action_question_unsubscribe', $post_id);
				}

			} 
		else{
			
			$html['toast'] = __('Please login first!', QA_TEXTDOMAIN);
		}
		
		echo json_encode($html);
		die();
	}

	add_action('wp_ajax_qa_subscribe_action', 'qa_subscribe_action');
	add_action('wp_ajax_nopriv_qa_subscribe_action', 'qa_subscribe_action');
	
	
	
	// is solved
	function qa_is_solved_action() {
		$html = array();
		
		$post_id 		= (int)sanitize_text_field($_POST['post_id']);
		$current_user 	= wp_get_current_user();
		$author_id 		= get_post_field( 'post_author', $post_id );
		
		if( $current_user->ID == $author_id || is_admin() ) {
			$is_solved = get_post_meta( $post_id, 'qa_question_status', true );
			
			if ( $is_solved == 'solved' ) {
				
				update_post_meta( $post_id, 'qa_question_status', 'processing' );
				
				$html['toast'] 		= __('Successfully marked as unsolved', QA_TEXTDOMAIN);
				$html['html'] 		= '<i class="fa fa-times"></i> '.__('Mark as Solved', QA_TEXTDOMAIN);
				$html['is_solved'] 	= 'not-solved';	
				$html['qa_ttt']		= __( 'Mark as Solved', QA_TEXTDOMAIN );
				
				
				$userid = get_current_user_id();
				$q_id = $post_id;
				$a_id = '';
				$c_id = '';
				$user_id = $userid;
				$action = 'q_not_solved';
	
				do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
				do_action('qa_action_question_not_solved', $q_id);				
							
			} else {
				
				update_post_meta( $post_id, 'qa_question_status', 'solved' );
				
				$html['toast'] 		= __('Successfully marked as Solved', QA_TEXTDOMAIN);
				$html['html'] 		= '<i class="fa fa-check"></i> '.__('Solved', QA_TEXTDOMAIN);
				$html['is_solved'] 	= 'solved';
				$html['qa_ttt']		= __( 'Mark as Unsolved', QA_TEXTDOMAIN );
				
				
				$userid = get_current_user_id();
				$q_id = $post_id;
				$a_id = '';
				$c_id = '';
				$user_id = $userid;
				$action = 'q_solved';
	
				do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
				do_action('qa_action_question_solved', $q_id);
				
				
				
				
				
			}
		} else {
			$html['toast'] = __('Access Denied!', QA_TEXTDOMAIN);
			
		}
		
		echo json_encode($html);
		die();
	}

	add_action('wp_ajax_qa_is_solved_action', 'qa_is_solved_action');
	add_action('wp_ajax_nopriv_qa_is_solved_action', 'qa_is_solved_action');
	
	
	
	
	function qa_ajax_question_suggestion() {
		
		$title = sanitize_text_field($_POST['title']);
		
		$args = array('post_type'=>'question', 'posts_per_page'=>5, 's'=>$title,);
		
		$wp_query = new WP_Query($args);
		
		
		if ( $wp_query->have_posts() ) : 
		
		
		

		while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
		echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		
		
		endwhile;
		wp_reset_query();

		endif;
		
		die();
		}
	add_action('wp_ajax_qa_ajax_question_suggestion', 'qa_ajax_question_suggestion');
	add_action('wp_ajax_nopriv_qa_ajax_question_suggestion', 'qa_ajax_question_suggestion');
	
	
	
	
	
	
	
	
	
	

	function qa_search_user( $search_item, $string, $seperator = ',' ) {
		if( empty($string) ) return false;
		$str_arr = explode( $seperator, $string );
		foreach( $str_arr as $single_item ) {
			if( $search_item == $single_item ) return true;
		}
		return false;
	}
	
	// function qa_set_pages( $content = NULL ) {
		
		// $qa_page_question_post		=  get_option( 'qa_page_question_post' );
		// $qa_page_question_archive	=  get_option( 'qa_page_question_archive' );
		
		// if ( get_the_ID() == $qa_page_question_post ) $content .= '[qa_add_question]';
		// if ( get_the_ID() == $qa_page_question_archive ) $content .= '[question_archive]';
		
		
		// return $content;
	// }
	// add_filter( 'the_content', 'qa_set_pages' );
	
	
	function qa_toast_message() {
		echo "<div class='toast qa-shake' style='display:none'></div>";
	}
	add_action( 'wp_footer', 'qa_toast_message' );
	

	function qa_get_terms($taxonomy){

		if(!isset($taxonomy)){
			$taxonomy = 'question_category';
			}
		
		
		$args=array(
			
		  'orderby' => 'id',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'parent'  => 0,
		  );
		
		$categories = get_categories($args);

			
		$html = '';
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
					$name = $category->name;
					$cat_ID = $category->cat_ID;	
				
					$terms[$cat_ID] = 	$name;	
					
					$args_child=array(
						
					  'orderby' => 'id',
					  'taxonomy' => $taxonomy,
					  'hide_empty' => false,
					  'parent'  => $cat_ID,
					  );
					
					$categories_child = get_categories($args_child);
					
					if(!empty($categories_child))
					foreach($categories_child as $category_child){
						
						$name_child = $category_child->name;
						$cat_ID_child = $category_child->cat_ID;	
						
						$terms[$cat_ID_child] = $name_child;
						
						}
	
				}
			
			
			}
		else{
			$terms = array();
			}
		
		
		return $terms;

	}

	function qa_get_categories() {
		$args = array(
			'show_option_none' => __( 'Select category', QA_TEXTDOMAIN),
			'hide_empty'          => 0,
			'hierarchical'        => true,
			'order'               => 'ASC',
			'orderby'             => 'name',
			'taxonomy'            => 'question_cat',
			
		);
		$cat = get_terms( $args );
		$cat_arr = array();
		foreach( $cat as $cat_details ) {
			if ( $cat_details->parent == 0 ) $cat_arr[$cat_details->term_id]['0'] = $cat_details->name;
			else $cat_arr[$cat_details->parent][$cat_details->term_id] = $cat_details->name;
		}
		
		return $cat_arr;
	}
	
	
	add_action('admin_menu', 'qa_pending_question_count');

	function qa_pending_question_count() {
		
		global $menu;
		$count = 0;
		if ( current_user_can( 'administrator' ) )
			$count = (int)wp_count_posts( 'question' )->pending;
		
		if( $count > 0 ) {
			
			foreach ( $menu as $key => $value ) {
				if ( $menu[ $key ][2] == 'edit.php?post_type=question' ) {
					$menu[ $key ][0] .= ' <span class="awaiting-mod qa-pending-question-count count-' . $count . '"><span class="pending-count">' . $count . '</span></span>';
				}
			}
			
		}
		return true;
	}
	
	function qa_do_url( $url, $action, $args = array() ) {

		$args['wpas-do']       = $action;
		$args['wpas-do-nonce'] = wp_create_nonce( 'trigger_custom_action' );
		$url                   = esc_url( add_query_arg( $args, $url ) );

		return $url;

	}
	
	
	add_action('publish_post', 'update_question_status_meta');
	function update_question_status_meta($post_ID) {
		global $wpdb;
		if( !wp_is_post_revision($post_ID) && get_post_type($post_ID) == 'question' ) {
			update_post_meta( $post_ID, 'qa_question_status', 'processing' );
		}
	}
	
	
	//add_filter( 'pickform_filter_input_field_html', 'pickform_filter_input_field_select_hierarchy', 10, 2);
	
	
	function pickform_filter_input_field_select_hierarchy($field_html, $field_data) {
  
		$field_type = $field_data['input_type'];
  
		if($field_type=='select_hierarchy')  
		$field_html['select_hierarchy'] = array(
            'html'=>select_hierarchy($field_data),                            
        );                                    

		return $field_html;
	}
	
	function select_hierarchy($field_data){
	
		$html = '';
		$html.= '<div class="title">'.$field_data['title'].'</div>';    
		$html.= '<div class="details">'.$field_data['option_details'].'</div>';
		
		$html .= '<select id="question_cat" name="question_cat">';
		$html .= '<option value="">'.__('Select a Category', QA_TEXTDOMAIN).'</option>';
		$qa_categories = qa_get_categories();
		foreach( $qa_categories as $cat_id => $cat_info ) { ksort($cat_info);
			foreach( $cat_info as $key => $value ) {
				if( $key == 0 )  $html .= '<option value="'.$cat_id.'"><b>'.$value.'</b></option>';
				else $html .= '<option value="'.$key.'">  - '.$value.'</option>';
			}
		}
		$html .= '</select>';
        
		return $html;
	}
	
	
	add_filter( 'qa_filters_question_list_sections',  'qa_filters_function_question_list_sections' );
	function qa_filters_function_question_list_sections() {
		
		$sections = array(
			'question_category' => array (
				'css_class'	=> 'question_answer',
				'title'		=> __('Category', QA_TEXTDOMAIN),
			),
		);
		

		return $sections;
	}
	
	function question_filter_function_question_category() {
		global $post;
		
		$category = get_the_terms( $post->ID, 'question_cat');
		
		return !empty( $category[0]->name ) ? $category[0]->name : '-';
	}

	function qa_filter_badwords( $content ){
		
		global $post;
		$arr_badwords 		= array();
		$filter_badwords 	= get_option( 'qa_options_filter_badwords', 'yes' );
		$badwords 			= get_option( 'qa_options_badwords', array() );
		$badwords_replacer	= get_option( 'qa_options_badwords_replacer', '---' );
		
		if( $filter_badwords != 'yes' || empty( $badwords ) ) return $content;
		
		if( !empty($post->post_type) && $post->post_type == 'question' || $post->post_type == 'answer' ) {
			
			foreach( explode( ',', $badwords ) as $word ) {
				$arr_badwords[] = $word;
				$arr_badwords[] = ucfirst($word);
				$arr_badwords[] = ucwords($word);
				$arr_badwords[] = strtoupper($word);
			}
			return str_replace( $arr_badwords , '<span title="'.__('Word moderate.', QA_TEXTDOMAIN).'" class="bad-word">'.$badwords_replacer.'</span>', $content );
		}
		else return $content;
	}
	//add_filter( 'the_content', 'qa_filter_badwords', 20 );
	add_filter( 'wp_filter_comment', 'qa_filter_badwords', 20 );

	
	function callback($buffer){
		return $buffer;
	}

	function qa_add_ob_start(){
		ob_start("callback");
	}

	function qa_flush_ob_end(){
		ob_end_flush();
	}

	add_action('init', 'qa_add_ob_start');
	add_action('wp_footer', 'qa_flush_ob_end');
	
	function qa_featured_authors( $args = array() ) {
		global 	$wpdb;
		
		$authors	= array();
		$args 		= wp_parse_args( $args );
		
		$POST_TYPE 	= isset( $args['post_type'] ) ? $args['post_type'] : 'post';
		$LIMIT 		= isset( $args['limit'] ) ? 'LIMIT '. $args['limit'] : '';
		
		foreach ( $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = '".$POST_TYPE."' AND " . get_private_posts_cap_sql( $POST_TYPE ) . " GROUP BY post_author ORDER BY count DESC $LIMIT") as $row ) :
			$author = get_userdata( $row->post_author );
			$authors[$row->post_author]['name'] = $author->display_name;
			$authors[$row->post_author]['post_count'] = $row->count;
		endforeach;

		return $authors;
	}
	
	function qa_ajax_change_question_status() {
		
		$question_id 	= (int)sanitize_text_field($_POST['question_id']);
		$selected 		= sanitize_text_field( $_POST['selected'] );
		
		$QuestionID = wp_update_post( array(
			'ID'          => $question_id,
			'post_status' => $selected,
		) );

		if( $QuestionID == 0 ) echo '';
		else
			echo get_permalink( $QuestionID );
		
		die();
	}

	add_action('wp_ajax_qa_ajax_change_question_status', 'qa_ajax_change_question_status');
	add_action('wp_ajax_nopriv_qa_ajax_change_question_status', 'qa_ajax_change_question_status');
	
	
	
	
