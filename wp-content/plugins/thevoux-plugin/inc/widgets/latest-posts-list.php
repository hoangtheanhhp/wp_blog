<?php
// thb latest Posts List
class widget_latestlist extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_latestlist',
			'description' => esc_html__('Display latest posts with excerpts','thevoux')
		);

		parent::__construct(
			'thb_latestlist_widget',
			esc_html__( 'Fuel Themes - Latest Posts with Excerpts' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => 'Latest Posts', 'show' => '3' );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];
		global $post;
		$pop = new WP_Query();
		$pop->query('showposts='.$show.'');

		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		echo '<ul>';
		while  ($pop->have_posts()) : $pop->the_post(); ?>
			<?php add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' ); ?>
			<li class="post cf">
				<?php do_action('thb_post_top', false, true); ?>
				<header class="post-title">
					<h6><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
				</header>
				<div class="post-content small">
				<?php the_excerpt(); ?>
				</div>
			</li>
		<?php endwhile;
		echo '</ul>';
		echo $after_widget;

		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show'] = strip_tags( $new_instance['show'] );

		return $instance;
	}
	function form($instance) {
	$defaults = $this->defaults;
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'name' )); ?>"><?php esc_html_e('Number of Posts:', 'thevoux'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>" class="widefat" />
	</p>
   <?php
	}
}