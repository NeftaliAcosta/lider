<?php
/*
 * Author: AppPresser Team
 * Author URI: http://apppresser.com
 * License: GPLv2
 */

	/* TODO:
	1. increment $id automatically
	2. Shortcode not returning content in right place on page, it's always on top
	3. Featured image should automatically crop to 1024x400
	4. Hook up picturefill, then need smaller size for featured image too
	5. Need option to hide page title, so it can just be a big image
	*/

class Swiper_Shortcodes {

	// A single instance of this class.
	public static $instance         = null;
	public static $id_counter       = 0;
	public static $carousel_counter = 0;

	/**
	 * Creates or returns an instance of this class.
	 * @since  1.0.0
	 * @return Swiper_Shortcodes A single instance of this class.
	 */
	public static function run() {
		if ( self::$instance === null )
			self::$instance = new self();

		return self::$instance;
	}

	/**
	 * Setup our class
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		add_action( 'wp_footer', array( $this, 'enqueue_js' ) );
	}

	/**
	 * Register our shortcode
	 * @since 1.0.0
	 */
	public function register_shortcodes(){
	   add_shortcode('swiper', array( $this, 'swiper') );
	   add_shortcode('swiper-carousel', array( $this, 'carousel') );
	}

	/**
	 * Setup shortcode function
	 * @since 1.0.0
	 */

	public function swiper( $atts ) {

		// Attributes $type
		extract( shortcode_atts( array(
			'category' => '', // category_name
			'number' => 8, // posts_per_page
			'type' => 'swiper'
		), $atts ) );

		self::$id_counter++;

		ob_start();
		include 'swiper-loop.php';
		// grab the data from the output buffer and add it to our $content variable
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	public function carousel( $atts ) {

		// Attributes $type
		extract( shortcode_atts( array(
			'type' => 'post', // post_type
			'category' => '', // product_cat (woocommerce only), or category_name
			'number' => 8, // posts_per_page
		), $atts ) );

		self::$carousel_counter++;

		ob_start();
		?>
		<section id="swiper-carousel-<?php echo self::$carousel_counter; ?>" class="swiper-container swiper-carousel swiper-carousel-sc">
			<?php
			if ( $type == 'product' )
				include 'woo-loop.php';
			else
				include 'wp-query-loop.php';
			?>
		</section>
		<?php
		// grab the data from the output buffer and add it to our $content variable
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	public function enqueue_js() {
		// If we never increased the counters, it means the shortcodes weren't added
		if ( ! self::$id_counter && ! self::$carousel_counter )
			return;
		wp_enqueue_script( 'apppresser-swiper' );
	}
}
