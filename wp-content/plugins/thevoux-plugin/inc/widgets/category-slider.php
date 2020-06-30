<?php
// thb Category Slider
class widget_categoryslider extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_categoryslider',
			'description' => esc_html__('Display category posts in a slider','thevoux')
		);

		parent::__construct(
			'thb_categoryslider_widget',
			esc_html__( 'Fuel Themes - Category Slider' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => 'Category', 'style' => 'style1', 'show' => '3', 'category' => '', 'autoplay' => 'true' );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$style = $instance['style'];
		$show = $instance['show'];
		$category = $instance['category'];
		$autoplay = $instance['autoplay'];

		$args = array(
			'nopaging' => 0,
			'cat' => $category,
			'post_type'=>'post',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'no_found_rows' => true,
			'suppress_filters' => 0,
			'posts_per_page' => $show
		);

		$widget_posts = new WP_Query( $args );

		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		?>
		<div class="slick dark-pagination category-slider-<?php echo esc_attr($style); ?>" data-columns="1" data-pagination="true" data-navigation="false" data-autoplay="<?php echo esc_attr($autoplay); ?>">

		<?php while  ($widget_posts->have_posts()) : $widget_posts->the_post(); ?>
			<?php add_filter( 'excerpt_length', 'thb_widget_excerpt_length' ); ?>
			<?php if (!$style || $style === 'style1') { ?>
				<div <?php post_class('post text-center style1'); ?>>
					<figure class="post-gallery">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thevoux-style3'); ?></a>
					</figure>
					<div class="post-title">
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					</div>
					<div class="post-content small">
					<?php the_excerpt(); ?>
					</div>
				</div>
			<?php } else { ?>
				<div>
				<div <?php post_class('post cover-image text-center category-widget-slider'); ?>>
					<div class="thb-placeholder">
						<?php the_post_thumbnail('thevoux-style3'); ?>
					</div>
					<div class="featured-title">
						<?php do_action('thb_post_top', true, false); ?>
						<div class="post-title">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						</div>
						<?php get_template_part( 'inc/templates/postbits/post-just-shares' ); ?>
					</div>
				</div>
				</div>
			<?php } ?>
		<?php endwhile;
		echo '</div>';
		echo $after_widget;

		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['show'] = strip_tags( $new_instance['show'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		return $instance;
	}
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults );
		$style = $instance['style'];
		$autoplay = $instance['autoplay'];
		$categories = get_categories();
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('style1')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style1')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style1" <?php if($style === 'style1' || !$style){ echo 'checked="checked"'; } ?> /> Style 1
			</label><br>
			<label for="<?php echo esc_attr($this->get_field_id('style2')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style2')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style2" <?php if($style === 'style2'){ echo 'checked="checked"'; } ?> /> Style 2
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e('Category:', 'thevoux'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'category' )); ?>"class="widefat">
				<?php foreach( $categories as $category) { ?>
				<option value="<?php echo esc_attr($category->cat_ID); ?>" <?php if ($category->cat_ID == $instance['category']) { echo 'selected="selected"';} ?>><?php echo esc_html($category->cat_name); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'name' )); ?>"><?php esc_html_e('Number of Posts:', 'thevoux'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" type="checkbox" value="true" <?php if($autoplay === 'true'){ echo 'checked="checked"'; } ?> /> Enable Autoplay?
			</label>
		</p>
		<?php
	}
}