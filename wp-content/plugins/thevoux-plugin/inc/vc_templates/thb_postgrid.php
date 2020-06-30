<?php function thb_postgrid( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postgrid', $atts );
  extract( $atts );
  global $wp_query;
  if ( get_query_var('paged') ) {
  	$paged = get_query_var('paged');
  } else if ( get_query_var('page') ) {
  	$paged = get_query_var('page');
  } else {
  	$paged = 1;
  }

  $featured_index = empty($featured_index) ? array() : explode(',',$featured_index);
	$source .= '|paged:'.$paged;
	$source .= '|offset:'.$offset;
	$source_data = VcLoopSettings::parseData( $source );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$posts = $query_builder->build();
	$posts = $posts[1];

	$temp_query = $wp_query;
	$wp_query = $posts;
 	ob_start();

  $rand = mt_rand(10, 99);

 	$classes[] = 'posts';
 	$classes[] = 'post-grid-'.$style;
 	$classes[] = $style.'-posts';
 	$classes[] = $pagination == "true" ? 'ajaxify-pagination' : false;
  $classes[] = in_array($pagination, array('style2', 'style3')) ? 'pagination-'.$pagination : false;
  $classes[] = in_array($style, array('style1', 'style4', 'style11')) ? 'row columns-'.$columns : false;
  $classes[] = in_array($style, array('style2','style2-alt', 'style5', 'style7')) ? 'border' : false;
  $classes[] = $style == 'style3' ? 'border-vertical row no-padding full-width-row': false;
  $classes[] = in_array($style, array('style8', 'style10')) ? 'row' : false;

  $col = thb_getColumns($columns);
	if ( $posts->have_posts() ) { ?>
		<?php if ($add_title === 'true') { ?>
			<div class="category_title <?php echo esc_attr($title_style); ?>">
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
		<?php } ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-loadmore="#loadmore-<?php echo esc_attr($rand); ?>" data-rand="<?php echo esc_attr($rand); ?>">
    <?php $i = 1; while ( $posts->have_posts() ) : $posts->the_post(); ?>
  		<?php if ($style == 'style1') { ?>
        <div class="small-12 <?php echo esc_attr($col); ?> columns">
          <?php
            set_query_var( 'disable_excerpts', $disable_excerpts );
            set_query_var( 'disable_postmeta', $disable_postmeta );
            get_template_part( 'inc/templates/loop/style6' );
          ?>
        </div>
  		<?php } else if ($style == 'style4') { // Style 1 - Version 2 ?>
        <div class="small-12 <?php echo esc_attr($col); ?> columns">
          <?php
            get_template_part( 'inc/templates/loop/style7' );
          ?>
        </div>
  		<?php } else if ($style == 'style11') { // Style 1 - Version 3 ?>
        <div class="small-12 <?php echo esc_attr($col); ?> columns">
          <?php
            get_template_part( 'inc/templates/loop/style14' );
          ?>
        </div>
  		<?php } else if ($style == 'style2') { ?>
        <?php if (in_array($i, $featured_index )) { ?>
          <?php get_template_part( 'inc/templates/loop/style7' ); ?>
        <?php } else { ?>
          <?php get_template_part( 'inc/templates/loop/style1' ); ?>
        <?php } ?>
  		<?php } else if ($style == 'style2-alt') { ?>
        <?php if (in_array($i, $featured_index )) { ?>
          <?php
            set_query_var( 'thb_offset_style', 'offset-title' );
            get_template_part( 'inc/templates/loop/style7' );
            set_query_var( 'thb_offset_style', false );
          ?>
        <?php } else { ?>
          <?php get_template_part( 'inc/templates/loop/style1' ); ?>
        <?php } ?>
  		<?php } else if ($style == 'style2-bg') { ?>
        <?php if (in_array($i, $featured_index )) { ?>
          <?php
            set_query_var( 'thb_offset_style', false );
            get_template_part( 'inc/templates/loop/style7' );
          ?>
        <?php } else { ?>
          <?php
            set_query_var( 'thb_sharestyle', 'post-links-style2' );
            set_query_var( 'thb_noexcerpt', true );
            set_query_var( 'thb_author', true );
            set_query_var( 'thb_class', 'style1-bg' );
            set_query_var( 'thb_image_size', 'thevoux-style2' );
            get_template_part( 'inc/templates/loop/style1' );
          ?>
        <?php } ?>
  		<?php } else if ($style == 'style3') { ?>
        <div class="small-12 large-6 columns <?php if ($i % 2 == 0) { ?>even<?php } ?>">
          <?php get_template_part( 'inc/templates/loop/style2' ); ?>
        </div>
  		<?php } else if ($style == 'style5') { ?>
  			<?php get_template_part( 'inc/templates/loop/style9' ); ?>
  		<?php } else if ($style == 'style6') { ?>
        <?php
          set_query_var( 'thb_image_size', 'thevoux-style1-2x' );
          get_template_part( 'inc/templates/loop/style7' );
        ?>
  		<?php } else if ($style == 'style7') { ?>
        <?php
          set_query_var( 'thb_image_size', 'thevoux-style1-2x' );
          get_template_part( 'inc/templates/loop/style12' );
        ?>
  		<?php } else if ($style == 'style8') { ?>
        <div class="small-12 <?php echo esc_attr($col); ?> columns">
          <?php get_template_part( 'inc/templates/loop/style8' ); ?>
        </div>
  		<?php } else if ($style == 'style9') { ?>
        <?php set_query_var( 'thb_i', $i ); ?>
        <?php get_template_part( 'inc/templates/loop/style13' ); ?>
  		<?php } else if ($style == 'style10') { ?>
        <div class="small-12 <?php echo esc_attr($col); ?> columns">
          <?php get_template_part( 'inc/templates/loop/post-carousel/style11' ); ?>
        </div>
      <?php } else if ($style == 'style12') { ?>
        <?php set_query_var( 'thb_i', $i ); ?>
        <?php get_template_part( 'inc/templates/loop/style15' ); ?>
  		<?php } ?>
    <?php $i++; endwhile; // end of the loop. ?>
    <?php
      if ($pagination == 'true') {
        the_posts_pagination(array(
          'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
          'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
          'mid_size'		=> 2
        ));
      } else if ($pagination == 'style2' || $pagination == 'style3') {
     		wp_localize_script( 'thb-app', 'thb_postajax_'.$rand, array(
          'style' => $style,
          'loop' => $source,
          'count' => $source_data['size'],
          'columns' => $columns,
          'featured_index' => $featured_index
        ) );
     	}
    ?>
    <?php if ($pagination == 'style2') { ?>
      <div class="text-center masonry_loader">
        <a class="masonry_btn thb-text-button" id="loadmore-<?php echo esc_attr($rand); ?>"><?php esc_html_e( 'Load More', 'thevoux' ); ?></a>
      </div>
    <?php } ?>
    </div>
	<?php }
	set_query_var( 'thb_style', false );
	set_query_var( 'thb_image_size', false );
	set_query_var( 'thb_class', false );

	$out = ob_get_clean();
	$wp_query = $temp_query;
	wp_reset_query();
	wp_reset_postdata();

  return $out;
}
thb_add_short('thb_postgrid', 'thb_postgrid');
