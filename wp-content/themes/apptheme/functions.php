<?php
/**
 * This file calls the init.php file, but only
 * if the child theme hasn't called it first.
 *
 * This method allows the child theme to load
 * the framework so it can use the framework
 * components immediately.
 *
 * @package AppPresser Theme
 * @version 1.0.1
 */
require_once( dirname( __FILE__ ) . '/inc/init.php' );
// load customizer options
require_once( dirname( __FILE__ ) . '/inc/customizer.php' );
/**
 * A wrapper for post_class to reduce the number of classes returned for mobile
 * @since 2.3.0
 */
function app_get_post_class( $class = '', $post_id = null ) {
	$limited_post_classes = array('post', 'sticky');
	$reduced_post_classes = array();

	$post_classes = get_post_class( $class, $post_id );

	foreach ( $post_classes as $class ) {
		if( in_array( $class, $limited_post_classes ) ) {
			array_push( $reduced_post_classes, $class );
		}
	}

	return $reduced_post_classes;
}

function app_post_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', app_get_post_class( $class, $post_id ) ) . '"';
}
