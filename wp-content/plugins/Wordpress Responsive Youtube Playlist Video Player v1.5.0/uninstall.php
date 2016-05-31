<?php

//Deletes created database tables & options

if(defined('WP_UNINSTALL_PLUGIN') ){

	// Delete DB Entries
	delete_option('ytp-db-options-custom-css');
	delete_option('ytp-db-options');
	delete_option('ytp-db-version');

}

