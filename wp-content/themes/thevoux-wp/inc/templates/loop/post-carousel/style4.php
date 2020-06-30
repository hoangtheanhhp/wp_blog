<article <?php post_class('post featured-style7'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-vertical-2x'); ?></a>
	</figure>
	<?php do_action('thb_post_top', true, false); ?>
	<div class="post-title">
		<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		<?php do_action('thb_post_author'); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>