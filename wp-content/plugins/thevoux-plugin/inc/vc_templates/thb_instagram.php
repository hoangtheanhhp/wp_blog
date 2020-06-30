<?php function thb_instagram( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_instagram', $atts );
   extract( $atts );
    
	switch($columns) {
		case 2:
			$col = 'small-6 medium-6';
			break;
		case 3:
			$col = 'small-12 medium-4';
			break;
		case 4:
			$col = 'small-6 medium-6 large-3';
			break;
		case 5:
			$col = 'small-12 thb-five';
			break;
		case 6:
			$col = 'small-6 medium-4 large-2';
			break;
	  }
 	$out ='';
 	$nopadding = $column_padding ? 'no-padding ' : '';
 	$lowpadding = $low_padding ? 'low-padding ' : ''; 
	ob_start();
	
	$instagram = thb_getInstagramPhotos($number);
	
	$classes[] = 'row';
	$classes[] = $nopadding;
	$classes[] = $lowpadding;
	$classes[] = 'instagram-row';
	$classes[] = $style === 'style2' ? 'thb-freescroll' : false;
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php foreach ($instagram as $item) { ?>
			<div class="<?php echo esc_attr($col); ?> columns">
				<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
				<?php if ($link == 'true') { ?>
					<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
				<?php } ?>
				<span><?php get_template_part('assets/svg/like.svg'); ?><em><?php echo esc_attr($item['likes']); ?></em> <?php get_template_part('assets/svg/comment.svg'); ?><em><?php echo esc_attr($item['comments']); ?></em></span>
				</figure>
				<?php if ($style === 'style2') { ?>
				<figcaption><?php echo esc_attr($item['caption']); ?></figcaption>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php
	
	$out = ob_get_clean();
	   
	return $out;
}
thb_add_short('thb_instagram', 'thb_instagram');