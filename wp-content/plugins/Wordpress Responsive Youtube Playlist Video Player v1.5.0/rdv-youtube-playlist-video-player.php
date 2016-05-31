<?php

/*
Plugin Name:  Youtube Playlist Video Player | Shared By themes24x7.com
Description:  A responsive video player to play YouTube playlists. You can enter a YouTube playlist id, channel id or an array of video ids as playlist source. The player is fully responsive and will resize intelligently, it also runs smoothly on mobile devices. The player has a custom designed interface, instead of YouTube’s default interface. You can customise its appearance, and lots of other options and settings in the intuitive admin panel. The playlists can then be added to your pages or posts using a shortcode generator in the editor.
Version: 1.5.0
Author: Rik de Vos
Author URI: http://rikdevos.com/
License: Copyright (C) 2015 Rik de Vos
This is not free software!
*/

define('YTP_FILE', __FILE__);
define('YTP_DIR', dirname(__FILE__));
define('YTP_BASE', basename(__FILE__));

require_once('lib/class/class.db.php');
require_once('lib/class/class.html.php');
require_once('lib/class/class.plugin.php');
require_once('lib/class/class.tinymce.php');
require_once('lib/class/class.widget.php');

$YTP = new YTP;
