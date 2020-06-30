<?php
$video_embed = get_post_meta( get_the_ID(), '_heap_'.'video_embed', true );

if ( ! empty( $video_embed ) ) { ?>

	<div class="article__featured-image">
		<?php echo stripslashes( htmlspecialchars_decode( do_shortcode( $video_embed ) ) ) ?>
	</div>

<?php } else { ?>

	<div class="article__featured-image">
		<?php echo heap_video_attachment(); ?>
	</div>

<?php } ?>
