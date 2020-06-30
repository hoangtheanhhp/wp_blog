<?php
/**
 * The template used for displaying single post video on single post.
 *
 * @package Heap
 * @since   Heap 1.0.0
 */

$video_embed = get_post_meta( get_the_ID(), '_heap_'.'video_embed', true );
if ( ! empty( $video_embed ) ) { ?>
	<div class="article__featured-image">
		<div class="featured-image">
			<div class="page-header-video">
				<div class="video-wrap">
					<?php echo stripslashes( htmlspecialchars_decode( do_shortcode( $video_embed ) ) ) ?>
				</div>
			</div>
		</div>
	</div><!-- .article__featured-image -->
<?php
} elseif ( has_post_thumbnail() ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium-size' );
	if (! empty( $image[0] ) ) : ?>
		<div class="article__featured-image">

			<?php
			$image_markup = '<img itemprop="url" src="' . esc_attr( $image[0] ) . '" alt="' . get_the_title() . '"/>';
			// Add responsive images attributes
			$image_markup = wp_image_add_srcset_and_sizes( $image_markup, wp_get_attachment_metadata( get_post_thumbnail_id() ), get_post_thumbnail_id() );
			echo $image_markup;
			?>

			<div class="article__featured-image-meta">
				<div class="flexbox">
					<div class="flexbox__item">
						<i class="icon  icon-play-circle-o"></i>
					</div>
				</div>
			</div>
		</div><!-- .article__featured-image -->
	<?php endif;
}
