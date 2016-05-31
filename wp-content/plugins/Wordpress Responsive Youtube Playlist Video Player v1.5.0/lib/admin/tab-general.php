<div class="ytp-a-tab-title"><i class="fa fa-cog"></i>General Settings</div>
<div class="ytp-a-content">
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">YouTube Data V3 API Key</div>
			<div class="ytp-a-option-description">
				API key neccesary for retrieving data from YouTube. When empty, the default API key will be used which is limited. <a href="#" class="ytp-open-help-tab">Regiser your key for free.</a>
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::textbox('ytp_api_key', YTP_DB::get('api_key')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Max Video Results</div>
			<div class="ytp-a-option-description">
				Amount of video's to load. The maximum of this option is 50 due to YouTube's API limitations, but with <strong>Pagination</strong> enabled you can retrieve up to 50 video's each time.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::textbox('ytp_max_results', YTP_DB::get('max_results')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Pagination</div>
			<div class="ytp-a-option-description">
				When enabled, a button "Load More" will show to load more video's once the <strong>Max Video Results</strong> limit is reached.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_pagination', YTP_DB::get('pagination')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Autoplay</div>
			<div class="ytp-a-option-description">
				Autoplay the video when the page loads. This does not work on mobile devices.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_autoplay', YTP_DB::get('autoplay')); ?>
		</div>
	</div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Continuous Play</div>
			<div class="ytp-a-option-description">
				Play the next video in the playlist when the current one has finished.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::checkbox('ytp_continuous', YTP_DB::get('continuous')); ?>
		</div>
	</div>
	<div class="ytp-a-option-hr"></div>
	<div class="ytp-a-option">
		<div class="ytp-a-option-left">
			<div class="ytp-a-option-title">Starting Volume</div>
			<div class="ytp-a-option-description">
				Set the playlist visibility upon load and resize.
			</div>
		</div>
		<div class="ytp-a-option-right">
			<?php echo YTP_HTML::radio('ytp_volume_mode', array(
				array('auto', 'YouTube\'s Default Volume'),
				array('mute', 'Mute'),
				array('custom', 'Enter Custom Percentage')
			), YTP_DB::get('volume_mode')); ?>
			<?php echo YTP_HTML::percentage('ytp_volume_percentage', YTP_DB::get('volume_percentage')); ?>
		</div>
	</div>
</div>