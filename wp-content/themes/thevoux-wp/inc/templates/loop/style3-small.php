<?php 
	$vars = $wp_query->query_vars;
	$thb_offset_style = array_key_exists('thb_offset_style', $vars) ? $vars['thb_offset_style'] : '';
	$thb_excerpt = array_key_exists('thb_excerpt', $vars) ? $vars['thb_excerpt'] : true;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : ($thb_offset_style ? 'thevoux-style3' : 'thevoux-style3small-2x');	
	add_filter( 'excerpt_length', 'thb_widget_excerpt_length' ); 
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style3-small '.$thb_offset_style); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thb_image_size); ?></a>
	</figure>
	<?php } ?>
	<?php do_action('thb_post_top', false, true); ?>
	<header class="post-title entry-header offset-title-container">
		<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
	</header>
	<?php if ($thb_excerpt) { ?>
	<div class="post-content small">
		<?php the_excerpt(); ?>
	</div>
	<?php } ?>
	<?php do_action('thb_PostMeta'); ?>
</article>