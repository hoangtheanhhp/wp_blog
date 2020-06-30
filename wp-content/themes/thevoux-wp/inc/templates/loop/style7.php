<?php 
	remove_filter( 'excerpt_length', 'thb_supershort_excerpt_length' ); 
	add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); 
	$vars = $wp_query->query_vars;
	$thb_offset_style = array_key_exists('thb_offset_style', $vars) ? $vars['thb_offset_style'] : '';
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1-2x';	
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style7 '.$thb_offset_style); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thb_image_size); ?></a>
	</figure>
	<?php } ?>
	<div class="offset-title-container">
		<?php do_action('thb_post_top', true, true); ?>
		<header class="post-title entry-header">
			<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="post-content small">
			<?php if (!$thb_offset_style) { the_excerpt(); } ?>
			<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>