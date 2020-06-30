<?php 
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' ); 
?>
<li itemscope itemtype="http://schema.org/Article" <?php post_class('post listing with-excerpt'); ?>>
	<a class="figure" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail('thumbnail'); ?>
	</a>
	<div class="listing_content">
		<header class="post-title entry-header">
			<?php the_title('<h5 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h5>'); ?>
		</header>
		<?php the_excerpt(); ?>
		<?php do_action('thb_PostMeta'); ?>
	</div>
</li>