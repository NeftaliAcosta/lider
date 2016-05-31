<div class="ytp-a-tab-title"><i class="fa fa-eye"></i>Appearance</div>
<div class="ytp-a-content">
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Now Playing Text</div>
			<div class="ytp-a-option-description">
				Text displaying &quot;Now Playing&quot; in the playlist.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::textbox('ytp_now_playing_text', YTP_DB::get('now_playing_text')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Load More Text</div>
			<div class="ytp-a-option-description">
				Text displaying &quot;Load More&quot; to load more video's.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::textbox('ytp_load_more_text', YTP_DB::get('load_more_text')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Player Width</div>
			<div class="ytp-a-option-description">
				Set the player to behaive responsive, enter a min/max-width, or set a fixed-width.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<label style="margin: 4px 0; display: inline-block">
				<input name="ytp_width_type" type="radio" <?php if(YTP_DB::get('width_type') == 'responsive') { echo 'checked="checked"'; } ?> value="responsive" />Responsive
			</label>
			<br />
			<label style="margin: 4px 0; display: inline-block; width: 180px;">
				<input name="ytp_width_type" type="radio" <?php if(YTP_DB::get('width_type') == 'limit_width') { echo 'checked="checked"'; } ?> value="limit_width" />Min-Width &amp; Max-Width:
			</label>
			<div class="ytp-number">
				<input class="" max="10000" min="0" name="ytp_width_min_value" step="50" type="number" value="<?php echo esc_attr(YTP_DB::get('width_min_value')); ?>" />
			</div>
			 - 
			<div class="ytp-number">
				<input class="" max="10000" min="0" name="ytp_width_max_value" step="50" type="number" value="<?php echo esc_attr(YTP_DB::get('width_max_value')); ?>" />
			</div>
			<br />
			<label style="margin: 4px 0; display: inline-block; width: 180px;">
				<input name="ytp_width_type" type="radio" <?php if(YTP_DB::get('width_type') == 'fixed_width') { echo 'checked="checked"'; } ?> value="fixed_width" />Fixed-Width:
			</label>
			<div class="ytp-number">
				<input class="" max="10000" min="0" name="ytp_width_fixed_value" step="50" type="number" value="<?php echo esc_attr(YTP_DB::get('width_fixed_value')); ?>" />
			</div>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Playlist Layout</div>
			<div class="ytp-a-option-description">
				Set the layout of the player.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::radio('ytp_playlist_type', array(
				array('vertical', 'Vertically (playlist on the right)'),
				array('horizontal', 'Horizontally (playlist at the bottom)'),
			), YTP_DB::get('playlist_type')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Show Playlist</div>
			<div class="ytp-a-option-description">
				Set the playlist visibility upon load and resize.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::radio('ytp_show_playlist', array(
				array('auto', 'Auto Show'),
				array('0', 'Hide Upon Load'),
				array('1', 'Show Upon Load')
			), YTP_DB::get('show_playlist')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Display Annotations</div>
			<div class="ytp-a-option-description">
				Show or hide the interactive annotations in the YouTube video.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_show_annotations', YTP_DB::get('show_annotations')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Hide YouTube Logo</div>
			<div class="ytp-a-option-description">
				This option lets you use a YouTube player that does not show a YouTube logo.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_hide_youtube_logo', YTP_DB::get('hide_youtube_logo')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Force HD</div>
			<div class="ytp-a-option-description">
				Force the player to show HD (720p/1080p) content.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_force_hd', YTP_DB::get('force_hd')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Channel In Title</div>
			<div class="ytp-a-option-description">
				Display the channel name in the title of videos.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_show_channel_in_title', YTP_DB::get('show_channel_in_title')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Channel In Playlist</div>
			<div class="ytp-a-option-description">
				Display the channel name in the playlist of videos.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_show_channel_in_playlist', YTP_DB::get('show_channel_in_playlist')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Show Controls On Load</div>
			<div class="ytp-a-option-description">
				Whether or not to show the controls upon loading the page. When disabled, the user will only see a play button on top of the poster image upon loading the page.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_show_controls_on_load', YTP_DB::get('show_controls_on_load')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Show Controls On Pause</div>
			<div class="ytp-a-option-description">
				Always display the controls when the video is paused.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_show_controls_on_pause', YTP_DB::get('show_controls_on_pause')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Show Controls On Play</div>
			<div class="ytp-a-option-description">
				Always display the controls when the video is playing.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_show_controls_on_play', YTP_DB::get('show_controls_on_play')); ?>
		</div>
	</div>
</div>