<?php
//Load Wordpress
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp . '/wp-load.php' );
header('HTTP/1.1 200 OK');

/*
if(!current_user_can('manage_ytp_mce_options')) {
	wp_die( __('You do not have sufficient permissions to access this page.') );
}
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
	<style type="text/css">
		#TB_window {
			height: 450px !important;
		}

		.ytp_mce_textbox {
			padding: 6px;
			box-shadow: inset 0 0 0 1px #ddd;
			/*width: 100%;*/
		}

		.ytp_mce_textbox input[type=text] {
			padding: 0;
			margin: 0;
			border: none;
			outline: none;
			width: 100%;
			box-shadow: none;
			font-size: 12px;
			font-family: 'Open Sans';
		}

		.ytp_mce_textbox.ytp_mce_textbox_invalid {
			box-shadow: inset 0 0 0 2px #d8334a;
		}

		.ytp-button.ytp-button-insert-shortcode {
			font-size: 10px;
			padding: 6px 12px;
		}

		.ytp_mce_container {
			width: 500px;
			margin: 0 auto;
			margin-top: 20px;
			font-family: 'Open Sans', sans-serif;
		}

		.ytp_mce_option {
			width: 500px;
			margin-bottom: 20px;
		}

		.ytp_mce_option:after {
			content: ".";
			display: block;
			height: 0;
			clear: both;
			visibility: hidden;
		}

			.ytp_mce_option .ytp_mce_option-left {
				float: left;
				width: 400px;
			}

				.ytp_mce_option .ytp_mce_option-left .ytp_mce_option-title {
					font-weight: bold;
					font-family: 'Lato';
					/*text-transform: uppercase;*/
					margin-bottom: 5px;
				}

				.ytp_mce_option .ytp_mce_option-left .ytp_mce_option-description {
					/*font-style: italic;*/
					font-size: 11px;
				}

			.ytp_mce_option .ytp_mce_option-right {
				float: left;
				width: 80px;
				padding-left: 20px;
				padding-top: 23px;
			}

	</style>
</head>
<body>
	
	<div class="ytp_mce_container">
		<p>Paste the (complete) link into one of the textboxes, then click the <strong>insert</strong> button to insert the shortcode. </p>
		<div class="ytp_mce_option">
			<div class="ytp_mce_option-left">
				<div class="ytp_mce_option-title">YouTube Playlist</div>
				<div class="ytp_mce_textbox"><input type="text" id="ytp_mce_playlist" /></div>
				<div class="ytp_mce_option-description">Eg: https://youtube.com/watch?v=vLeQJL8K0&amp;list=Cn1t1pybju9ffSPBohU<br />Or: http://www.youtube.com/playlist?list=PLncTFGctaqZtjmdxnpOpqYc</div>
			</div>
			<div class="ytp_mce_option-right">
				<a href="#" class="ytp-button ytp-button-insert-shortcode ytp-button-insert-shortcode-playlist"><i class="fa fa-plus"></i> &nbsp;Insert</a>
			</div>
		</div>
		<div class="ytp_mce_option">
			<div class="ytp_mce_option-left">
				<div class="ytp_mce_option-title">YouTube Channel/User</div>
				<div class="ytp_mce_textbox"><input type="text" id="ytp_mce_channel" /></div>
				<div class="ytp_mce_option-description">Eg: https://www.youtube.com/channel/UCq-4ombcPnNvFFS7duZfpeg<br />Or: https://www.youtube.com/user/someusername</div>
			</div>
			<div class="ytp_mce_option-right">
				<a href="#" class="ytp-button ytp-button-insert-shortcode ytp-button-insert-shortcode-channel"><i class="fa fa-plus"></i> &nbsp;Insert</a>
			</div>
		</div>
		<div class="ytp_mce_option">
			<div class="ytp_mce_option-left">
				<div class="ytp_mce_option-title">YouTube Single Video</div>
				<div class="ytp_mce_textbox"><input type="text" id="ytp_mce_video" /></div>
				<div class="ytp_mce_option-description">Eg: https://youtube.com/watch?v=vLeQJLffSPBo</div>
			</div>
			<div class="ytp_mce_option-right">
				<a href="#" class="ytp-button ytp-button-insert-shortcode ytp-button-insert-shortcode-video"><i class="fa fa-plus"></i> &nbsp;Insert</a>
			</div>
		</div>
	</div>

	<script>
	(function($){

		$(".ytp-button-insert-shortcode-playlist").click(function(e) {
			e.preventDefault();
			ytp_mce_insert_playlist();
		});

		$(".ytp-button-insert-shortcode-channel").click(function(e) {
			e.preventDefault();
			ytp_mce_insert_channel();
		});

		$(".ytp-button-insert-shortcode-video").click(function(e) {
			e.preventDefault();
			ytp_mce_insert_video();
		});

		function ytp_add_text(text) {
			tinymce.execCommand('mceInsertContent', false, text);
			tb_remove();
		}

		function ytp_mce_insert_playlist() {
			var url = $("#ytp_mce_playlist").val(),
				regex = /list\=([A-Za-z0-9_-]+)/,
				matches = url.match(regex);

			if(matches === null) {
				$("#ytp_mce_playlist").parent().addClass('ytp_mce_textbox_invalid');
				return;
			}

			$("#ytp_mce_playlist").parent().removeClass('ytp_mce_textbox_invalid');

			var list = matches[1];
			$("#ytp_mce_playlist").val('');
			ytp_add_text('[ytp_playlist source="'+list+'"]');
			
		}

		function ytp_mce_insert_channel() {
			var url = $("#ytp_mce_channel").val(),
				regex_channel = /channel\/([A-Za-z0-9_-]+)/,
				regex_user = /user\/([A-Za-z0-9_-]+)/;
				matches = url.match(regex_channel);

			$("#ytp_mce_channel").parent().removeClass('ytp_mce_textbox_invalid');

			if(matches === null) {
				matches = url.match(regex_user);
				if(matches === null) {
					$("#ytp_mce_channel").parent().addClass('ytp_mce_textbox_invalid');
					return;
				}
				var user = matches[1];
				ytp_add_text('[ytp_user source="'+user+'"]');
			}else if(matches !== null) {
				var channel = matches[1];
				ytp_add_text('[ytp_channel source="'+channel+'"]');
			}else {
				$("#ytp_mce_channel").parent().addClass('ytp_mce_textbox_invalid');
				return;
			}
		}

		function ytp_mce_insert_video() {
			var url = $("#ytp_mce_video").val(),
				regex = /watch\?v\=([A-Za-z0-9_-]+)/,
				matches = url.match(regex);

			$("#ytp_mce_video").parent().removeClass('ytp_mce_textbox_invalid');

			if(matches === null) {
				$("#ytp_mce_video").parent().addClass('ytp_mce_textbox_invalid');
				return;
			}

			var video = matches[1];
			$("#ytp_mce_video").val('');
			ytp_add_text('[ytp_video source="'+video+'"]');
			
		}
	})(jQuery);

	</script>
</body>
</html>