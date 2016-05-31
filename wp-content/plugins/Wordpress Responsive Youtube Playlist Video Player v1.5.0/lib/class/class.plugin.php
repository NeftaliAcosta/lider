<?php

/**
 * 
 * Wordpress Responsive Youtube Playlist Video Player
 *
 * @version 1.5.0
 * @author  Rik de Vos
 */
class YTP {

	public $notifications = array();
	
	/**
	 * Constructor function
	 * @return null
	 */
	function __construct() {

		// Initiate helper classes
		YTP_DB::init();
		YTP_TinyMCE::init();

		// Load assets
		add_action('init', array($this, 'enqueue_client_assets'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));

		// Create admin page
		add_action('admin_menu', array($this, 'create_menu'));

		// Save Changes
		if(isset($_POST['ytp_action']) && $_POST['ytp_action'] == 'save_changes') {
			add_action('init', array($this, 'save_changes'));
		}

		add_action('init', array($this, 'check_api_key'));

		add_action('init', array($this, 'register_shortcode'));

		add_action('widgets_init', array($this, 'register_widget'));	

		// Custom CSS
		add_action('wp_ajax_youtube_video_player_custom_css', array($this, 'output_custom_css'));
		add_action('wp_ajax_nopriv_youtube_video_player_custom_css', array($this, 'output_custom_css'));
	}

	function register_widget() {
		register_widget('YTP_Widget');
	}

	function register_shortcode() {
		add_shortcode('ytp_playlist', array($this, 'shortcode_playlist'));
		add_shortcode('ytp_channel', array($this, 'shortcode_channel'));
		add_shortcode('ytp_user', array($this, 'shortcode_user'));
		add_shortcode('ytp_video', array($this, 'shortcode_video'));
	}

	function shortcode_playlist($atts, $content = null) {
		if(!isset($atts['source'])) { return 'No source entered'; }
		return $this->shortcode_output($atts, 'playlist');
	}

	function shortcode_channel($atts, $content = null) {
		if(!isset($atts['source'])) { return 'No source entered'; }
		return $this->shortcode_output($atts, 'channel');
	}

	function shortcode_user($atts, $content = null) {
		if(!isset($atts['source'])) { return 'No source entered'; }
		return $this->shortcode_output($atts, 'user');
	}

	function shortcode_video($atts, $content = null) {
		if(!isset($atts['source'])) { return 'No source entered'; }
		return $this->shortcode_output($atts, 'videos');
	}

	function shortcode_output($atts, $type) {

		$colors = array();
		$plugin_ops = array();

		$options = YTP_DB::$options;
		foreach($options as $option_name => $option_value) {

			// Overwrite db settings from shortcode
			if(isset($atts[$option_name])) {
				$option_value = $atts[$option_name];
			}

			// Convert to bools
			if($option_value == '0') {
				$option_value = false;
			}else if($option_value == '1') {
				$option_value = true;
			}

			// Check for color
			if($option_name !== str_replace('color_', '', $option_name)) {
				$option_name = str_replace('color_', '', $option_name);
				$colors[$option_name] = $option_value;
			}else {
				$plugin_ops[$option_name] = $option_value;
			}

		}

		$plugin_ops['colors'] = $colors;

		$plugin_ops['max_results'] = (int)$plugin_ops['max_results'];

		$plugin_ops[$type] = $atts['source'];

		if($plugin_ops['volume_mode'] == 'auto') {
			$plugin_ops['volume'] = false;
		}else if($plugin_ops['volume_mode'] == 'mute') {
			$plugin_ops['volume'] = 0;
		}else if($plugin_ops['volume_mode'] == 'custom') {
			$plugin_ops['volume'] = round($plugin_ops['volume_percentage'])/100;
		}

		if(empty($plugin_ops['api_key'])) {
			$plugin_ops['api_key'] = 'AIzaSyDmk3oxVjtu06AwRv6oADPvcYO9tvswzm8';
		}

		$style = '';
		switch ($plugin_ops['width_type']) {
			case 'responsive':
				$style = 'width: 100%;';
				break;
			case 'limit_width':
				$style = 'min-width: '.$plugin_ops['width_min_value'].'px !important; max-width: '.$plugin_ops['width_max_value'].'px !important;';
				break;
			case 'fixed_width':
				$style = 'width: '.$plugin_ops['width_fixed_value'].'px !important;';
				break;
		}

		return '<div class="ytp-video-player" style="'.$style.'" data-options="'.esc_attr(json_encode($plugin_ops)).'"></div>';

	}

	function output_custom_css() {
		header("Content-type: text/css; charset: UTF-8");
		echo YTP_DB::get_option('custom-css');
		exit();
	}

	function create_menu() {
		if(!current_user_can('manage_options')) {
			return;
		}
		add_menu_page('YouTube', 'YouTube', 'manage_options', 'ytp-youtube', array($this, 'create_page'), plugins_url( 'images/icon.jpg', YTP_FILE ));
	}

	function create_page() {
		include YTP_DIR.'/lib/admin/admin.php';
	}

	function enqueue_client_assets() {
		// Styles
		wp_enqueue_style('google-fonts-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700');
		wp_enqueue_style('ytp-icons', plugins_url('packages/icons/css/icons.min.css', YTP_FILE));
		wp_enqueue_style('ytp-style', plugins_url('packages/youtube-video-player/css/youtube-video-player.min.css', YTP_FILE));
		wp_enqueue_style('perfect-scrollbar-style', plugins_url('packages/perfect-scrollbar/perfect-scrollbar.css', YTP_FILE));
		wp_enqueue_style('ytp-custom-css', admin_url('admin-ajax.php').'?action=youtube_video_player_custom_css');

		// Scripts
		wp_register_script('jquery-mousewheel', plugins_url('packages/perfect-scrollbar/jquery.mousewheel.js', YTP_FILE), array('jquery'));
		wp_register_script('perfect-scrollbar-script', plugins_url('packages/perfect-scrollbar/perfect-scrollbar.js', YTP_FILE), array('jquery', 'jquery-mousewheel'));
		wp_register_script('ytp-script', plugins_url('packages/youtube-video-player/js/youtube-video-player.jquery.min.js', YTP_FILE), array('jquery', 'perfect-scrollbar-script'));
		wp_enqueue_script('ytp-plugin', plugins_url('js/plugin.js', YTP_FILE), array('jquery', 'perfect-scrollbar-script', 'ytp-script'));

	}

	function enqueue_admin_assets() {

		if(isset($_GET['page']) && $_GET['page'] == 'ytp-youtube') {
			
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_style('google-fonts-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700');
			wp_enqueue_style('font-awesome', plugins_url('packages/font-awesome-4.3.0/css/font-awesome.min.css', YTP_FILE));
			
			
			wp_enqueue_script( 'ytp-admin-script', plugins_url('js/admin.js', YTP_FILE), array( 'wp-color-picker','jquery' ), false, false );
		}
		wp_enqueue_style('ytp-admin-style', plugins_url('css/admin.css', YTP_FILE), array('dashicons'));
		wp_enqueue_style('google-fonts-lato', 'http://fonts.googleapis.com/css?family=Lato:400,700');

		global $wp_version;
		$use_tinymce_icon = 0;
		if(version_compare($wp_version, '3.8.0', '>=')) {
			$use_tinymce_icon = 1;
		}
		wp_localize_script( 'ytp-admin-script', 'ytp_admin_options', array('use_tinymce_icon' => $use_tinymce_icon));

		wp_enqueue_script('ytp-widget-script', plugins_url('js/widget.js', YTP_FILE), array('jquery'));

	}

	function enqueue_style($name, $url, $dependencies = false) {
		wp_register_style($name, plugins_url($url, YTP_FILE ), $dependencies, false, 'screen');
		wp_enqueue_style($name);
	}

	function enqueue_script($name, $url, $deps = false, $local_url = true) {
		if($local_url) {
			$url = plugins_url( $url, YTP_FILE );
		}
		wp_register_script($name, $url, $deps, false);
		wp_enqueue_script($name);
	}

	function save_changes() {
		if(empty($_POST['ytp_nonce']) || !wp_verify_nonce($_POST['ytp_nonce'], YTP_BASE)) { return; }

		foreach(YTP_DB::$options as $option_name => $option_value) {
			if(isset($_POST['ytp_'.$option_name])) {
				YTP_DB::set($option_name, stripslashes($_POST['ytp_'.$option_name]), false);
			}else if(isset($_POST['ytp_'.$option_name.'_color']) && isset($_POST['ytp_'.$option_name.'_opacity'])) {
				$color = stripslashes($_POST['ytp_'.$option_name.'_color']);
				$opacity = stripslashes($_POST['ytp_'.$option_name.'_opacity']);
				$rgba = YTP_HTML::opacity_hex_to_rgba($opacity, $color);
				YTP_DB::set($option_name, $rgba, false);
			}
		}

		if(isset($_POST['ytp_custom_css'])) {
			YTP_DB::set_option('custom-css', stripslashes($_POST['ytp_custom_css']));
		}
		
		YTP_DB::update_options();
		$this->add_notification('Your changes have been saved.');

	}

	function check_api_key() {
		if(YTP_DB::get('api_key') == '') {
			$this->add_notification('We\'ve noticed you haven\'t entered an API key, this means you\'re still using the default API key. We recommend registering your own private API key as many users use the default key and it has a limited number of requests. Do it now, it\'s free!', 'warning');
		}
	}

	function add_notification($text, $type = 'success') {
		$this->notifications[] = array(
			'text' => $text,
			'type' => $type,
		);
	}

	function print_notifications() {
		foreach($this->notifications as $notification) {
			if($notification['type'] == 'success') {
				echo '<div class="ytp-a-notification ytp-a-notification-success"><i class="fa fa-check"></i>'.$notification['text'].'</div>';
			}else if($notification['type'] == 'warning') {
				echo '<div class="ytp-a-notification ytp-a-notification-warning"><i class="fa fa-warning"></i>'.$notification['text'].'</div>';
			}
			
		}
	}

}

