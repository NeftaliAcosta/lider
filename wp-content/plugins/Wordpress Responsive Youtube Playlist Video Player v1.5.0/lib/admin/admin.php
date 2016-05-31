<form action="admin.php?page=ytp-youtube" data-original-action="admin.php?page=ytp-youtube" class="ytp-a-form" method="POST">
	<?php wp_nonce_field(YTP_BASE, 'ytp_nonce'); ?>
	<input type="hidden" name="ytp_action" value="save_changes" />
	<div class="ytp-a">
		<div class="ytp-a-header">
			<div class="ytp-a-header-lines">
				<div class="ytp-a-header-line" style="background: #a0cecb"></div>
				<div class="ytp-a-header-line" style="background: #e8ce4d"></div>
				<div class="ytp-a-header-line" style="background: #8067b7"></div>
				<div class="ytp-a-header-line" style="background: #d8334a"></div>
				<div class="ytp-a-header-line" style="background: #3c383d"></div>
			</div>
			<div class="ytp-a-header-text">
				<div class="ytp-a-title">YouTube Playlist Video Player</div>
				<strong>Version 1.5.0</strong>
				<a href="<?php echo plugins_url('documentation.pdf', YTP_FILE ); ?>" target="_blank" style="top: 12px;">Documentation</a>
				<a href="http://codecanyon.net/user/RikdeVos?ref=RikdeVos#message" target="_blank" style="bottom: 10px;">Support</a>
			</div>
		</div>
		<?php $this->print_notifications(); ?>
		<div class="ytp-a-tabs">
			<ul>
				<li class="ytp-a-tabs-active"><a href="#" data-tab="general"><i class="fa fa-cog"></i>General Settings</a></li>
				<li><a href="#" data-tab="appearance"><i class="fa fa-eye"></i>Appearance</a></li>
				<li><a href="#" data-tab="controls"><i class="fa fa-sliders fa-rotate-90"></i>Controls</a></li>
				<li><a href="#" data-tab="colors"><i class="fa fa-tint"></i>Colors</a></li>
				<li><a href="#" data-tab="custom-css"><i class="fa fa-code"></i>Custom CSS</a></li>
				<li><a href="#" data-tab="help"><i class="fa fa-book"></i>Help</a></li>
			</ul>
		</div>
		<div class="ytp-a-tab" id="ytp-a-tab-general" style="display: block;"><?php include 'tab-general.php'; ?></div>
		<div class="ytp-a-tab" id="ytp-a-tab-appearance"><?php include 'tab-appearance.php'; ?></div>
		<div class="ytp-a-tab" id="ytp-a-tab-controls"><?php include 'tab-controls.php'; ?></div>
		<div class="ytp-a-tab" id="ytp-a-tab-colors"><?php include 'tab-colors.php'; ?></div>
		<div class="ytp-a-tab" id="ytp-a-tab-custom-css"><?php include 'tab-custom-css.php'; ?></div>
		<div class="ytp-a-tab" id="ytp-a-tab-help"><?php include 'tab-help.php'; ?></div>
	</div>
	<input type="submit" value="Save Changes" class="ytp-button ytp-submit" />
</form>