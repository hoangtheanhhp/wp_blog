<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {
	global $post;
	// Enqueue
	wp_enqueue_style("thb-fa", 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, esc_attr(Thb_Theme_Admin::$thb_theme_version));
	wp_enqueue_style("thb-app", Thb_Theme_Admin::$thb_theme_directory_uri .'assets/css/app.css', null, esc_attr(Thb_Theme_Admin::$thb_theme_version));

	if ( $_SERVER['HTTP_HOST'] !== 'thevoux.fuelthemes.net') {
		wp_enqueue_style('thb-style', get_stylesheet_uri(), null, null);
	}
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont() );
	wp_add_inline_style( 'thb-app', thb_selection() );


	if ($post) {
		if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_styles' )) {
			wpcf7_enqueue_styles();
		}
	}
}

add_action('wp_enqueue_scripts', 'thb_main_styles');

// Main Scripts
function thb_register_js() {
	if (!is_admin()) {
		global $post;
		$i = 0;
		$self_hosted_fonts = ot_get_option('self_hosted_fonts');
		$thb_api_key = ot_get_option('map_api_key');

		// Register
		wp_register_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.$thb_api_key.'', false, null, false);
		wp_register_script('thb-vendor', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/js/vendor.min.js', array('jquery'), esc_attr(Thb_Theme_Admin::$thb_theme_version), TRUE);
		wp_register_script('thb-app', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/js/app.min.js', array('jquery', 'thb-vendor'), esc_attr(Thb_Theme_Admin::$thb_theme_version), TRUE);

		// Enqueue
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}

		if ($self_hosted_fonts) {
			foreach ($self_hosted_fonts as $font) {
				$i++;
				wp_enqueue_style("thb-self-hosted-".$i, $font['font_url'], null, esc_attr(Thb_Theme_Admin::$thb_theme_version));
			}
		}

		if ($post) {
			if ( has_shortcode($post->post_content, 'thb_contactmap') ) {
				wp_enqueue_script('gmapdep');
			}
			if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_scripts' )) {
				wpcf7_enqueue_scripts();
			}
		}
		// Typekit
		if ($typekit_id = ot_get_option('typekit_id')) {
			wp_enqueue_script('thb-typekit', 'https://use.typekit.net/'.$typekit_id.'.js', array(), NULL, FALSE );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}

		wp_enqueue_script('thb-vendor');
		wp_enqueue_script('underscore');
		wp_enqueue_script('thb-app');
		wp_localize_script( 'thb-app', 'themeajax', array(
			'themeurl' => get_template_directory_uri(),
			'url' => admin_url( 'admin-ajax.php' ),
			'l10n' => array (
				'loading' => esc_html__("Loading ...", 'thevoux'),
				'nomore' => esc_html__("No More Posts", 'thevoux'),
				'close' => esc_html__("Close", 'thevoux'),
				'prev' => esc_html__("Prev", 'thevoux'),
				'next' => esc_html__("Next", 'thevoux')
			),
			'svg' => array(
				'prev_arrow' => thb_load_template_part('assets/svg/arrow_prev.svg'),
				'next_arrow' => thb_load_template_part('assets/svg/arrow_next.svg'),
				'close_arrow' => thb_load_template_part('assets/svg/arrows_remove.svg')
			),
			'settings' => array (
				'infinite_count' => ot_get_option('infinite_count'),
				'current_url' => get_permalink(),
				'page_transition' => ot_get_option('page_transition', 'on'),
				'page_transition_style' => ot_get_option('page_transition_style', 'thb-fade'),
				'page_transition_in_speed' => ot_get_option('page_transition_in_speed', 500),
				'page_transition_out_speed' => ot_get_option('page_transition_out_speed', 250),
				'header_submenu_style' => ot_get_option('header_submenu_style', 'style1'),
				'thb_custom_video_player' => ot_get_option('thb_custom_video_player', 'on'),
				'viai_publisher_id' => ot_get_option('viai_publisher_id', '431861828953521')
			)
		) );
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
