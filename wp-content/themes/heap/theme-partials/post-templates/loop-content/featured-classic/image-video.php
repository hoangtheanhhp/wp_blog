<?php
if ( has_post_thumbnail() ):
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-square-small' );
	if ( ! empty( $image[0] ) ) : ?>
		<div class="article__featured-image">
			<a href="<?php the_permalink(); ?>"><?php
				$image_markup = '<img itemprop="url" src="' . esc_attr( $image[0] ) . '" alt="' . get_the_title() . '"/>';
				// Add responsive images attributes
				$image_markup = wp_image_add_srcset_and_sizes( $image_markup, wp_get_attachment_metadata( get_post_thumbnail_id() ), get_post_thumbnail_id() );
				echo $image_markup;
				?></a>
			<div class="article__featured-image-meta">
				<div class="flexbox">
					<div class="flexbox__item">
						<i class="icon  icon-play-circle-o"></i>
					</div>
				</div>
			</div>
		</div>
	<?php endif;
endif;