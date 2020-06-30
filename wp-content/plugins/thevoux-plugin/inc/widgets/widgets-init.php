<?php

function thb_register_widgets() {
 $thb_widgets = array(
   'about'           => 'widget_thbabout',
   'category-slider'     => 'widget_categoryslider',
   'discussed-posts-images'     => 'widget_discussedimages',
   'discussed-shared-posts-images'     => 'widget_discussedsharedimages',
   'featured-video'     => 'widget_thbfeaturedvideo',
   'flickr'     => 'widget_thbflickr',
   'instagram'     => 'widget_thbinstagram',
   'latest-posts-images'     => 'widget_latestimages',
   'latest-posts-list'     => 'widget_latestlist',
   'pinterest'     => 'Pinterest_Pinboard_Widget',
   'shared-posts-images'     => 'widget_sharedimages',
   'social-counters'     => 'widget_socialcounter',
   'social-icons'     => 'widget_socialicons',
   'subscribe'     => 'thb_subscribe_widget'
 );
 foreach ( $thb_widgets as $key => $value ) {
   require_once( thevoux_plugin()->get_plugin_path() . 'inc/widgets/' . sanitize_key( $key ) . '.php');
   register_widget( $value );
 }
}

add_action( 'widgets_init', 'thb_register_widgets' );