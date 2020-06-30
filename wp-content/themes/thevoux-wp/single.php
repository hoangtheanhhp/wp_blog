<?php get_header(); ?>
<?php
	$id = $wp_query->get_queried_object_id();

	$style = ot_get_option('article_style', 'style1');

	if (get_post_meta($id, 'article_style_override', true) === 'on') {
		$style = get_post_meta($id, 'post-style', true);
	}
	$infinite = ot_get_option('infinite_load', 'on');
?>
<div id="infinite-article" data-infinite="<?php echo esc_attr($infinite); ?>">
	<?php do_action('thb_page_content', ot_get_option('article_top_content')); ?>
	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
		<?php
			set_query_var( 'thb_ajax', false );
			get_template_part( 'inc/templates/single/'.$style );
		?>
		<?php } ?>
	<?php endwhile; else : endif; ?>
</div>
<?php get_footer(); ?>
