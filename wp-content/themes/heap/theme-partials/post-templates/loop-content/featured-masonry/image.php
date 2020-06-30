<?php
if ( has_post_thumbnail() ) {
	$image              = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium-size' );
	$image_ratio        = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
	if ( isset( $image[1] ) && isset( $image[2] ) && $image[1] > 0 ) {
		$image_ratio = $image[2] * 100 / $image[1];
	}

	if ( ! empty( $image[0] ) ) { ?>
		<div class="article__featured-image" style="padding-top: <?php echo $image_ratio; ?>%">
			<a href="<?php the_permalink(); ?>">
				<?php
				$image_markup = '<img itemprop="url" src="' . esc_attr( $image[0] ) . '" alt="' . get_the_title() . '"/>';
				// Add responsive images attributes
				$image_markup = wp_image_add_srcset_and_sizes( $image_markup, wp_get_attachment_metadata( get_post_thumbnail_id() ), get_post_thumbnail_id() );
				echo $image_markup;
				?>

				<div class="article__featured-image-meta">
					<div class="flexbox">
						<div class="flexbox__item">
							<hr class="separator"/>
							<span class="read-more"><?php esc_html_e( 'Read more', 'heap' ) ?></span>
							<hr class="separator"/>
						</div>
					</div>
				</div>
			</a>
		</div>
	<?php }
}