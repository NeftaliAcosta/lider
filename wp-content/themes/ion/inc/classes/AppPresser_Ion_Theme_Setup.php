<?php
// Allows child-themes to override this class
if ( ! class_exists( 'AppPresser_Ion_Theme_Setup' ) ) {
	class AppPresser_Ion_Theme_Setup {

		/**
		 * The option key for `appp_get_setting`
		 */
		const APPP_KEY   = 'appp_ion_key';

		/**
		 * The name of the child theme as it's registered in apppresser.com/extensions
		 */
		const THEME_NAME = 'Ion Theme';

		/**
		 * The folder name for this theme
		 */
		const THEME_SLUG = 'ion';

		/**
		 * The current version of this theme
		 */
		const VERSION    = '1.2.4';
	
	}
}