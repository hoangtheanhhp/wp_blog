<?php
// thb Instagram Widget
class widget_thbinstagram extends WP_Widget {
	function __construct(){
		$widget_ops = array(
			'classname'   => 'widget_flickr',
			'description' => esc_html__('Display Your Instagram Images','thevoux')
		);

		parent::__construct(
			'thb_instagram_widget',
			esc_html__( 'Fuel Themes - Instagram' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => 'Instagram', 'show' => '9' );
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];

		// Output
		echo $before_widget;
		echo $before_title . $title . $after_title;

		$instagram = thb_getInstagramPhotos($show);

		?>
			<div class="photocontainer">
				<?php foreach ($instagram as $item) { ?>
					<div class="overlay-effect">
						<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
							<a href="<?php echo esc_attr($item['link']); ?>" target='_blank'></a>
						</figure>
					</div>
				<?php } ?>
			</div>
		<?php
		echo $after_widget;
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show'] = strip_tags( $new_instance['show'] );

		return $instance;
	}
	// Settings form
	public function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

    <p><?php esc_html_e('Please make sure that you have filled the Instagram settings inside your Theme Options', 'thevoux'); ?></p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Images:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>"  class="widefat" />
		</p>
    <?php
	}
}