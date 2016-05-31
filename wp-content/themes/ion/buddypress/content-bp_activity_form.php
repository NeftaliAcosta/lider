<div id="activity-form-modal" class="padding">
	<?php if ( function_exists( 'bp_activity_post_form_action' ) ) : ?>
	<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-form-in-modal" name="whats-new-form" role="complementary">

		<div id="whats-new-avatar">
			<a href="<?php echo bp_loggedin_user_domain(); ?>">
				<?php bp_loggedin_user_avatar( 'width=' . bp_core_avatar_thumb_width() . '&height=' . bp_core_avatar_thumb_height() ); ?>
			</a>

			<p class="activity-greeting"><?php if ( bp_is_group() )
				printf( __( "What's new in %s, %s?", 'appp_ion' ), bp_get_group_name(), bp_get_user_firstname() );
			else
				printf( __( "What's new, %s?", 'appp_ion' ), bp_get_user_firstname() );
			?></p>
		</div>

		<div id="whats-new-content">
			<textarea name="whats-new" id="whats-new" class="needsclick" cols="50" rows="10"><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_textarea( $_GET['r'] ); ?> <?php endif; ?></textarea>
		</div>

		<div id="whats-new-options">
			<div id="whats-new-submit">

				<button type="button" name="aw-whats-new-submit" id="aw-whats-new-submit" class="button  button-primary"><?php esc_attr_e( ' Post Update', 'appp_ion' ); ?></button>

			</div>

			<div id="activity_add_media">
				<?php if(function_exists('appp_camera') && 'on' === appp_get_setting( 'appcam_appbuddy' ) ) : ?>
					<button type="button" id="attach-photo" data-nonce="<?php echo  wp_create_nonce( 'apppcamera-nonce' ); ?>" class="button icon-left ion-ios-camera button-secondary"> <?php _e('Attach Photo', 'appp_ion'); ?></button>
					
				<?php endif; ?>
			</div>

			<div id="image-status"></div>

		</div><!-- #whats-new-options -->

		<?php if ( bp_is_group_home() ) : ?>
			<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
			<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

		<?php endif; ?>
		<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
		<?php do_action( 'appbuddy_after_activity_post_form' ); ?>

	</form><!-- #whats-new-form -->
	<?php else:

		// bp_activity_post_form_action() is not defined: 

		// Enable BuddyPress Activity Streams

		if( current_user_can( 'manage_options' ) ) {
			$msg = __('To use the activity form you need to enable BuddyPress Activity Streams', 'ion');
		} else {
			$msg = __('Posting activity has been disabled', 'ion');
		}
	?>
		<b><?php echo $msg ?></b>
	<?php endif; ?>
</div><!-- #activity-form-modal -->

<!-- Take/upload photo action sheet -->
<div id="attach-image-sheet" class="action-sheet-backdrop hide appbuddy">
	<div class="action-sheet-wrapper action-sheet-up">
		<div class="action-sheet action-sheet-has-icons">
			<div class="action-sheet-group action-sheet-options">
				<div class="action-sheet-title"><?php _e( 'Choose an Image', 'appp_ion' ); ?></div>
				<?php if( function_exists('appp_camera') ) : ?>
				<?php appp_camera( array('action' => 'appbuddy', 'description' => '') ); ?>
				<?php endif; ?>
			</div>
			<div class="action-sheet-group">
				<button type="button" class="button action-sheet-option destructive"><?php _e( 'Cancel', 'appp_ion' ); ?></button>
			</div>
		</div>
	</div>
</div>
