<?php
/*
 * Author: AppPresser Team
 * Author URI: http://apppresser.com
 * License: GPLv2
 */

class Swiper_CPT {

	// A single instance of this class.
	public static $instance    = null;

	/**
	 * Creates or returns an instance of this class.
	 * @since  1.0.0
	 */
	public static function run() {
		if ( self::$instance === null )
			self::$instance = new self();

		return self::$instance;
	}

	/**
	 * @since 1.0.0
	 */
	public function __construct() {
		// Add custom post type
		add_action( 'init', array( $this, 'appp_swiper_cpt' ) );
		// Add new update messages
		add_filter( 'post_updated_messages', array( $this, 'appp_updated_messages' ) );
		// TODO Add custom icon
		//add_action( 'admin_head', array( $this, 'swiper_cpt_icon' ) );
	}

	/* Create a custom post type - swiper
	-----------------------------------------------*/

	function appp_swiper_cpt() {

		$labels = array(
			'name'               => _x( 'Slides', 'post type general name', 'apppresser-swipers' ),
			'singular_name'      => _x( 'Slide', 'post type singular name', 'apppresser-swipers' ),
			'add_new'            => _x( 'Add New', 'slide', 'apppresser-swipers' ),
			'add_new_item'       => __( 'Add New Slide', 'apppresser-swipers' ),
			'edit_item'          => __( 'Edit Slide', 'apppresser-swipers' ),
			'new_item'           => __( 'New Slide', 'apppresser-swipers' ),
			'all_items'          => __( 'All Slides', 'apppresser-swipers' ),
			'view_item'          => __( 'View Slide', 'apppresser-swipers' ),
			'search_items'       => __( 'Search Slides', 'apppresser-swipers' ),
			'not_found'          => __( 'No items found', 'apppresser-swipers' ),
			'not_found_in_trash' => __( 'No items found in the Trash', 'apppresser-swipers' ),
			'parent_item_colon'  => '',
			'menu_name'          => __('Slides', 'apppresser-swipers'),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => __('Items and item specific data', 'apppresser-swipers'),
			'public'        => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'comments' ),
			'has_archive'   => true,
			'taxonomies'    => array( 'category' )
		);

		register_post_type( 'swiper', $args );
	}

	/* Change update message text */

	function appp_updated_messages( $messages ) {
		global $post, $post_ID;
		$messages['swiper'] = array(
			0 => '',
			1 => sprintf( __('Slide updated.', ' <a href="%s">View Slide</a>', 'apppresser-swipers'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.', 'apppresser-swipers'),
			3 => __('Custom field deleted.', 'apppresser-swipers'),
			4 => __('Slide updated.', 'apppresser-swipers'),
			5 => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s', 'apppresser-swipers'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Slide published. <a href="%s">View Slide</a>', 'apppresser-swipers'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Slide saved.', 'apppresser-swipers'),
			8 => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview Slide</a>', 'apppresser-swipers'), esc_url( add_query_arg( 'preview', 'true', esc_url( get_permalink($post_ID) ) ) ) ),
			9 => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slide</a>', 'apppresser-swipers'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview Slide</a>', 'apppresser-swipers'), esc_url( add_query_arg( 'preview', 'true', esc_url( get_permalink($post_ID) ) ) ) ),
		);
		return $messages;
	}

	/* Add CPT icon */

	function swiper_cpt_icon() {
	    ?>
	    <style type="text/css" media="screen">
	        #menu-posts-module .wp-menu-image {
	            background: url(<?php echo plugins_url( '../images/icon.png' , __FILE__ ); ?>) no-repeat 6px 7px !important;
	            background-size: 16px 16px !important;
	        }
			/* #menu-posts-module:hover .wp-menu-image, #menu-posts-module.wp-has-current-submenu .wp-menu-image {
	            background-position:6px 7px!important;
	        } */
	    </style>
	<?php }

}
