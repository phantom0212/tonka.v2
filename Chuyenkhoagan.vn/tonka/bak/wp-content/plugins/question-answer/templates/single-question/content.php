<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

?>

<?php do_action('qa_action_single_question_content_before'); 

	$author_id 	= get_post_field( 'post_author', get_the_ID() );
	$author 	= get_userdata($author_id);
	
	$polls = get_post_meta(get_the_ID(), 'polls', true);
	if(is_serialized($polls)){
		$polls = unserialize($polls);
		}
	
	$author_name = !empty( $author->display_name ) ? $author->display_name : $author->user_login; 
	$author_role = !empty( $author->roles ) ? $author->roles[0] : __('Anonymous', QA_TEXTDOMAIN); 
	$author_date = !empty( $author->user_registered ) ? $author->user_registered : 'N/A'; 
	
	
	$comments = get_comments( array(
		'post_id' 	=> get_the_ID(), 
		'order' 	=> 'ASC', 
		'status'	=> 'approve', 
	) );
	
	$qa_allow_question_comment = get_option( 'qa_allow_question_comment', 'yes' );
	if( $qa_allow_question_comment == 'no' ) $comments = array();
	
	
	global $qa_css;
	
	$qa_color_single_user_role = get_option( 'qa_color_single_user_role' );
	if( empty( $qa_color_single_user_role ) ) $qa_color_single_user_role = '';
	
	$qa_color_single_user_role_background = get_option( 'qa_color_single_user_role_background' );
	if( empty( $qa_color_single_user_role_background ) ) $qa_color_single_user_role_background = '';
	
	$qa_color_add_comment_background = get_option( 'qa_color_add_comment_background' );
	if( empty( $qa_color_add_comment_background ) ) $qa_color_add_comment_background = '';
	
	
	$qa_css .= ".single-question .qa-user-role{ color: $qa_color_single_user_role; background-color: $qa_color_single_user_role_background; } 
	.single-question .qa-add-comment, .single-question .qa-cancel-comment { background: $qa_color_add_comment_background; }	";
	
	//var_dump($author);
	
	
?>

<div itemprop="description" class="content">
	
	<div class="content-header">
		<div class="question-author-avatar meta"> <?php echo get_avatar( $author->user_email, "45" ); ?></div>
		<div class="qa-users-meta meta">
			<span itemprop="author" itemscope itemtype="http://schema.org/Person" class="qa-user">
				<span itemprop="name"><?php echo $author_name; ?></span>
            </span>
			<span class="qa-user-role"><?php echo ucfirst($author_role); ?></span>
			<span class="qa-user-badge"><?php echo apply_filters('qa_filter_single_question_badge','',$author->ID, 2); ?></span>            
			<span class="qa-member-since"><?php echo sprintf( __('Member Since %s', QA_TEXTDOMAIN), date( "M Y", strtotime( $author_date ) )); ?><?php //echo date( "M Y", strtotime( $author_date ) ); ?></span>
		</div>
		
		
		<?php do_action('qa_action_single_question_meta'); ?>
		
		
	</div> <!-- End Content Header -->
	
	<div class="content-body"> <?php the_content(); ?> 
    
   
        <ul class="qa-polls">
        <?php
        if(!empty($polls) && is_array($polls)){
			
			foreach($polls as $id=>$poll){
				
				if(!empty($poll))
				echo '<li q_id="'.get_the_ID().'" data-id="'.$id.'"><i class="fa fa-circle-o" aria-hidden="true"></i><i class="fa fa-dot-circle-o" aria-hidden="true"></i> '.$poll.'</li>';
				
				}
			
			}

        ?>
        </ul>


    
    <div class="poll-result">
    	<i class="loading fa fa-spinner fa-spin" aria-hidden="true"></i>
        <div class="results">
        <?php 
		
		$poll_result = get_post_meta(get_the_ID(), 'poll_result', true);
		if(!empty($poll_result) && is_array($poll_result)){
			
			$total = count($poll_result);
			$count_values = array_count_values($poll_result);		
			//var_dump($count_values);
			echo '<div class="">'.__('Total:', QA_TEXTDOMAIN).' '.$total.'</div>';
			
			foreach($count_values as $id=>$value){
				
				echo '<div class="poll-line"><div style="width:'.(($value/$total)*100).'%" class="fill">&nbsp;'.$polls[$id].' - ('.$value.')'.' </div></div>';
				
				}
			
			}

		
		
		//var_dump($poll_result);
		?>
        </div>
        
    </div>
    
    
    
	<div class="qa-content-tags"> 
	 
	<?php 
	
	
	$tag_list = wp_get_post_terms(get_the_ID(), 'question_tags', array("fields" => "all"));	
	$total_tag = count($tag_list);
	
	if(!empty($tag_list)){
		
		$tag_html = '';
		$i=1;
		foreach($tag_list as $tag){
			
			$tag_html.= '<a class="tag" href="#">'.$tag->name.'</a>';
			if($total_tag!=$i){
				$tag_html.= ' ';
				}
			
			$i++;
			}
		
		}
	else{
		
		$tag_html = __('N/A', QA_TEXTDOMAIN);
		}
		
	echo apply_filters( 'qa_filter_single_question_tags', __('Tags: ', QA_TEXTDOMAIN ).$tag_html );
	
	 ?>
     
     </div> <!-- End of Tags --> 
	
	
		<ul class="qa-comments">
		
		<?php 
		$status = 0;
		$tt_text = '<i class="fa fa-lock"></i> '.__('Login First', QA_TEXTDOMAIN);
		
	
		$current_user 	= wp_get_current_user();
		$user_ID		= $current_user->ID;
		
		
		if( !empty($user_ID) ) {
			$status = 1;
			$tt_text = '<i class="fa fa-thumbs-down"></i> '.__('Report this', QA_TEXTDOMAIN);
		}
		
		foreach( $comments as $comment ) {
			
			$qa_flag_comment 	= get_comment_meta( $comment->comment_ID, 'qa_flag_comment', true );
			$count_flag 		= count(explode(',', $qa_flag_comment ) ) - 1;
			
			if( !empty($user_ID) && qa_search_user($user_ID, $qa_flag_comment) ) {
				
				$flag_html = '
				<span class="qa-comment-action float_right qa_tt" action="unflag" user_id="'.$user_ID.'" status="'.$status.'" comment_id="'.$comment->comment_ID.'"> 
					'.__('Unflag', QA_TEXTDOMAIN).' ('.$count_flag.')
					<span class="qa_ttt qa_w_160"><i class="fa fa-undo"></i> '.__('Undo Report', QA_TEXTDOMAIN).'</span>
				</span>';
				
			} else {
				
				$flag_html = '
				<span class="qa-comment-action float_right qa_tt" action="flag" user_id="'.$user_ID.'" status="'.$status.'" comment_id="'.$comment->comment_ID.'"> 
					'.__('Flag', QA_TEXTDOMAIN).' ('.$count_flag.')
					<span class="qa_ttt qa_w_160">'.$tt_text.'</span>
				</span>';
				
			}
			
			
			
			echo '
			<li id="comment-'.$comment->comment_ID.'" class="qa-single-comment clearfix ">
				
				<div class="qa-avatar float_left">'.get_avatar( $comment->comment_author_email, "30" ).'</div>
				<div class="qa-comment-content">
					<div class="ap-comment-header">
					
					
						<a href="#" class="ap-comment-author">'.$comment->comment_author.'</a> ';
						
							$comment_date = new DateTime($comment->comment_date);
							$comment_date = $comment_date->format('M d, Y h:i A');
						
						echo '<a href="'.get_permalink(get_the_ID()).'#comment-'.$comment->comment_ID.'"> - '.$comment_date.' </a>

						'.$flag_html.'
					</div>
					<div class="ap-comment-texts">';
					
					ob_start();
					qa_filter_badwords( comment_text( $comment->comment_ID ) );
					echo ob_get_clean();
					
					echo '</div>
				</div>
			
			</li>';
			
			
		}
		
		if( $qa_allow_question_comment == 'yes' ) { 
		?>
			<li class="qa-single-comment clearfix qa-add-comment"> <span><i class="fa fa-reply"></i> <?php echo __('Reply on This', QA_TEXTDOMAIN); ?></span></li>
			<li class="qa-single-comment clearfix qa-comment-form nodisplay"><?php comment_form(); ?></li>
			<li class="qa-single-comment clearfix qa-cancel-comment nodisplay"> <span> <?php echo __('Cancel', QA_TEXTDOMAIN); ?></span></li>
		<?php } ?>
		
		</ul>
		
	
	</div> <!-- End of Content Body --> 
	
	
</div>

<?php do_action('qa_action_single_question_content_after'); ?>


