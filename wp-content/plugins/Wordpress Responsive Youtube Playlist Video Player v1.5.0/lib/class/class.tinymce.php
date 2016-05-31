<?php

/**
 * 
 * Plugin Class
 *
 * @version 1.3
 * @author  Rik de Vos
 */
class YTP_TinyMCE {

	public static function init() {
		add_action('init', array('YTP_TinyMCE', 'add_button_plugin'));
		add_filter('tiny_mce_version', array('YTP_TinyMCE', 'refresh_version'));
	}

	public static function add_button_plugin() {
		if (get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", array('YTP_TinyMCE', "add_plugin"));
			add_filter('mce_buttons', array('YTP_TinyMCE', 'add_button'));
		}
	}

	public static function refresh_version($ver) {
		$ver += 3;
		return $ver;
	}

	public static function add_plugin($plugin_array) {
		$plugin_array['ytp_button'] = plugins_url( 'js/tinymce-button.js', YTP_FILE);
		return $plugin_array;
	}

	public static function add_button($buttons) {
		array_push($buttons, "|", "ytp_button");
		return $buttons;
	}

}