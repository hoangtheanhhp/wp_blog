<?php
  if ( !thb_wc_supported() ) {
    return;
  }
  $post_shopthelook = get_post_meta(get_the_ID(), 'post_shopthelook', true);

  if ( !$post_shopthelook || $post_shopthelook == '' ) {
    return;
  }
  $args = array(
		'post_type' => 'product',
		'post__in' => $post_shopthelook
		);
	$shoptheloop = new WP_Query( $args );

?>
<?php if ( $shoptheloop->have_posts() ) { ?>
<aside class="thb-shop-the-look">
  <h5><?php esc_html_e('Shop The Look', 'thevoux'); ?></h5>
  <div class="slick row products dark-pagination" data-columns="3" data-pagination="true" data-infinite="false">
    <?php while ( $shoptheloop->have_posts() ) : $shoptheloop->the_post(); ?>
      <?php wc_get_template_part( 'content', 'product' ); ?>
    <?php endwhile; ?>
  </div>
</aside>
<?php wp_reset_postdata(); } ?>
