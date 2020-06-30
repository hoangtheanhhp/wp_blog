<?php
// thb Social counter
class widget_socialcounter extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_socialcounter',
			'description' => esc_html__('Display a Social Counter','thevoux')
		);

		parent::__construct(
			'thb_socialcounter_widget',
			esc_html__( 'Fuel Themes - Social Counter' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array(
			'title' => 'Social Counter',
			'style' => 'style1',
			'show' => '3',
			'Twitter' => false,
			'Facebook' => false,
			'Instagram' => false,
			'Google' => false,
			'Debug' => false );
	}

	function widget($args, $instance) {
		extract($args);

		$style = isset($instance['style']) ? $instance['style'] : 'style1';
		$twitter = $instance['Twitter'];
		$facebook = $instance['Facebook'];
		$instagram = $instance['Instagram'];
		$google = $instance['Google'];
		$count = array($twitter, $facebook,$instagram, $google);
		$debug = isset($instance['Debug']) ? $instance['Debug'] : false;
		// Output
		echo $before_widget;

		$classes[] = $style;
		$classes[] = 'cf';
		$classes[] = $style === 'style2' ? 'row small-up-'.sizeof(array_filter($count)) : false;
		?>
			<ul class="<?php echo implode(' ', $classes); ?>">
				<?php if ($facebook) { ?>
				<li class="columns"><a href="http://facebook.com/<?php echo ot_get_option('facebook_page_username'); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i> <?php do_action('thb_fbLikeCount', ot_get_option('facebook_page_id'), $debug); ?> <em><?php esc_html_e('Likes', 'thevoux'); ?></em> <span><?php esc_html_e('LIKE', 'thevoux'); ?></span></a></li>
				<?php } ?>
				<?php if ($twitter) { ?>
				<li class="columns"><a href="http://twitter.com/<?php echo ot_get_option('twitter_bar_username'); ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i> <?php do_action('thb_twFollowerCount', $debug); ?> <em><?php esc_html_e('Followers', 'thevoux'); ?></em> <span><?php esc_html_e('FOLLOW', 'thevoux'); ?></span></a></li>
				<?php } ?>
				<?php if ($instagram) { ?>
				<li class="columns"><a href="http://instagram.com/<?php echo ot_get_option('instagram_username'); ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i> <?php do_action('thb_insFollowerCount'); ?> <em><?php esc_html_e('Followers', 'thevoux'); ?></em> <span><?php esc_html_e('FOLLOW', 'thevoux'); ?></span></a></li>
				<?php } ?>
				<?php if ($google) { ?>
				<li class="columns"><a href="https://plus.google.com/<?php echo ot_get_option('gp_username'); ?>" class="google-plus" target="_blank"><i class="fa fa-google-plus"></i> <?php do_action('thb_gpFollowerCount'); ?> <em><?php esc_html_e('Fans', 'thevoux'); ?></em> <span><?php esc_html_e('LIKE', 'thevoux'); ?></span></a></li>
				<?php } ?>
			</ul>
		<?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['Twitter'] = strip_tags( $new_instance['Twitter'] );
		$instance['Facebook'] = strip_tags( $new_instance['Facebook'] );
		$instance['Instagram'] = strip_tags( $new_instance['Instagram'] );
		$instance['Google'] = strip_tags( $new_instance['Google'] );
		$instance['Debug'] = strip_tags( $new_instance['Debug'] );
		return $instance;
	}
	// Settings form
	function form($instance) {
		$defaults = array(
			'style' => 'style1',
			'Twitter' => false,
			'Facebook' => false,
			'Instagram' => false,
			'Google' => false,
			'Debug' => false,
		);
		$instance = wp_parse_args( $instance, $defaults );
		?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('style1')); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('style1')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style1" <?php if($instance['style'] === 'style1' || !$instance['style']){ echo 'checked="checked"'; } ?> /> Style 1
				</label><br>
				<label for="<?php echo esc_attr($this->get_field_id('style2')); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('style2')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style2" <?php if($instance['style'] === 'style2'){ echo 'checked="checked"'; } ?> /> Style 2
				</label>
			</p>
			<p>
		    <input id="<?php echo esc_attr($this->get_field_id('Twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('Twitter')); ?>" type="checkbox" <?php if ($instance['Twitter']) { ?>checked="checked" <?php } ?> />
		    <label for="<?php echo esc_attr($this->get_field_id('Twitter')); ?>"><?php esc_html_e('Display Twitter Counter?', 'thevoux'); ?></label>
		    <small><?php esc_html_e('Please make sure you fill out the settings inside Theme Options -> Twitter Oauth for Twitter Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo esc_attr($this->get_field_id('Facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('Facebook')); ?>" type="checkbox" <?php if ($instance['Facebook']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo esc_attr($this->get_field_id('Facebook')); ?>"><?php esc_html_e('Display Facebook Counter?', 'thevoux'); ?></label>
			  <small><?php esc_html_e('Please make sure you fill out the settings inside Theme Options -> Facebook Oauth for Facebook Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo esc_attr($this->get_field_id('Instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('Instagram')); ?>" type="checkbox" <?php if ($instance['Instagram']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo esc_attr($this->get_field_id('Instagram')); ?>"><?php esc_html_e('Display Instagram Counter?', 'thevoux'); ?></label>
			  <small><?php esc_html_e('Please make sure you fill out the settings inside Theme Options -> Instagram Oauth for Instagram Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo esc_attr($this->get_field_id('Google')); ?>" name="<?php echo esc_attr($this->get_field_name('Google')); ?>" type="checkbox" <?php if ($instance['Google']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo esc_attr($this->get_field_id('Google')); ?>"><?php esc_html_e('Display Google+ Counter?', 'thevoux'); ?></label>
			  <small><?php esc_html_e('Please make sure you fill out the settings inside Theme Options -> Google+ Oauth for Google Counts', 'thevoux'); ?></small>
			</p>
			<p>
			  <input id="<?php echo esc_attr($this->get_field_id('Debug')); ?>" name="<?php echo esc_attr($this->get_field_name('Debug')); ?>" type="checkbox" <?php if ($instance['Debug']) { ?>checked="checked" <?php } ?> />
			  <label for="<?php echo esc_attr($this->get_field_id('Debug')); ?>"><?php esc_html_e('Debug Mode','thevoux'); ?></label>
			  <small><?php esc_html_e('Enable this to see what is returned from social network sites.','thevoux'); ?></small>
			</p>
    <?php
	}
}