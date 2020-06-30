<div <?php post_class('post listing'); ?>>
	<?php if (has_post_thumbnail()) { ?> 
	<a class="figure" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail(); ?>
	</a>
	<?php } ?>
	<div class="listing_content">
		<header class="post-title entry-header">
			<?php the_title('<h6 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h6>'); ?>
		</header>
		<?php do_action('thb_post_top', false, true); ?>
	</div>
</div>