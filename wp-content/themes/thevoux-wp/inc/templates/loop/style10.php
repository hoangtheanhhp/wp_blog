<?php
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id, 'full');
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style11 light-title'); ?>>
	<div class="parallax_bg" 
				data-center-bottom="transform: translate3d(0px, -5%, 0px);"
				data-center-top="transform: translate3d(0px, 5%, 0px);">
		<?php the_post_thumbnail('thevoux-masonry-2x'); ?>
	</div>
	<?php do_action('thb_post_top', true, true); ?>
	<header class="post-title">
		<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<div class="post-content">
		<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>