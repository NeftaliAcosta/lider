<?php
/**
 * AppPresser App Functionality
 *
 * @package Ion
 * @since   0.0.1
 */

/**
 * Theme hooks
 */

// Left panel top, used for search bar, shopping cart, and user profile pic
function appp_left_panel_before() {
	 do_action( 'appp_left_panel_before' );
}

function appp_login_modal_before() {
	 do_action( 'appp_login_modal_before' );
}

function appp_login_modal_after() {
	 do_action( 'appp_login_modal_after' );
}

class AppPresser_App_Functionality {

	public static $errorpath = '../php-error-log.php';

	/**
	 * AppPresser_App_Functionality hooks
	 * @since 1.0.6
	 */
	public function hooks() {
		return array(
			array( 'wp_footer', 'login_modal_template' ),
			array( 'wp_footer', 'comment_modal_template' ),
			array( 'wp_footer', 'appp_lost_password_template' ),
			// Add Search Bar to left panel menu
			array( 'appp_left_panel_before', 'left_panel_search', 20 ),
			// Custom login page styling
			array( 'login_enqueue_scripts', 'custom_login_styles' )
		);
	}

	/**
	 * login modal html markup
	 * @since  0.0.1
	 */
	function login_modal_template() {
		?>
		<aside class="io-modal" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="bar bar-header">
				<div class="title">Login</div>
				<i class="io-modal-close icon ion-close-round"></i>
			</div>
			<div class="io-modal-content has-header">

				<?php appp_login_modal_before();

					if ( !is_user_logged_in() ) {
						_e( $this->get_error_param(), 'appp_ion' );
						echo '<div id="error-message"></div>';
						echo '<h4 class="login-modal-title">' . __( 'Please Login', 'appp_ion' ) . '</h4>';

						wp_login_form();

					} else {
						_e( 'Welcome back!', 'appp_ion' );
					}

					appp_login_modal_after();

					if ( !is_user_logged_in() ) {
						echo '<p><a href="#app-lost-password" class="button button-secondary password-reset-btn io-modal-open">' . __('Lost Password?', 'appp_ion') . '</a></p>';
					}
				?>
			</div>
		</aside>
		<?php
	}

	/**
	 * Modal's html markup
	 * @since  0.0.1
	 */
	function comment_modal_template() {
		?>
		<aside class="io-modal" id="commentModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="bar bar-header">
				<div class="title">Comment</div>
				<i class="io-modal-close icon ion-close-round"></i>
			</div>
			<div class="io-modal-content">

				<h4><?php _e( 'Leave a comment', 'appp_ion' ); ?></h4>

				<div id="comment-status"></div>

				<div class="list">

					<span class="ajax-comment-form-author"><label for="author" class="item item-input"><input id="author" name="author" type="text" size="30" aria-required="true" placeholder="<?php _e( '*Name', 'appp_ion' ); ?>"></label> </span>

					<span class="ajax-comment-form-email"><label for="email" class="item item-input"><input id="email" name="email" type="text" size="30" aria-describedby="email-notes" aria-required="true" placeholder="<?php _e( '*Email', 'appp_ion' ); ?>"></label> </span>

					<span class="ajax-comment-form-url"><label for="url"  class="item item-input"><input id="url" name="url" type="text" value="" size="30" placeholder="<?php _e( 'Website', 'appp_ion' ); ?>"></label></span>

					<span class="ajax-comment-form-comment"><label for="comment" class="item item-input"><textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true" placeholder="<?php _e( 'Comment', 'appp_ion' ); ?>"></textarea></label></span>

					<input type="hidden" id="ajax-comment-parent" value="0">

					<span id="ajax-comment-form-submit">
						<input name="submit" type="submit" id="submit" class="submit button button-primary button-block" value="<?php _e( 'Post Comment', 'appp_ion' ); ?>">
					</span>

				</div>
			</div>
		</aside>
		<?php
	}

	/*
	 * Modal template for lost password
	 */
	function appp_lost_password_template() {

		if( !is_user_logged_in() ) {
		?>
		<aside class="io-modal" id="app-lost-password" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="bar bar-header">
				<div class="title">Lost Password</div>
				<i class="io-modal-close icon ion-close-round"></i>
			</div>
			<div class="io-modal-content">
				<p><?php _e( 'Please enter your email and a password retrieval code will be sent.', 'appp_ion' ) ?></p>
				<p><input type="text" id="lost_email" name="email" value="" placeholder="<?php _e( 'Email', 'appp_ion' ); ?>"/></p>
				<button type="button" id="app-new-password" class="button button-primary"><?php _e( 'Request Code', 'appp_ion' )?></button>
				<?php wp_nonce_field( 'new_password','app_new_password' ); ?>
				<span class="reset-code-rsp"></span>

				<br/><br/>

				<h4><?php _e('New Password', 'appp_ion' )?></h4>

				<p><?php _e('Please enter your code and a new password.', 'appp_ion' ) ?></p>
				<p><input type="text" id="reset-code" name="reset-code" value="" placeholder="<?php _e( 'Code', 'appp_ion' ); ?>"/></p>
				<p><input type="password" id="app-pw" name="app-pw" value="" placeholder="<?php _e( 'New Password', 'appp_ion' ); ?>"/></p>
				<p><input type="password" id="app-pwr" name="app-pwr" value="" placeholder="<?php _e( 'Repeat Password', 'appp_ion' ); ?>"/></p>
				<button type="button" id="app-change-password" class="button button-primary"><?php _e( 'Change Password', 'appp_ion' ); ?></button>
				<span class="psw-msg"></span>

				</div>

		</aside>
		<?php
		}
	}

	public function get_error_param() {

		if ( isset( $_GET['errors'] ) && $_GET['errors'] == 'login_failed' )
			return __('Login Failed! Please try again.', 'appp_ion');

		return '';
	}

	/**
	 * Add Search Bar to left panel menu
	 * @since  0.0.1
	 */
	function left_panel_search() {
		?>
	<div class="list list-inset">
		<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label class="item item-input">
          <i class="icon ion-search placeholder-icon"></i>
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'appp_ion' ); ?>" />
		</label>
		</form>
	</div>
		<?php
	}

	/**
	 * Custom login page styling
	 * @since  0.0.1
	 */
	function custom_login_styles() {
		?>
		<style type="text/css">
		body.login {
			background: #eee;
		}
		.login form {
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
			border: none;
			background: #fff;
		}
		.login form .input, .login input[type="text"] {
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
			border: none;
			background: #eee !important;
		}
		.login form input[type="submit"], #registerform input[type="submit"] {
			width: 50%;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
			border: none;
			background: #278ab7;
			background-image: none;
		}
		#registerform input[type="submit"], #lostpasswordform input[type="submit"] {
			width: 100%;
			clear: both;
		}
		.login form input[type="submit"]:hover, #registerform input[type="submit"]:hover {
			background: #36a1d2;
		}
		.login #nav, .login #backtoblog {
			text-align: center;
		}
		.forgetmenot {
			position: relative;
			top: 5px;
		}
		</style>
		<?php
	}

}