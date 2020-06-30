<?php
#-----------------------------------------------------------------#
# Register TinyMCE Shortcode Button
#-----------------------------------------------------------------#
function thb_tiny() {

	//make sure the user has correct permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}

	//only add to visual mode
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_js_plugin' );
		add_filter( 'mce_buttons', 'register_thb_tinymce_button' );
	}

}

add_action('init', 'thb_tiny');

function add_js_plugin( $plugin_array ) {
   $plugin_array['thb_buttons'] = Thb_Theme_Admin::$thb_theme_directory_uri.'inc/framework/tinymce/thb.tinymce.min.js';
   return $plugin_array;
}

#-----------------------------------------------------------------
# Create Button
#-----------------------------------------------------------------
function register_thb_tinymce_button( $buttons ) {
	array_push( $buttons, "scgenerator" );
	return $buttons;
}
