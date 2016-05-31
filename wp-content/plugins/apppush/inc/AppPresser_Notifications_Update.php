<?php
/**
 * Updates or creates a new post with notifications post meta.
 * @since  1.0.0
 */
class AppPresser_Notifications_Update {

	/**
	 * Pushwoosh API url
	 * @var string
	 */
	public $api_url = 'https://cp.pushwoosh.com/json/1.3/';
	private static $nonce_name = 'appnotifications_inner_custom_box_nonce';
	private static $nonce_action = 'appnotifications_inner_custom_box';
	private static $send_meta_key = 'send_push_notification';

	/**
	 * Our WordPress hooks
	 * @since  1.0.0
	 */
	public function hooks() {

		// send push notification for notifications cpt
		add_action( 'save_post', array( $this, 'set_postmeta_send' ), 11, 3 );
		add_action( 'publish_'. AppPresser_Notifications::$cpt, array( $this, 'send_push_notification' ), 12, 2 );
		
		// add_action( 'publish_'. AppPresser_Notifications::$cpt, array( $this, 'send_push_notification' ), 10, 2 );


		// send push notifications from any cpt
		$post_types = appp_get_setting( 'notifications_post_types' );

		if ( is_array( $post_types ) ) {

			// loop through our post types from our settings
			foreach ( $post_types as $type ) {

				// And hook in our metabox and publish methods
				add_action( "add_meta_boxes_$type", array( $this, 'add_meta_box' ) );
				add_action( "publish_$type", array( $this, 'save' ), 10, 2 );
				add_action( "publish_future_$type", array( $this, 'send_notify_on_publish' ) );

			}

		}

	}

	/**
	 * Check if we want to output debug form data to the content
	 * @since  1.0.0
	 * @return boolean True if debug mode is on
	 */
	public function is_debug() {
		return ( isset( $_POST['app_debug'] ) || defined( 'APPPRESSER_DEBUG' ) && APPPRESSER_DEBUG );
	}

	public function send_post_request( $action, $data ) {
		// Build url
		$url  = $this->api_url . $action;

		// Encode our data
		$data = json_encode( array( 'request' => $data ) );

		// Define the args for the API
		$args['body'] = $data;
		$args['headers']['Content-Type'] = 'Content-Type: application/json';

		// call the API via the WP HTTP API
		$response = wp_remote_post( esc_url_raw( $url ), $args );
		$response = wp_remote_retrieve_body( $response );

		if ( ! $response )
			return false;

		return $response;

	}

	public function get_devices_by_user_id( $user_ids = array() ){

		$device_ids = null;

		$_user_ids = array();
		
		foreach ( $user_ids as $user ) {
			if( is_object( $user ) ) {
				$_user_ids[] = $user->user_id;
			} else {
				$_user_ids[] = $user;
			}
		}

		if( !empty( $_user_ids ) ) {
			global $wpdb;

			// only accept INT in sql
			$_user_ids = array_map('absint', $_user_ids);
			$_user_ids = implode(',', $_user_ids);
			$sql = "SELECT `meta_value` FROM $wpdb->usermeta WHERE `meta_key` = 'appp_push_device_id' AND `user_id` IN ($_user_ids)";
			$results = $wpdb->get_results( $sql, ARRAY_N );

			if( $results ) {

				$device_ids = array();
				// make sure we don't have any multidimensional arrays
				foreach ($results as $key => $value) {
					
					if( is_array( $value ) ) {

						$value = $value[0];
						
						if( is_serialized( $value ) ) {
							$value = unserialize( $value );
							$device_ids = array_merge($device_ids, $value);
						} else {
							array_push($device_ids, $value);
						}						
					} else {
						array_push($device_ids, $value);
					}
				}
			}
		}

		return $device_ids;
	}
	
	public function notification_send( $send_date, $content, $badges, $devices = array(), $data = array(), $custom_url = '' ){

		$pw_auth = appp_get_setting( 'notifications_pushwoosh_api_key' );

		if ( $pw_auth ) {

			$pw_application = appp_get_setting( 'notifications_pushwoosh_app_key' );

			
			$notifications = array(
				'send_date'  => $send_date, // now
				'content'    => $content,
				'ios_badges' => absint( $badges ),
				//'data'       => json_encode(array( 'custom' => 'json data' )),
			);

			if( !empty( $custom_url ) ) {

				// this domain, load with ajax
				$parsed_url = parse_url( $custom_url, PHP_URL_HOST );
				$site_url   = parse_url( get_site_url(), PHP_URL_HOST );
				if( $parsed_url && $site_url && $parsed_url == $site_url ) {
					$notifications['data'] = '{"custom":{"page_ajax_url":"'.$custom_url.'"}}';
				} else {
					$notifications['data'] = '{"custom":{"page_noajax_url":"'.$custom_url.'"}}';
				}
			}

			// check if devices to send notification only to these devices 
			if( $devices ){
				if( $devices[0] == '0' )
					wp_die();
				$notifications = array_merge( $notifications, array( 'devices' => $devices) );
			}
			

			$arr_message = array(
				'application'   => $pw_application,
				'auth'          => $pw_auth,
				'notifications' => array( $notifications ) 
			);

			/*print_r($arr_message);
			exit();*/

			$response = $this->send_post_request( 'createMessage', $arr_message );

			if ( $this->is_debug() ) {

				wp_die( '<xmp>$response: '. print_r( $response, true ) .'</xmp>' );

			}

		}

	}

	public function send_push_notification( $post_id, $post ) {

		$message = $post->post_title;

		// Add excerpt to message if it exists
		if ( ! empty( $post->post_excerpt ) )
			$message .= ' - ' . $post->post_excerpt;
		
		if( $post->post_type == 'apppush') {
			if( isset($_POST['notify_url']) && !empty($_POST['notify_url'])) {
				$custom_url = $_POST['notify_url'];
			}

		} else {
			$send_push = get_post_meta( $post_id, self::$send_meta_key, true );

			if( $send_push == "1" ) {
				$custom_url = get_permalink( $post_id );
			} else {
				// Don't send a notification if the checkbox wasn't checked
				return;
			}
		}

		// Allow message filtering
		$message = apply_filters( 'send_push_post_content', $message, $post_id, $post );
		$custom_url = apply_filters( 'send_push_custom_url', $custom_url, $post_id, $post );

		$this->notification_send( 'now', $message, 1, null, null, $custom_url );

	}

	public function add_meta_box( $post ) {

		// Don't show metabox once post has been published
		if ( 'publish' == $post->post_status )
			return;

		add_meta_box(
			'appnotifications',
			__( 'AppPush', 'apppresser-push' ),
			array( $this, 'notification_metabox' ),
			$post->post_type,
			'side',
			'high'
		);

	}

	public function notification_metabox( $post ) {

		$post_type = get_post_type_object( $post->post_type );

		// Add an nonce field so we can check for it later.
		wp_nonce_field( self::$nonce_action, self::$nonce_name );

		$checked = get_post_meta( $post->ID, self::$send_meta_key, true );

		echo '<input type="checkbox" name="send_push_notification" value="1" '.checked( $checked, "1", false ).'> '. sprintf( __( 'Send a push notification when this %s is published.', 'apppresser-push' ), $post_type->labels->singular_name );

	}

	public function set_postmeta_send( $post_id, $post, $update ) {

	    if ( ! isset( $_POST[self::$nonce_name] ) )
			return;

		if ( ! wp_verify_nonce( $_POST[self::$nonce_name], self::$nonce_action ) )
			die('nonce invalid');

	    if( isset( $_POST[self::$send_meta_key] ) && $_POST[self::$send_meta_key] == '1' ) {
			update_post_meta( $post_id, self::$send_meta_key, '1' );
		} else {
			delete_post_meta( $post_id, self::$send_meta_key );
		}
	}

	public function send_notify_on_publish( $post_id, $post = null ) {

		if( $post === null ) {
			$post = get_post( $post_id );
		}

		$send_push_notification = get_post_meta( $post_id, self::$send_meta_key, true );

		if( $post->post_status == 'publish' && $send_push_notification == '1' ) {
			// send push notification
			$this->send_push_notification( $post_id, $post );
		}
	}

	public function save( $post_id, $post ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST[self::$nonce_name] ) )
			return;

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST[self::$nonce_name], self::$nonce_action ) )
			return;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if( isset( $_POST[self::$send_meta_key] ) && $_POST[self::$send_meta_key] == '1' ) {
			update_post_meta( $post_id, self::$send_meta_key, '1' );
		}

		// send push notification
		$this->send_push_notification( $post_id, $post );

	}

}


/**
 * apppush_send_notification function.
 * 
 * @access public
 * @param mixed $content
 * @return void
 */
function apppush_send_notification( $content ) {

	if( empty( $content ) ) return;
		
	$appp_push = new AppPresser_Notifications_Update();
	$appp_push->notification_send( 'now', $content, 1 );
	
	do_action( 'apppush_send_notification', $content );
}