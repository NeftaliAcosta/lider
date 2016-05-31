<div class="ytp-a-tab-title"><i class="fa fa-sliders fa-rotate-90"></i>Controls</div>
<div class="ytp-a-content">
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Time Indicator</div>
			<div class="ytp-a-option-description">
				Set the playlist visibility upon load and resize.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::radio('ytp_time_indicator', array(
				array('full', 'Show Elapsed Time &amp; End Time'),
				array('1', 'Only Show Elapsed Time'),
				array('0', 'Do Not Show Any Time')
			), YTP_DB::get('time_indicator')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Play Button</div>
			<div class="ytp-a-option-description">
				Show the play/pause button in the controls bar.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_play_control', YTP_DB::get('play_control')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Volume Slider</div>
			<div class="ytp-a-option-description">
				Show a volume slider in the controls bar to adjust the playback volume.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_volume_control', YTP_DB::get('volume_control')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Share Button</div>
			<div class="ytp-a-option-description">
				Display button to share the video on facebook, twitter or google+.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_share_control', YTP_DB::get('share_control')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Forward/Backward Button</div>
			<div class="ytp-a-option-description">
				Display a forward and backward button for users to cycle through the playlist.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_fwd_bck_control', YTP_DB::get('fwd_bck_control')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">YouTube Link</div>
			<div class="ytp-a-option-description">
				Show a YouTube link in the control bar which opens the video on youtube.com when clicked.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_youtube_link_control', YTP_DB::get('youtube_link_control')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Fullscreen Button</div>
			<div class="ytp-a-option-description">
				Display a button in the controls bar to view the video in fullscreen. Note: not all browsers support fullscreen. On these browsers the button will always be hidden.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_fullscreen_control', YTP_DB::get('fullscreen_control')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Playlist Toggle Button</div>
			<div class="ytp-a-option-description">
				Display a button in the controls bar to toggle the playlist on the side.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_playlist_toggle_control', YTP_DB::get('playlist_toggle_control')); ?>
		</div>
	</div>
</div>