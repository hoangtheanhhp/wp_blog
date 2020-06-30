<?php
/**
 * Get Social Shares class
 *
 * @author  Bishoy A. <hi@bishoy.me>
 */

class PsscShareCount {
	/**
	 * URL to check it's shares
	 * @var string
	 */
	private $url;

	/**
	 * Timeout (Maximum time for CURL request)
	 * @var integer
	 */
	private $timeout;

	/**
	 * Facebook Engagements
	 * @var string
	 */
	private $facebook_engagements;

	/**
	 * The constructor
	 * @param string  $url
	 * @param integer $timeout
	 */
	public function __construct( $url, $timeout = 10 ) {
		$this->url     = rawurlencode( $url );
		$this->raw_url = $url;
		$this->timeout = $timeout;
		$this->facebook_engagements = ot_get_option('facebook_engagements', 'on');
	}

	/**
	 * Get Twitter Tweets
	 * @return integer Tweets count
	 */
	public function pssc_twitter() {
	  if ( ot_get_option('twitter_bar_consumerkey') == 't0w3HYVODhFG0m34IFXg' && $_SERVER['HTTP_HOST'] !== 'thevoux.fuelthemes.net') {
	    return 0;
	  }
		$settings = array(
	    'oauth_access_token' => ot_get_option('twitter_bar_accesstoken'),
	    'oauth_access_token_secret' => ot_get_option('twitter_bar_accesstokensecret'),
	    'consumer_key' => ot_get_option('twitter_bar_consumerkey'),
	    'consumer_secret' => ot_get_option('twitter_bar_consumersecret')
		);

		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$getfield = '?q='.$this->url.'&result_type=recent';
		$twitter = new thb_TwitterAPIExchange($settings);
		$twitter_data = json_decode($twitter->set_get_field($getfield)
		             ->build_oauth($url, 'GET')
		             ->process_request());
		if (isset($twitter_data->errors)) {
			$count = 0;
		} else {
			$count = max(sizeof($twitter_data->statuses), 0);
		}
		return $count;
	}

	/**
	 * Get Linked In Shares
	 * @return integer
	 */
	public function pssc_linkedin() {
		$return_data = wp_remote_get( "http://www.linkedin.com/countserv/count/share?url=$this->url&format=json", array( 'timeout' => $this->timeout) );
		if ( is_wp_error( $return_data ) ) {
			error_log($return_data->get_error_message());
			return 0;
		}
		$return_data = wp_remote_retrieve_body( $return_data );
		$json = json_decode( $return_data, true );
		return isset( $json['count'] ) ? intval( $json['count'] ) : 0;
	}

	/**
	 * Get Facebook Shares
	 * @return integer
	 */
	public function pssc_facebook() {
	  if ( ot_get_option('facebook_app_id') == '416706622025229' && $_SERVER['HTTP_HOST'] !== 'thevoux.fuelthemes.net') {
	    return 0;
	  }
		$thb_access_token = ot_get_option('facebook_app_id').'|'.ot_get_option('facebook_app_secret');
		$json_url = 'https://graph.facebook.com/v2.9/?id='.$this->url.'&access_token='.$thb_access_token.'&fields=engagement';

		$json = wp_remote_get($json_url, array( 'timeout' => $this->timeout));
		// Check for error
		if ( is_wp_error( $json ) ) {
			error_log($json->get_error_message());
			return;
		}
		$data = wp_remote_retrieve_body( $json );

		$json = json_decode($data);

		if ($this->facebook_engagements === 'on') {
			return (
				( isset( $json->engagement->share_count ) ? intval( $json->engagement->share_count ) : 0 ) +
				( isset( $json->engagement->reaction_count ) ? intval( $json->engagement->reaction_count ) : 0 ) +
				( isset( $json->engagement->comment_count ) ? intval( $json->engagement->comment_count ) : 0 )
			);
		} else {
			return isset( $json->engagement->share_count ) ? intval( $json->engagement->share_count ) : 0;
		}
	}

	/**
	 * Get Goolge+ ones
	 * @return integer
	 */
	public function pssc_gplus() {

		$args = array(
        'method' => 'POST',
        'timeout' => $this->timeout,
        'headers' => array(
            // setup content type to JSON
            'Content-Type' => 'application/json'
        ),
        // setup POST options to Google API
        'body' => json_encode(array(
            'method' => 'pos.plusones.get',
            'id' => 'p',
            'method' => 'pos.plusones.get',
            'jsonrpc' => '2.0',
            'key' => 'p',
            'apiVersion' => 'v1',
            'params' => array(
                'nolog'=>true,
                'id'=> rawurldecode( $this->url ),
                'source'=>'widget',
                'userId'=>'@viewer',
                'groupId'=>'@self'
            )
         )),
         // disable checking SSL sertificates
        'sslverify'=>false
    );
    $return_data = wp_remote_post("https://clients6.google.com/rpc", $args);

    if ( is_wp_error( $return_data ) ) {
    	error_log($return_data->get_error_message());
    	return 0;
    }
    $return_data = wp_remote_retrieve_body( $return_data );
		$json = json_decode( $return_data, true );
		return isset( $json[0]['result']['metadata']['globalCounts']['count'] ) ? intval( $json[0]['result']['metadata']['globalCounts']['count'] ) : 0;
	}

	/**
	 * Get pinterest Pins
	 * @return integer
	 */
	public function pssc_pinterest() {
		$return_data = wp_remote_get( 'https://api.pinterest.com/v1/urls/count.json?url='.$this->url, array( 'timeout' => 50) );

		if ( is_wp_error( $return_data ) ) {
			error_log($return_data->get_error_message());
			return 0;
		}
		$return_data = wp_remote_retrieve_body( $return_data );
		$json_string = preg_replace("/[^(]*\((.*)\)/", "$1", $return_data );
		$json = json_decode( $json_string, true );

		return isset( $json['count'] ) ? intval( $json['count'] ) : 0;
	}

	/**
	 * Get all counts
	 * @return integer total count
	 */
	public function pssc_all() {
		$count = 0;

		$tw = $this->pssc_twitter();
		$fb = $this->pssc_facebook();
		$gp = $this->pssc_gplus();
		$pi = $this->pssc_pinterest();
		$li = $this->pssc_linkedin();
		$count = $tw + $fb + $gp + $pi + $li;

		return $count;
	}
}