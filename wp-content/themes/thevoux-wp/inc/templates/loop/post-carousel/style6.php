<article <?php post_class('post featured-style7'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1-2x'); ?></a>
	</figure>
	<?php do_action('thb_post_top', true, true); ?>
	<div class="post-title">
		<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
