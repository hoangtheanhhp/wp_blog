<?php
/**
 * The template used for displaying single post featured image on single post.
 *
 * @package Heap
 * @since   Heap 1.0.0
 */

if ( has_post_thumbnail() ) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium-size' );
	if ( ! empty( $image[0] ) ) : ?>
		<div class="article__featured-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			<?php
			$image_markup = '<img itemprop="url" src="' . esc_attr( $image[0] ) . '" alt="' . get_the_title() . '"/>';
			// Add responsive images attributes
			$image_markup = wp_image_add_srcset_and_sizes( $image_markup, wp_get_attachment_metadata( get_post_thumbnail_id() ), get_post_thumbnail_id() );
			echo $image_markup;

			// Add the schema.org attributes for width and height as we don't want the <img> to have them
			if ( ! empty( $image[1] ) && ! empty( $image[2] ) ) : ?>
			<meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>">
			<meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>">
			<?php endif; ?>
		</div>
	<?php endif;
endif;