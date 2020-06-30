<?php
/**
 * Require files that deal with various plugin integrations.
 *
 * @package Heap
 */

/**
 * Load PixCare compatibility file.
 */
require get_template_directory() . '/inc/integrations/pixcare.php';
require get_template_directory() . '/inc/integrations/pixcare_starter_content.php';


/**
 * Load WooCommerce compatibility file.
 * https://www.woothemes.com/woocommerce/
 */

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/integrations/woocommerce.php';
}

if ( class_exists( 'WpGradeShortcodes' ) ) {
	require get_template_directory() . '/inc/integrations/pixcodes.php';
}

/**
 * Load theme's configuration file (via Customify plugin)
 */
require get_template_directory() . '/inc/integrations/customify.php';
