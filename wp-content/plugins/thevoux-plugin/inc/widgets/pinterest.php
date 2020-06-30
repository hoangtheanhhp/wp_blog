<?php

// thb Pinterest Widget
include_once(ABSPATH . WPINC . '/feed.php');

// Defaults
define('PINTEREST_PINBOARD_DEFAULT_USERNAME', 'pinterest');
define('PINTEREST_PINBOARD_DEFAULT_count', 3);

// Shortcode definition
define('PINTEREST_PINBOARD_SHORTCODE', 'pinterest_pinboard');

/**
 * Pinterest pinboard class to fetch the pinterest feed
 * and render the HTML pinboard.
 */
class Pinterest_Pinboard {

	// Pinterest url
	var $pinterest_feed_url = 'https://pinterest.com/%s/feed.rss';

	// RSS cache lifetime in seconds
	var $cache_lifetime = 900;

	var $start_time;

	function __construct() {
	  $this->start_time = microtime(true);
	}

	// Render the pinboard and output
	function render($username, $count) {
	  $nr_pins = $count;
	  $pins = $this->get_pins($username, $nr_pins);

	  echo '<div class="photocontainer">';
	  if (is_null($pins)) {
	      echo("Unable to load Pinterest pins for '$username'\n");
	  } else {
      foreach ($pins as $pin) {
        $title = $pin['title'];
        $url = $pin['url'];
        $image = $pin['image'];
        ?>
        <div class="overlay-effect">
        	<figure style="background-image:url(<?php echo esc_url($image); ?>)">
        		<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" target="_blank"></a>
        	</figure>
        </div>
        <?php
      }
	  }
	  ?>
	  </div>
	  <div class="pin_link">
      <a class="pin_logo" href="http://pinterest.com/<?php echo esc_attr($username) ?>/" target="_blank">
        <img src="//passets-cdn.pinterest.com/images/small-p-button.png" width="16" height="16" alt="<?php esc_attr_e('Follow Me on Pinterest', 'thevoux'); ?>" />
        <span class="pin_text"><?php echo esc_attr($username) ?></span>
      </a>
	  </div>
	  <?php
	}
	/**
	* Retrieve RSS feed for username, and parse the data needed from it.
	* Returns null on error, otherwise a hash of pins.
	*/
	function get_pins($username, $nrpins) {

	  // Set caching.
	  add_filter('wp_feed_cache_transient_lifetime', create_function('$a', 'return '. $this->cache_lifetime .';'));

	  // Get the RSS feed.
	  $url = sprintf($this->pinterest_feed_url, $username);
	  $rss = fetch_feed($url);
	  if (is_wp_error($rss)) {
	      return null;
	  }

	  $maxitems = $rss->get_item_quantity($nrpins);
	  $rss_items = $rss->get_items(0, $maxitems);

	  $pins;
	  if (is_null($rss_items)) {
	      $pins = null;
	  } else {

	      // Build patterns to search/replace in the image urls.
	      // Pattern to replace for the images.
	      $search = array('_b.jpg');
	      $replace = array('_t.jpg');
	      // Make urls protocol relative
	      array_push($search, 'https://');
	      array_push($replace, '//');

	      $pins = array();
	      foreach ($rss_items as $item) {
	          $title = $item->get_title();
	          $description = $item->get_description();
	          $url = $item->get_permalink();
	          if (preg_match_all('/<img src="([^"]*)".*>/i', $description, $matches)) {
	              $image = str_replace($search, $replace, $matches[1][0]);
	          }
	          array_push($pins, array(
	              'title' => $title,
	              'image' => $image,
	              'url' => $url
	          ));
	      }
	  }
	  return $pins;
	}

}

class Pinterest_Pinboard_Widget extends WP_Widget {

    /**
     * Widget settings.
     */
    protected $widget = array(
      // Default title for the widget in the sidebar.
      'title' => 'Recent pins',

      // Default widget settings.
      'username' => PINTEREST_PINBOARD_DEFAULT_USERNAME,
      'count' => PINTEREST_PINBOARD_DEFAULT_count,

      // The widget description used in the admin area.
      'description' => 'Adds a Pinterest Pinboard widget to your sidebar'
    );

    function __construct(){

      	$widget_ops = array(
      		'classname'   => 'pinterest',
      		'description' => esc_html__('Adds a Pinterest Pinboard widget to your sidebar','thevoux')
      	);

      	parent::__construct(
      		'pinterest',
      		esc_html__( 'Fuel Themes - Pinterest' , 'thevoux' ),
      		$widget_ops
      	);

      	$this->defaults = array();
    }

    function form($instance) {
	    	$defaults = $this->defaults;
	    	$instance = wp_parse_args( (array) $instance, $defaults );
        // load current values or set to default.
        $title = array_key_exists('title', $instance) ? esc_attr($instance['title']) : $this->widget['title'];
        $username = array_key_exists('username', $instance) ? esc_attr($instance['username']) : $this->widget['username'];
        $count = array_key_exists('count', $instance) ? esc_attr($instance['count']) : $this->widget['count'];
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title:', 'thevoux'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e('Username:', 'thevoux'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Number of Images:', 'thevoux'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" size="3" />
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = strip_tags($new_instance['username']);
        $instance['count'] = strip_tags($new_instance['count']);
        $instance['new_window'] = isset($new_instance['new_window']) ? 1 : 0;
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);

        echo $before_widget;
        echo ($title ? $before_title . $title . $after_title : '');

        // Render the pinboard from the widget settings.
        $username = $instance['username'];
        $count = $instance['count'];
        $new_window = $instance['new_window'];

        $pinboard = new Pinterest_Pinboard();
        $pinboard->render($username, $count, $new_window);

        echo $after_widget;
    }

}