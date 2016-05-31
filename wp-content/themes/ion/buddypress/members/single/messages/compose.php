<form action="<?php bp_messages_form_action('compose' ); ?>" method="post" id="send_message_form" class="standard-form list" role="main" enctype="multipart/form-data">

	<?php do_action( 'bp_before_messages_compose_content' ); ?>

	<ul class="first">
	<?php bp_message_get_recipient_tabs(); ?>
	</ul>

	<label for="send-to-input" class="item item-input item-stacked-label">

		<span class="input-label"><?php _e("Send To (Username or Friend's Name)", 'appp_ion' ); ?></span>

		<input type="text" name="send-to-input" class="send-to-input" id="send-to-input" />

	</label>

	<?php if ( bp_current_user_can( 'bp_moderate' ) ) : ?>
		<label class="item">
		<input type="checkbox" id="send-notice" name="send-notice" value="1" /> <?php _e( "This is a notice to all users.", "appbuddy" ); ?>
		</label>
	<?php endif; ?>

	<label for="subject" class="item item-input item-stacked-label">
		<span class="input-label"><?php _e( 'Subject', 'appp_ion' ); ?></span>
		<input type="text" name="subject" id="subject" value="<?php bp_messages_subject_value(); ?>" />
	</label>

	<label for="content" class="item item-input item-stacked-label">
		<span class="input-label"><?php _e( 'Message', 'appp_ion' ); ?></span>
		<textarea name="content" id="message_content" rows="15" cols="40"><?php bp_messages_content_value(); ?></textarea>
	</label>

	<input type="hidden" name="send_to_usernames" id="send-to-usernames" value="<?php bp_message_get_recipient_usernames(); ?>" class="<?php bp_message_get_recipient_usernames(); ?>" />

	<?php do_action( 'bp_after_messages_compose_content' ); ?>

	<div class="submit padding">
		<input type="submit" class="button button-primary button-block" value="<?php esc_attr_e( "Send Message", 'appp_ion' ); ?>" name="send" id="send" />
	</div>

	<?php wp_nonce_field( 'messages_send_message' ); ?>
</form>

<script type="text/javascript">
	document.getElementById("send-to-input").focus();
</script>