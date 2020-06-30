<?php
// thb Featured Video
class widget_thbfeaturedvideo extends WP_Widget {
	function __construct() {
	   $widget_ops = array(
	   		'classname'   => 'widget_featured_video',
	   		'description' => esc_html__('Display an embeded video on your sidebar','thevoux')
	   	);

	   	parent::__construct(
	   		'thb_featuredvideo_widget',
	   		esc_html__( 'Fuel Themes - Featured Video' , 'thevoux' ),
	   		$widget_ops
	   	);

	   	$this->defaults = array( 'title' => 'Featured Video', 'embed' => '', 'video_title' => '' );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$video_title = $instance['video_title'];
		$embed = $instance['embed'];
		global $wp_embed;
		// Output
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');

		if ($video_title) {
			echo '<h6>'.esc_attr($video_title).'</h6>';
		}

		echo $wp_embed->run_shortcode('[embed]'.$embed.'[/embed]');

		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_title'] = strip_tags( $new_instance['video_title'] );
		$instance['embed'] = strip_tags( $new_instance['embed'] );

		return $instance;
	}
	// Settings form
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'video_title' )); ?>"><?php esc_html_e('Video Title:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'video_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'video_title' )); ?>" value="<?php echo esc_attr($instance['video_title']); ?>"  class="widefat" />
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'embed' )); ?>"><?php esc_html_e('Video URL:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'embed' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'embed' )); ?>" value="<?php echo esc_attr($instance['embed']); ?>"  class="widefat" />
		</p>
    <?php
	}
}