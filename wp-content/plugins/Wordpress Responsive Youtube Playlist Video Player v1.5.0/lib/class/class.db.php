<?php

/**
 * 
 * DB
 *
 * @version 1.3
 * @author  Rik de Vos
 */
class YTP_DB {

	public static $db_options_key = 'ytp-db-options';
	public static $db_version_key = 'ytp-db-version';

	public static $options = array(
		'api_key' 					=> '',
		'now_playing_text' 			=> 'Now Playing',
		'max_results' 				=> '50',
		'continuous' 				=> '1',
		'autoplay' 					=> '0',
		'show_channel_in_playlist' 	=> '1',
		'show_channel_in_title' 	=> '1',
		'show_annotations' 			=> '0',
		'volume_mode' 				=> 'auto',
		'volume_percentage' 		=> '75',
		'width' 					=> '100%',
		'time_indicator' 			=> 'full',
		'play_control' 				=> '1',
		'volume_control' 			=> '1',
		'share_control' 			=> '1',
		'fwd_bck_control' 			=> '1',
		'youtube_link_control' 		=> '1',
		'fullscreen_control' 		=> '1',
		'playlist_toggle_control' 	=> '1',
		'show_playlist' 			=> 'auto',
		'show_controls_on_load' 	=> '1',
		'show_controls_on_pause' 	=> '1',
		'show_controls_on_play' 	=> '0',

		// New in 1.1
		'pagination'				=> '1',
		'load_more_text'			=> 'Load More',
		'force_hd'					=> '0',
		'hide_youtube_logo'			=> '0',

		// New in 1.3
		'playlist_type' 			=> 'vertical',

		// New in 1.4
		'width_type'				=> 'responsive',
		'width_max_value'			=> '900',
		'width_min_value'			=> '300',
		'width_fixed_value'			=> '700',

		// Colors
		'color_controls_bg' 		=> 'rgba(0,0,0,0.75)',
		'color_buttons' 			=> 'rgba(255,255,255,0.5)',
		'color_buttons_hover' 		=> 'rgba(255,255,255,1)',
		'color_buttons_active' 		=> 'rgba(255,255,255,1)',
		'color_time_text' 			=> 'rgba(255,255,255,1)',
		'color_bar_bg' 				=> 'rgba(255,255,255,0.5)',
		'color_buffer' 				=> 'rgba(255,255,255,0.25)',
		'color_fill' 				=> 'rgba(255,255,255,1)',
		'color_video_title' 		=> 'rgba(255,255,255,1)',
		'color_video_channel' 		=> 'rgba(223,247,109,1)',
		'color_playlist_overlay' 	=> 'rgba(0,0,0,0.75)',
		'color_playlist_title' 		=> 'rgba(255,255,255,1)',
		'color_playlist_channel' 	=> 'rgba(223,247,109,1)',
		'color_scrollbar' 			=> 'rgba(255,255,255,1)',
		'color_scrollbar_bg' 		=> 'rgba(255,255,255,0.25)',

	);

	public static $db_version = 1;
	
	public static function init() {
		self::update_db();
		self::get_options();
	}

	public static function get_option($name, $default = NULL) {
		return get_option(self::$db_options_key.'-'.$name, $default);
	}

	public static function set_option($name, $value) {
		return update_option(self::$db_options_key.'-'.$name, $value);
	}

	public static function get($name, $default = NULL) {
		return isset(self::$options[$name]) ? self::$options[$name] : $default;
	}

	public static function set($name, $value, $update = true) {
		self::$options[$name] = $value;
		if($update) {
			self::update_options();
		}
	}

	public static function get_options() {
		$options = get_option(self::$db_options_key);
		if(empty($options)) {
			self::update_options();
			return;
		}
		foreach($options as $name=>$value) {
			self::$options[$name] = $value;
		}
	}

	public static function update_options() {
		return update_option(self::$db_options_key, self::$options);
	}

	public static function get_db_version() {
		$version = get_option(self::$db_version_key);
		if(!$version) {
			return 0;
		}
		return (int)$version;
	}

	public static function set_db_version($version) {
		update_option(self::$db_version_key, $version);
	}

	public static function update_db() {

		$version = self::get_db_version();

		self::set_db_version(self::$db_version);

	}

}

