<?php
$audio_embed = get_post_meta( get_the_ID(), '_heap_'.'audio_embed', true );

if( ! empty( $audio_embed ) ) { ?>

	<div class="article__featured-image">
		<?php echo stripslashes( htmlspecialchars_decode( do_shortcode( $audio_embed ) ) ) ?>
	</div>

<?php } else { ?>

	<div class="article__featured-image">
		<?php echo heap_audio_attachment(); ?>
	</div>

<?php } ?>