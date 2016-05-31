<?php

/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_activity_entry' ); ?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>">
	<div class="activity-avatar">
		<a class="ajaxify" href="<?php bp_activity_user_link(); ?>">

			<?php bp_activity_avatar(); ?>

		</a>
	</div>

	<div class="activity-content">

		<div class="activity-header">

			<?php bp_activity_action(); ?>

		</div>

		<?php if ( bp_activity_has_content() ) : ?>

			<div class="activity-inner">

				<?php bp_activity_content_body(); ?>

			</div>

		<?php endif; ?>

		<?php do_action( 'bp_activity_entry_content' ); ?>

		<div class="activity-meta">

			<?php if ( bp_get_activity_type() == 'activity_comment' ) : ?>

				<a href="<?php bp_activity_thread_permalink(); ?>" class="bp-secondary-action ajaxify" title="<?php esc_attr_e( 'View Conversation', 'appp_ion' ); ?>"><?php _e( 'View Conversation', 'appp_ion' ); ?></a>

			<?php endif; ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php if ( bp_activity_can_comment() ) : ?>

					<a href="<?php bp_activity_thread_permalink(); ?>" class="acomment-reply bp-primary-action ajaxify" id="acomment-comment-<?php bp_activity_id(); ?>"><i class="icon ion-ios-chatbubble-outline"><span class="comment-count"><?php if (bp_activity_get_comment_count() > 0 ) echo bp_activity_get_comment_count(); ?></span></i></a>

				<?php endif; ?>

				<?php if ( bp_activity_can_favorite() ) : ?>

					<?php if ( !bp_get_activity_is_favorite() ) : ?>

						<a href="<?php bp_activity_favorite_link(); ?>" class="fav bp-secondary-action ajaxify" title="<?php esc_attr_e( 'Mark as Favorite', 'appp_ion' ); ?>"><i class="icon ion-ios-star-outline"></i></a>

					<?php else : ?>

						<a href="<?php bp_activity_unfavorite_link(); ?>" class="unfav bp-secondary-action ajaxify" title="<?php esc_attr_e( 'Remove Favorite', 'appp_ion' ); ?>"><i class="icon ion-ios-star"></i></a>

					<?php endif; ?>

				<?php endif; ?>

				<?php if ( bp_activity_user_can_delete() ) bp_activity_delete_link(); ?>

				<?php do_action( 'bp_activity_entry_meta' ); ?>

			<?php endif; ?>

		</div>

	</div>

</li>

<?php

/**
 * Fires after the display of an activity entry.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_activity_entry' ); ?>
