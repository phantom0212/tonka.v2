<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class QAWidgetLeaderboard extends WP_Widget {

	function __construct() {
		
		parent::__construct( 'qa_widget_leaderboard', __('Question Answer - Leaderboard', QA_TEXTDOMAIN), array( 'description' => __( 'Show Leaderboard.', QA_TEXTDOMAIN ), ) );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$limit = apply_filters( 'widget_title', $instance['limit'] );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];
		
		$limit_count = ( (int)$limit > 0 ) ? (int)$limit : 1;
		
		$featured_author = qa_featured_authors( 'post_type=answer&limit='.$limit_count );
		
		echo '<div class="qa_featured_author">';
		
		foreach( $featured_author as $ID => $author ) {
			
			echo '<div class="single_author">';
			
			echo sprintf('<div class="author_avatar">%s</div>',  get_avatar( $ID, "45" ) ); 
			
			echo sprintf('<div class="author_name">%s</div>',  ucwords($author['name'] ) );
			
			echo sprintf( '<div class="author_answered">'.__('Total answers: %s', QA_TEXTDOMAIN).'</div>', $author['post_count'] );
			
			echo '</div>';
			
		} 
		
		
		echo '</div>';
		
		// echo '<pre>'; print_r( $featured_author ); echo '</pre>';
		
		
		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		
		$title = isset( $instance[ 'title' ] ) ? $title = $instance[ 'title' ] : __( 'Leaderboard', QA_TEXTDOMAIN );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
		
		$limit = isset( $instance[ 'limit' ] ) ? $limit = $instance[ 'limit' ] : __( 'Leaderboard', QA_TEXTDOMAIN );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" value="<?php echo esc_attr( $limit ); ?>" />
		</p>
		<?php
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
		return $instance;
	}
}