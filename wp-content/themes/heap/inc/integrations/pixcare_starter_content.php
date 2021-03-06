<?php
/**
 * PixCare Starter Content Compatibility File.
 * Here we add all the actions and filters responsable for the import action.
 */

/**
 * Filter the import action while getting the `heap_options` option
 *
 * @param $option
 *
 * @return mixed
 */
function heap_filter_post_option_heap_options( $option ) {
	// get the imported data
	$pixcare_options = get_option( 'pixcare_options' );
	// this holds the ids of posts, pages, medias and everything was already imported
	$imported_options = $pixcare_options['imported_starter_content'];

	// We need to replace the logo from the demo with the imported attachment id
	if ( isset( $imported_options['media']['ignored'][ $option['main_logo'] ] ) ) {
		$option['main_logo'] = $imported_options['media']['ignored'][ $option['main_logo'] ];
	}

	// on demo this is an option, oldy stuff
	// but on the new installations will need this as a theme mod
	set_theme_mod('heap_options', $option );

	return $option;
}
add_filter( 'pixcare_sce_import_post_option_heap_options', 'heap_filter_post_option_heap_options' );
