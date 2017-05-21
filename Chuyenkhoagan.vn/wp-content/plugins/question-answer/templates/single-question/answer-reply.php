<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$current_user	= wp_get_current_user();


	$qa_who_can_comment_answer = get_option( 'qa_who_can_comment_answer' );	
	$author_id 	= get_post_field( 'post_author', get_the_ID() );
	$author 	= get_userdata($author_id);
	
	$qa_answer_is_private 	= get_post_meta( get_the_ID(), 'qa_answer_is_private', true );
	
	$question_id = get_post_meta( get_the_ID(), 'qa_answer_question_id', true );
	$question_author_id = get_post_field( 'post_author', $question_id );
	
	

	
	//if ( $qa_answer_is_private == '1' && !in_array('administrator',  wp_get_current_user()->roles)  ) return;
	
	//echo '<pre>';print_r($current_user);echo '</pre>';


    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    $current_user_role = array_shift( $roles );
	
	//var_dump($current_user);
	//var_dump($qa_who_can_answer);	
	




	if ( $qa_answer_is_private == '1' ) { 
		

		
		
		if( $question_author_id == $current_user->ID || in_array( $current_user_role, $qa_who_can_comment_answer) || $author_id == $current_user->ID ){
			

			
			$private_answer_access = 'yes';
			
						
			?>
					<div class="qa-answer-comment-reply qa-answer-comment-reply-<?php echo get_the_ID(); ?> clearfix ">
						
						
						
						
					<?php 
						$comments = get_comments( array(
								
								'post_id' 	=> get_the_ID(), 
								'order' 	=> 'ASC', 
								'status'	=> 'approve', 
								
							) );
						
						
						foreach( $comments as $comment ) {
								
								$comment_date 	= new DateTime($comment->comment_date);
								$comment_date 	= $comment_date->format('M d, Y h:i A');
								$comment_author	= get_comment_author( $comment->comment_ID ); 
								
								//var_dump($comment_date);
								
								if(!empty($comment->comment_author)){
									
									$comment_author = $comment->comment_author;
									}
									
								else{
									$comment_author =  __('Anonymous', QA_TEXTDOMAIN);
									}
								
								
								
								
								echo '
								<div id="comment-'.$comment->comment_ID.'" class="qa-single-comment single-reply">
									
									<div class="qa-avatar float_left">'.get_avatar( $comment->comment_author_email, "30" ).'</div>
									<div class="qa-comment-content">
										<div class="ap-comment-header">
											<a href="#" class="ap-comment-author">'.$comment_author.'</a> - <a class="comment-link" href="#comment-'.$comment->comment_ID.'"> '.$comment_date.'</a>
											
										</div>
										<div class="ap-comment-texts">';
										
										ob_start();
										qa_filter_badwords( comment_text( $comment->comment_ID ) );
										echo ob_get_clean();
										
										
										echo '</div>
									</div>
								
								</div>
								';
								
							}
					?>
				</div>
                
                
				<?php
                    $current_user_ID = get_current_user_id();
                    
                    if ( $current_user_ID == 0 ) {
                ?>
                    <a class="qa-answer-reply" href="<?php echo wp_login_url( $_SERVER['REQUEST_URI'] ); ?> ">
                        <i class="fa fa-sign-in"></i>
                            <span><?php echo __('Sign in to Reply', QA_TEXTDOMAIN); ?></span>
                    </a>		
                <?php
                    } else {
                    
                        
                ?>
                    <div class="qa-answer-reply" post_id="<?php echo get_the_ID(); ?>">
                        <i class="fa fa-reply"></i>
                            <span><?php echo __('Reply on This', QA_TEXTDOMAIN); ?></span>
                    </div>
                <?php
                    }
                ?> 
                
                
                
                
                
			<?php
						
			
			
			
			
			
			
			}
		else{
			$private_answer_access = 'no';
			}
			
			
			
			
			
			
			
			
		}
	else{
				
		?>
		<div class="qa-answer-comment-reply qa-answer-comment-reply-<?php echo get_the_ID(); ?> clearfix ">
			
			
			
			
		<?php 
			$comments = get_comments( array(
					
					'post_id' 	=> get_the_ID(), 
					'order' 	=> 'ASC', 
					'status'	=> 'approve', 
					
				) );
			
			
			foreach( $comments as $comment ) {
					
					$comment_date 	= new DateTime($comment->comment_date);
					$comment_date 	= $comment_date->format('M d, Y h:i A');
					$comment_author	= get_comment_author( $comment->comment_ID ); 
					
					//var_dump($comment_author_user_data);
					$comment_author_user_data = get_user_by('email', $comment->comment_author_email);
					//var_dump($comment_author_user_data);
					
					if(!empty($comment->comment_author)){
						
						$comment_author = $comment->comment_author;
						}
						
					else{
						$comment_author =  __('Anonymous', QA_TEXTDOMAIN);
						}
					
					
					
					
					echo '
					<div id="comment-'.$comment->comment_ID.'" class="qa-single-comment single-reply">
						
						<div class="qa-avatar float_left">'.get_avatar( $comment->comment_author_email, "30" ).'</div>
						<div class="qa-comment-content">
							<div class="ap-comment-header">
								<a href="#" class="ap-comment-author">'.$comment_author_user_data->display_name.'</a> - <a class="comment-link" href="#comment-'.$comment->comment_ID.'"> '.$comment_date.'</a>
								
							</div>
							<div class="ap-comment-texts">';
							
							ob_start();
							qa_filter_badwords( comment_text( $comment->comment_ID ) );
							echo ob_get_clean();
							
							
							echo '</div>
						</div>
					
					</div>
					';
					
				}
		?>
	</div>
    
    
<?php
	$current_user_ID = get_current_user_id();
	
	if ( $current_user_ID == 0 ) {
?>
	<a class="qa-answer-reply" href="<?php echo wp_login_url( $_SERVER['REQUEST_URI'] ); ?> ">
		<i class="fa fa-sign-in"></i>
			<span><?php echo __('Sign in to Reply', QA_TEXTDOMAIN); ?></span>
	</a>		
<?php
	} else {
	
		
?>
	<div class="qa-answer-reply" post_id="<?php echo get_the_ID(); ?>">
		<i class="fa fa-reply"></i>
			<span><?php echo __('Reply on This', QA_TEXTDOMAIN); ?></span>
	</div>
<?php
	}

		
		
}

?>
	
	
	


	
	<div class="qa-reply-popup qa-reply-popup-<?php echo get_the_ID(); ?>">
		<div class="qa-reply-form">
			<span class="close"><i class="fa fa-times"></i></span>
			<span class="qa-reply-header"><?php echo __('Replying as', QA_TEXTDOMAIN); ?> <?php echo $current_user->display_name; ?></span>
			<textarea rows="4" cols="40" id="qa-answer-reply-<?php echo get_the_ID(); ?>"></textarea>
			<span class="qa-reply-form-submit" id="<?php echo get_the_ID(); ?>"><?php echo __('Submit', QA_TEXTDOMAIN); ?></span>
		</div>	
	</div>
	