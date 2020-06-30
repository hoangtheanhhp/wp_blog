<article <?php post_class('post post-carousel-style10'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2'); ?></a>
	</figure>
	<div class="post-title text-center">
		<h6 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>