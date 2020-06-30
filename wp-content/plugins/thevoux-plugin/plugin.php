<?php
/**
 * Plugin Name: The Voux - Required Plugin
 * Description: This plugin adds necessary functionality to the Voux theme.
 * Version: 1.0.2
 * Author: fuelthemes
 * Author URI: http://themeforest.net/user/fuelthemes
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
class TheVoux_plugin {
	private static $instance = null;
	private $plugin_path;
	private $plugin_url;
	private $text_domain = '';

	/**
	 * Creates or returns an instance of this class.
	 */
	public static function get_instance() {
		global $TheVoux_plugin;
		// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		$TheVoux_plugin = self::$instance;
		return $TheVoux_plugin;
	}

	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 */
	private function __construct() {
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );


		$this->run_plugin();
	}

	public function get_plugin_url() {
		return $this->plugin_url;
	}

	public function get_plugin_path() {
		return $this->plugin_path;
	}

	/**
	* Place code for your plugin's functionality here.
	*/
	private function run_plugin() {
		$theme = wp_get_theme();
		if ('thevoux-wp' !== $theme->template) { return; }
		// VC Templates
		$shortcodes = $this->plugin_path. 'inc/vc_templates/';
		$files = glob($shortcodes.'thb_?*.php');
		foreach ($files as $filename) {
			require_once $this->plugin_path . 'inc/vc_templates/'.basename($filename);
		}
		// Widgets
		require_once $this->plugin_path . 'inc/widgets/widgets-init.php';
	}
}
function thevoux_plugin() {
	global $TheVoux_plugin;
	return $TheVoux_plugin;
}
function thb_thevoux_plugin() {
	TheVoux_plugin::get_instance();
}
add_action( 'after_setup_theme', 'thb_thevoux_plugin' );