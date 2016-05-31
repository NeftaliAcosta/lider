<div class="ytp-a-tab-title"><i class="fa fa-book"></i>Help</div>
<div class="ytp-a-content">
	This is just a quick help file with some FAQs. For a full documentation,
	refer to the <a href="<?php echo plugins_url('documentation.pdf', YTP_FILE ); ?>" target="_blank">documentation</a> in your download file. If
	you still have questions, you can of course <a href="http://codecanyon.net/user/RikdeVos?ref=RikdeVos#message" target="_blank">contact me here</a>.
	<div class="ytp-faq ytp-faq-first">
		<div class="ytp-faq-title"><i class="fa fa-plus-circle"></i>Where do I register an API key?</div>
		<div class="ytp-faq-content">
			<ol>
				<li><strong>Create a Google Account</strong>
					<p>If you do not already have a Google account, create one now as you'll be needing it.</p>
				</li>
				<li><strong>Create a new Google Project</strong>
					<p>Go to your <a href="https://code.google.com/apis/console" target="_blank">Google Console</a>. Click on <strong>Projects</strong> in the upper-left, then <strong>Create Project</strong> and enter a project name &amp; ID.</p>
				</li>
				<li><strong>Enable YouTube Data API V3</strong>
					<p>Click on the project you have created if it hasn't already opened after creating. Then go to <strong>APIs &amp; auth</strong> on the left. In the next screen, click on <strong>YouTube Data API V3</strong>. Enable the API by toggling the <strong>OFF</strong> button to <strong>ON</strong>.</p>
				</li>
				<li><strong>Get API Key</strong>
					<p>Once you have enabled the API, click on <strong>Quota</strong> on the top. You can then click on <strong>API Access</strong> on the top left and create a new <strong>Browser Key</strong>. This key can be linked to a domain for security measures, but it is not obligated. Once you've created the key (it should look something like this: <em>AIzaSyDmk3oxVjtu06AWRv60ADPvcYO9tvswzm8</em>), copy it and use it as 'YouTube Data V3 API Key' option on the General Settings tab.</p>
				</li>
			</ol>
		</div>
	</div>

	<div class="ytp-faq">
		<div class="ytp-faq-title"><i class="fa fa-plus-circle"></i>How do I create a YouTube playlist?</div>
		<div class="ytp-faq-content">
			<ol>
				<li><strong>Go to your Channel homepage on YouTube.</strong></li>
				<li><strong>Click on Playlists under your channel name.</strong></li>
				<li><strong>Click on New Playlist, and make sure it's set to Public.</strong></li>
				<li><strong>Now you can add videos to that playlist.</strong></li>
				<li><strong>Copy the playlist link and use it in the shortcode generator.</strong></li>
			</ol>
		</div>
	</div>

	<div class="ytp-faq">
		<div class="ytp-faq-title"><i class="fa fa-plus-circle"></i>How do I place a playlist on my page?</div>
		<div class="ytp-faq-content">
			<p>Playlists can be added onto your pages using the shortcode button in the editor which looks like this: </p>
			<img src="<?php echo plugins_url( 'images/icon-new.png', YTP_FILE ) ?>" width="22" height="20" />
			<p>Click on the button, then copy-paste your playlist URL into the correct field and click on the <strong>Insert</strong> button.</p>
		</div>
	</div>

	<div class="ytp-faq">
		<div class="ytp-faq-title"><i class="fa fa-plus-circle"></i>Getting the message 'There was an error retrieving the playlist'</div>
		<div class="ytp-faq-content">
			<ol>
				<li><strong>Make sure you have entered the correct link in the shortcode.</strong></li>
				<li><strong>Check if the api-key you have entered is correct and has YouTube Data V3 enabled. When in doubt, leave the api key field blank to use the default api key.</strong></li>
				<li><strong>The videos in the playlist, and the playlist itself, must be Public and Embeddable.</strong></li>
			</ol>
		</div>
	</div>

	<div class="ytp-faq">
		<div class="ytp-faq-title"><i class="fa fa-plus-circle"></i>Not all browsers/devices have the fullscreen button. Why?</div>
		<div class="ytp-faq-content">
			<p>Fullscreen is supported on browsers that have the HTML5 <strong>requestFullscreen</strong> method. Currently these are Chrome, FireFox, Safari and Android. IE users can double-click the video to view the video fullscreen, but the controls will be hidden since this is YouTube's own function.</p>
		</div>
	</div>
</div>