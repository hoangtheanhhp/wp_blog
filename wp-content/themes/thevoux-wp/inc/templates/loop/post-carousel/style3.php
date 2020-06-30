<article <?php post_class('post featured-style5'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1-2x'); ?></a>
	</figure>
	<div class="post-title text-center">
		<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>