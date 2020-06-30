<?php
	$vars = $wp_query->query_vars;
	$thb_columns = array_key_exists('thb_columns', $vars) ? $vars['thb_columns'] : false;
	$format = get_post_format();
?>
<div class="small-12 medium-6 <?php echo esc_attr($thb_columns); ?> columns">
	<?php if ($format === 'image') { ?>
		<?php get_template_part('inc/templates/loop/style10'); ?>
	<?php } else { ?>
		<article <?php post_class('post style-masonry style-masonry-2'); ?> itemscope itemtype="http://schema.org/Article">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<?php do_action('thb_post_icon'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-masonry-2x'); ?></a>
			</figure>
			<?php } ?>
			<?php do_action('thb_post_top', true, true); ?>
			<header class="post-title">
				<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="post-content">
				<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
			</div>
			<?php do_action('thb_PostMeta'); ?>
		</article>
	<?php } ?>
</div>
