<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skacero Pro
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comment-content" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'skacero-pro' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'skacero-pro' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'skacero-pro' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'skacero-pro' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'skacero-pro' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'skacero-pro' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'skacero-pro' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'skacero-pro' ); ?></p>
	<?php endif; ?>

	<?php global $aria_req; $comments_args = array(
			'title_reply'=> __('Add a Comment','skacero-pro') ,
			'comment_notes_after' => '',
			'label_submit' => __( 'Add Comment', 'skacero-pro' ),
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'fields' => apply_filters( 'comment_form_default_fields',
			array(
			'author' => '<p class="comment-form-author">'
			.'<label style="display:none" for="author">'. __( 'Name', 'skacero-pro' ).'<span class="required"></span></label>'
			.( $req ? '' : '' ).'<input id="author" name="author" type="text" placeholder="'.esc_attr( __('Name','skacero-pro') ).'" value="'.esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' required /></p>',
			'email' => '<p class="comment-form-email"><label style="display:none" for="email">' . esc_attr( __( 'Email', 'skacero-pro' ) ) . '<span class="required"></span></label>'
			.($req ? '' : '' ) . '<input id="email" name="email" type="text" placeholder="'.esc_attr( __('Email','skacero-pro') ).'" value="' . esc_attr(  $commenter['comment_author_email'] ).'" size="30"'.$aria_req.' required /></p>',
			'url' => '<p class="comment-form-url"><label style="display:none" for="url">' . __( 'Website', 'skacero-pro' ).'</label>' . 
			'<input id="url" name="url" type="text" placeholder="'. esc_attr( __('Website','skacero-pro') ).'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" required /></p>'
			) )
			); 
		comment_form($comments_args); 
	?>

</div><!-- #comments -->
