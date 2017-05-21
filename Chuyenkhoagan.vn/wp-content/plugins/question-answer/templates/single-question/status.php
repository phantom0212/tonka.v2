<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	if( ! current_user_can('administrator') ) return;
	
	$question_status = get_post_status( get_the_ID() );
	
?>

	<form class="qa_question_status" action="" method="GET">
	
		<select name="question_status" class="question_status" question_id="<?php echo get_the_ID(); ?>">
			<option <?php echo selected( 'pending', $question_status ) ?> value="pending"><?php echo __('Pending', QA_TEXTDOMAIN); ?></option>
			<option <?php echo selected( 'publish', $question_status ) ?> value="publish"><?php echo __('Publish', QA_TEXTDOMAIN); ?></option>
			<option <?php echo selected( 'draft', $question_status ) ?> value="draft"><?php echo __('Draft', QA_TEXTDOMAIN); ?></option>
			<option <?php echo selected( 'trash', $question_status ) ?> value="trash"><?php echo __('Trash', QA_TEXTDOMAIN); ?></option>
		</select>
	
	</form>