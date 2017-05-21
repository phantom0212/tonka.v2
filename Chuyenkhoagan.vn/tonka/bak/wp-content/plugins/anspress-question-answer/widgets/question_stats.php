<?php
/**
 * AnsPress question stats widget
 * Widget for showing question stats
 * @package AnsPress
 * @author Rahul Aryan <support@anspress.io>
 * @license GPL 2+ GNU GPL licence above 2+
 * @link https://anspress.io
 * @since 2.0.0-alpha2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

class AnsPress_Stats_Widget extends WP_Widget {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		parent::__construct(
			'ap_stats_widget',
			__( '(AnsPress) Question Stats', 'anspress-question-answer' ),
			array( 'description' => __( 'Shows question stats in single question page.', 'anspress-question-answer' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$ans_count 		= ap_question_get_the_answer_count();
		$last_active 	= ap_question_get_the_active_ago();
		$total_subs 	= ap_question_get_the_subscriber_count();
		$view_count 	= ap_question_get_the_view_count();
		$last_active_time = ap_human_time( mysql2date( 'G', $last_active ) );

		echo '<div class="ap-widget-inner">';

		if ( is_question() ) {
			echo '<ul class="ap-stats-widget">';
			echo '<li><span class="stat-label apicon-pulse">'.__( 'Active', 'anspress-question-answer' ). '</span><span class="stat-value"><time class="published updated" itemprop="dateModified" datetime="'.mysql2date( 'c', $last_active ).'">'. $last_active_time .'</time></span></li>' ;
			echo '<li><span class="stat-label apicon-eye">'.__( 'Views', 'anspress-question-answer' ). '</span><span class="stat-value">'.sprintf( _n( 'One time', '%d times', $view_count, 'anspress-question-answer' ), $view_count ).'</span></li>' ;
			echo '<li><span class="stat-label apicon-answer">'.__( 'Answers', 'anspress-question-answer' ). '</span><span class="stat-value">'.sprintf( _n( '%2$s1%3$s answer', '%2$s%1$d%3$s answers', $ans_count, 'anspress-question-answer' ), $ans_count, '<span data-view="answer_count">', '</span>' ).'</span></li>' ;
			echo '<li><span class="stat-label apicon-mail">'.__( 'Followers', 'anspress-question-answer' ). '</span><span class="stat-value">'.sprintf( _n( '1 follower', '%d followers', $total_subs, 'anspress-question-answer' ), $total_subs ).'</span></li>' ;
			echo '</ul>';
		} else {
			_e( 'This widget can only be used in single question page', 'anspress-question-answer' );
		}

		echo '</div>';

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Question stats', 'anspress-question-answer' );
		}
		?>
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'anspress-question-answer' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}

function ap_stats_register_widgets() {
	register_widget( 'AnsPress_Stats_Widget' );
}

add_action( 'widgets_init', 'ap_stats_register_widgets' );
