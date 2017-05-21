<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	global $current_user;
	$qa_account_required_post_answer = get_option( 'qa_account_required_post_answer', 'yes' );
	$qa_submitted_answer_status = get_option( 'qa_submitted_answer_status', 'pending' );
	$qa_options_quick_notes = get_option( 'qa_options_quick_notes' );
	$qa_who_can_comment_answer = get_option( 'qa_who_can_comment_answer' );	
	

    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    $current_user_role = array_shift( $roles );
	
	//var_dump($current_user_role);
	//var_dump($qa_who_can_answer);	
	
	if(!empty($qa_who_can_answer) && !in_array( $current_user_role, $qa_who_can_answer)){
		return;
		}
	
?>

<div class="answer-post  clearfix">
	
	<div class="answer-post-header" _status="0">
		<span class="fs_18"><?php echo __('Submit Answer', QA_TEXTDOMAIN);?></span>
		<i class="fa fa-expand fs_28 float_right apost_header_status"></i>		
	</div>
	
	
<?php 

	if ( !is_user_logged_in() ) {
		if( $qa_account_required_post_answer=='yes' ){
			

			
			echo sprintf( __('<form class="nodisplay">Please <a href="%s">login</a> to submit answer.</form>', QA_TEXTDOMAIN), wp_login_url($_SERVER['REQUEST_URI'])  ) ;
			
			// Closing div .answer-post
			echo '</div>';
			return;
		}
	}
?>


	<form class="form-answer-post pickform" enctype="multipart/form-data" class="" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    
    <?php 

//var_dump($qa_options_quick_notes);
?>

        
        <?php
        
		if(current_user_can('manage_options') && !empty($qa_options_quick_notes)){
			
?>
    	<div class="quick-notes">
        <strong><?php echo __('Quick notes', QA_TEXTDOMAIN); ?></strong>
        <?php
			
			foreach($qa_options_quick_notes as $note){
				
				echo '<input onclick="this.select();" type="text" value="'.$note.'" />';
				
				}
			
			?>
            </div>
            <?php
			
			}

		?>
        

        

    
<?php 
	$editor_id 		= 'qa-answer-editor';
	$editor_content	= '';
	$checked		= '';

	if ( !empty($_POST) ) {
		
		$is_private 	= isset( $_POST['is_private'] ) ? sanitize_text_field($_POST['is_private']) : '';
		$editor_content = isset( $_POST[$editor_id] ) ? $_POST[$editor_id] : '';
		
		
		$filter = apply_filters( 'qa_filter_kses', array(
			'a'             => array(
				'href'  => array(),
				'title' => array()
			),
			'br'            => array(),
			'em'            => array(),
			'strong'        => array(),
			'code'          => array(
				'class' => array()
			),
			'pre'          => array(
				'class' => array()
			),			
			
			'blockquote'    => array(),
			'quote'         => array(),
			'span'          => array(
				'style' 	=> array()
			),
			'img'           => array(
				'src'    	=> array(),
				'alt'    	=> array(),
				'width'  	=> array(),
				'height' 	=> array(),
				'style'  	=> array()
			),
			'ul'            => array(),
			'li'            => array(),
			'ol'            => array(),
		));

		//$answer_content = wp_kses( $editor_content, $filter );
		$answer_content = $editor_content;		
		
		
		
		
		
		
		
		
		if ( $is_private == 1 ) $checked = 'checked';
		
		if ( !empty( $editor_content) ) {
			
			$new_answer_post = array(
				'post_type'		=> 'answer',
				'post_title'    => __('#Replay', QA_TEXTDOMAIN).' - '.qa_shorten_string($answer_content) .' by '. $current_user->user_login ,
				'post_status'   => $qa_submitted_answer_status,
				'post_content'  => $answer_content,
			  
			);
			$new_answer_post_ID = wp_insert_post($new_answer_post, true);
			
			echo '<div class="validations">';
			echo '<div class="success"><i class="fa fa-check"></i> '.__('Answer submitted.', QA_TEXTDOMAIN).'</div>';
			echo '<div class="success"><i class="fa fa-check"></i> '.sprintf(__('Status: %s .', QA_TEXTDOMAIN), $qa_submitted_answer_status).'</div>';			
			echo '</div>';
			
			$userid = get_current_user_id();
			
			$q_id = get_the_ID();
			$a_id = $new_answer_post_ID;
			$c_id = '';
			$user_id = $userid;
			$action = 'new_answer';

			do_action('qa_action_notification_save', $q_id, $a_id, $c_id, $user_id, $action);
			do_action( 'qa_email_action_question_submit', $q_id );
			
			
			
			
			/*
			By answering subscribe to question.
			*/
			$q_subscriber = get_post_meta(get_the_ID(), 'q_subscriber', true);
			
			if(empty($q_subscriber)){
				update_post_meta(get_the_ID(),'q_subscriber',array($userid) );
				
				}
			else{
				
				if(!in_array($userid,$q_subscriber)){
					
					$q_subscriber = array_merge($q_subscriber, array($userid));
					update_post_meta(get_the_ID(),'q_subscriber',$q_subscriber );
					
					}

				
				}
			
		
					
			update_post_meta($new_answer_post_ID,'qa_answer_question_id', get_the_ID() );
			update_post_meta($new_answer_post_ID,'qa_answer_is_private', $is_private );
			
			wp_safe_redirect( wp_get_referer() );
			$editor_content = '';
			}
		else{
			
			echo '<div class="validations">';
			echo '<div class="failed"><i class="fa fa-exclamation-circle"></i> '.__('Content is empty.', QA_TEXTDOMAIN).'</div>';
			
			echo '</div>';
			
			}
		
		
		
		
		
		
	}
	
	wp_editor( 
		$editor_content, 
		$editor_id, 
		$settings = array( 
			'editor_height' 	=> 150, 
			//'teeny' 			=> true ,
			'tinymce' 			=> true ,	
			'quicktags' 		=> true ,							
			'media_buttons' 	=> false ,	
			'drag_drop_upload' 	=> false ,								
	
		)
	);
?>
	<br>
	<div class="qa_tt">
		<label for="is_private">
			<input id="is_private" type="checkbox" <?php echo $checked; ?> class="" value="1" name="is_private" />
			<?php echo __('Make your answer private.', QA_TEXTDOMAIN); ?>
			
		</label>
		
	</div>
	<br><br>
	<div class="qa_tt">
		
        <?php
         wp_nonce_field( 'answer_nonce_check_value' );
		?>
		<input id="is_private" type="submit" class="submit submit_answer_button" value="<?php echo __('Submit Answer',QA_TEXTDOMAIN); ?>" />
		<span class="qa_ttt"><?php echo __('Your answer will be under review.', QA_TEXTDOMAIN); ?></span>
		
	</div>
	
	</form>
	
</div> <!-- .answer-post -->


