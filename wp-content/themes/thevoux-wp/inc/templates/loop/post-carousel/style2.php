<article <?php post_class('post featured-style5'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1-2x'); ?></a>
	</figure>
	<div class="post-title">
		<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
	</div>
	<div class="post-excerpt">
		<?php get_template_part( 'inc/templates/postbits/post-just-shares' ); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>