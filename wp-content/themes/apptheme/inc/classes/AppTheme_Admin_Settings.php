<?php

class AppTheme_Admin_Settings {

	public static $menu_slug  = 'about_apppresser_mobile';
	public static $page_slug  = 'apppresser_settings';
	public static $about_slug = 'about_apppresser_mobile';
	public static $menu_title = '';
	public static $dir_path   = '';

	public function __construct() {
		self::$dir_path = trailingslashit( dirname( dirname( __DIR__ ) ) );
	}

	/**
	 * Creates an admin menu: main menu or submenu based on 
	 * whether or not AppPresser core plugin is active
	 * @since 2.0.0
	 */
	public function plugin_menu() {

		// Create main menu or settings page

		self::$menu_title = __('AppPresser Mobile', 'apptheme');

		$page_title = self::$menu_title;
		$capability = 'manage_options';
		$menu_slug = self::$menu_slug;
		$function = array( $this, 'about_apppresser_mobile' );

		// If AppPresser core is active add as submenu
		if( class_exists('AppPresser') ) {
			$parent_slug = AppPresser_Admin_Settings::$page_slug;
			$menu_title  = self::$menu_title;
			self::$menu_slug = add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
			// self::$menu_slug = add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		} else {
			$menu_title = __( 'AppPresser Mobile', 'apptheme' );
			$menu_slug = self::$menu_slug;
			self::$menu_slug = add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
			// self::$menu_slug = add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		}
	}

	public function hooks() {
		return array(
			array( 'admin_menu', 'plugin_menu', 9 ),
			array( 'admin_head', 'icon_styles' ),
			array( 'after_switch_theme', 'activation_redirect' )
		);
	}

	public function activation_redirect() {

		global $pagenow;

		if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
			header( 'Location: '.admin_url().'admin.php?page='.self::$menu_slug);
		}
	}

	/**
	 * Include css for modifying menu icon
	 * @since  1.0.0
	 */
	function icon_styles() {
		require_once( self::$dir_path . 'css/icon-styles.php' );
	}

	public function about_apppresser_mobile() {

		$class = self::$about_slug;
		$class .= ( class_exists('AppPresser') && AppPresser::is_mp6() ) ? ' mp6' : '';

		?>
		<style type="text/css">
			.apptheme img {
			    max-width: 100%;
			    height: auto;
			}
			.apptheme .full-width {
				width:100%;
				clear:both;
			}
			.apptheme .entry-content {
				max-width: 900px;
			}
			.apptheme .one-half {
				width: 40%;
				position: relative;
				float: left;
				margin-right: 4%;
				margin-bottom: 1.25rem;
			}

			.apptheme .last-col {
			    clear: right;
			    margin-right: 0;
			}
		</style>
		<div class="wrap <?php echo $class; ?> apptheme">
			<h1><?php echo self::$menu_title ?></h1>
			<div class="entry-content">
				<div itemprop="description">
					<p>The AppPresser Mobile theme is a mobile-first theme designed with touch devices in mind. This theme works best for phones and tablets, it features an app-style left menu, toolbar, list-style post display, and more.</p>
					<div class="full-width">
						The Pro version of this theme can be used in a native app for iOS and Android using AppPresser! 
						<strong><a href="https://apppresser.com/extensions/apptheme/" target="_blank">Learn More</a></strong>
					</div>
					<div class="one-half">
						<p><img class="alignnone size-full wp-image-31" src="https://apppresser.com/wp-content/uploads/2013/11/layout-528.jpg" alt="App Layout" width="1056" height="600" srcset="https://apppresser.com/wp-content/uploads/2013/11/layout-528-300x170.jpg 300w, https://apppresser.com/wp-content/uploads/2013/11/layout-528-1024x581.jpg 1024w, https://apppresser.com/wp-content/uploads/2013/11/layout-528.jpg 1056w" sizes="(max-width: 1056px) 100vw, 1056px"></p>
						<h3>App Styling</h3>
						<p>The AppPresser Mobile theme has an app-style layout and it follows mobile app design conventions to assure it looks and works great on most devices. The header, menus, icons, page layouts, etc. are all designed specifically for an app environment.</p>
						<p>The layout adapts responsively to a tablet and mobile phone view (and everything in between) so it always looks great.</p>
					</div>
					<div class="one-half last-col">
						<p><img class="alignnone size-full wp-image-32" src="http://appp.wpengine.com/wp-content/uploads/2013/11/ajax-528.jpg" alt="Ajax in WordPress" width="528" height="300" srcset="https://apppresser.com/wp-content/uploads/2013/11/ajax-528-300x170.jpg 300w, https://apppresser.com/wp-content/uploads/2013/11/ajax-528-1024x581.jpg 1024w, https://apppresser.com/wp-content/uploads/2013/11/ajax-528.jpg 1056w" sizes="(max-width: 528px) 100vw, 528px"></p>
						<h3>Fewer page refreshes</h3>
						<p>AppTheme, the Pro version of AppPresser Mobile, uses AJAX to insert your content without page refreshes, so your visitors stay immersed in your content.</p>
						<p>The Pro version can also be used in native iOS and Android apps using AppPresser <strong><a href="https://apppresser.com/extensions/apptheme/" target="_blank">Learn More</a></strong></p>
					</div>
					<div class="full-width">
						<h2>How it's built</h2>
						<p>The AppPresser Mobile theme is easy to work with, because it's built with frameworks you might already be familiar with.</p>
						<p>The foundation is the <a href="http://underscores.me/">underscores</a> theme, with <a title="Twitter Bootstrap" href="http://getbootstrap.com/">Twitter Bootstrap</a>, and <a title="Font Awesome" href="http://fontawesome.io/">Font Awesome</a>. This gives you a solid codebase that is familiar, fully documented, and easy to work with.</p>
						<p>Use font icons in your menus and buttons, along with Twitter bootstrap components to make it easier to create the look of your app.</p>
					</div>
				</div>
			</div>
		</div>
	<?php }
}
