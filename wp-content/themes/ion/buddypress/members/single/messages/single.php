<div id="message-thread" role="main" class="list">

	<?php do_action( 'bp_before_message_thread_content' ); ?>

	<?php if ( bp_thread_has_messages() ) : ?>

		<div class="item">

			<h2 id="message-subject"><?php bp_the_thread_subject(); ?></h2>

			<p id="message-recipients">
				<span class="highlight">

					<?php if ( !bp_get_the_thread_recipients() ) : ?>

						<?php _e( 'You are alone in this conversation.', 'appp_ion' ); ?>

					<?php else : ?>

						<?php printf( __( 'Conversation between %s and you.', 'appp_ion' ), bp_get_the_thread_recipients() ); ?>

					<?php endif; ?>

				</span>

				<a class="confirm" href="<?php bp_the_thread_delete_link(); ?>" title="<?php esc_attr_e( "Delete Message", "appbuddy" ); ?>"><?php _e( 'Delete', 'appp_ion' ); ?></a> &nbsp;
			</p>

		</div><!-- .item -->

		<?php do_action( 'bp_before_message_thread_list' ); ?>

		<?php while ( bp_thread_messages() ) : bp_thread_the_message(); ?>

			<div class="message-box item <?php bp_the_thread_message_alt_class(); ?>">

				<?php do_action( 'bp_before_message_content' ); ?>

				<div class="avatar"><?php bp_the_thread_message_sender_avatar( 'type=thumb&width=30&height=30' ); ?></div>

				<div class="message-content <?php bp_the_thread_message_sender_class(); ?>">

				<div class="message-metadata">

					<?php do_action( 'bp_before_message_meta' ); ?>

					<?php if ( bp_get_the_thread_message_sender_link() ) : ?>

						<strong><a href="<?php bp_the_thread_message_sender_link(); ?>" title="<?php bp_the_thread_message_sender_name(); ?>"><?php bp_the_thread_message_sender_name(); ?></a></strong>

					<?php else : ?>

						<strong><?php bp_the_thread_message_sender_name(); ?></strong>

					<?php endif; ?>

					<span class="activity"><?php bp_the_thread_message_time_since(); ?></span>

					<?php do_action( 'bp_after_message_meta' ); ?>



					<?php bp_the_thread_message_content(); ?>
					</div><!-- .message-metadata -->

				</div><!-- .message-content -->

				<?php do_action( 'bp_after_message_content' ); ?>

			</div><!-- .message-box -->

		<?php endwhile; ?>

		<?php do_action( 'bp_after_message_thread_list' ); ?>

		<?php do_action( 'bp_before_message_thread_reply' ); ?>

		<form id="send-reply" action="<?php bp_messages_form_action(); ?>" method="post" class="standard-form list">

			<div class="message-box item">

				<div class="message--rply-metadata">

					<?php do_action( 'bp_before_message_meta' ); ?>

					<?php do_action( 'bp_after_message_meta' ); ?>

				</div><!-- .message-metadata -->

				<div class="message-content">

					<?php do_action( 'bp_before_message_reply_box' ); ?>

					<label class="item item-input">

					<textarea placeholder="<?php esc_attr_e( 'Reply...', 'appp_ion' ); ?>" name="content" id="message_content" rows="15" cols="40"></textarea>

					</label>

					<?php do_action( 'bp_after_message_reply_box' ); ?>

					<div class="submit">
						<input class="button button-primary button-block" type="submit" name="send" value="<?php esc_attr_e( 'Send Reply', 'appp_ion' ); ?>" id="send_reply_button"/>
					</div>

					<input type="hidden" id="thread_id" name="thread_id" value="<?php bp_the_thread_id(); ?>" />
					<input type="hidden" id="messages_order" name="messages_order" value="<?php bp_thread_messages_order(); ?>" />
					<?php wp_nonce_field( 'messages_send_message', 'send_message_nonce' ); ?>

				</div><!-- .message-content -->

			</div><!-- .message-box -->

		</form><!-- #send-reply -->

		<?php do_action( 'bp_after_message_thread_reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bp_after_message_thread_content' ); ?>

</div>