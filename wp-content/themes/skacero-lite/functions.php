<?php
/**
 * Skacero Pro functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Skacero Pro
 */
 

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
	// Content width
if ( ! isset( $content_width ) ) {
	$content_width = 740; /* pixels */
}

if ( ! function_exists( 'skacero_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function skacero_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Skacero Pro, use a find and replace
	 * to change 'skacero-pro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'skacero-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'big', 750, 350, array('center','top') ); //Inside Post Featured
	add_image_size( 'skacero_pro_featureslider', 635, 375, array('center','top') ); //Featured Home Page Slides
	add_image_size( 'skacero_pro_featurecolumns', 380, 280, array('center','top') ); //Featured Home Page Column
	add_image_size( 'skacero_pro_smallfeatured', 380, 250, array('center','top') ); //small featured image
	add_image_size( 'skacero_pro_small', 300, 160, array('center','top') ); //small


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'skacero-pro' ),
		'topbar' => esc_html__( 'Top-bar Menu', 'skacero-pro' ),
		'mobile-menu' => esc_html__( 'Mobile Menu', 'skacero-pro' ),
	) );
	

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	//add_theme_support( 'post-formats', array(
		//'aside',
	//	'image',
	//	'video',
	//	'quote',
	//	'link',
	//) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'skacero_pro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // skacero_pro_setup
add_action( 'after_setup_theme', 'skacero_pro_setup' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function skacero_pro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'skacero-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Default Sidebar Widget', 'skacero-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	//Register Header Ads Area
	if (get_theme_mod('header_ads') != 'off'){
		register_sidebar( array(
		'name'          => esc_html__( 'Header Ads', 'skacero-pro'),
		'id'            => 'header-ads-area',
		'description'   => esc_html__( 'This space is reserved for banner ads 728x90, however, any other image with height 90px can be displayed here','skacero-pro'),
		'before_widget' => '<aside id="%1$s" class="%2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) ); 
	}
	
	//Register Footer Ads Area
	if ( get_theme_mod('footer_ads') != 'off' ) {
		register_sidebar(array( 
		'name' 			=> esc_html__( 'Footer Ads','skacero-pro' ),
		'id' 			=> 'footer-ads-area', 
		'description' 	=> esc_html__( 'Footer ads area. Banner size of at least maximum 120px in height', 'skacero-pro'),
		'before_widget' => '<aside id="%1$s" class="%2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		)); 
	}
		
	
	//register_sidebars(4, array('name'=>'Footer %d'));
	
	if ( get_theme_mod( 'footer_column_widgets' ) != 'off' ) {
		
	//register Footer widgets
	if ( get_theme_mod('footer_column_widgets') >= '1' ) { 
		register_sidebar(array( 
		'name' => esc_html__( 'Footer 1', 'skacero-pro'),
		'id' => 'footer-1', 
		'description' => esc_html__( 'Footer Column Widget 1', 'skacero-pro'), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)); }
		
		if ( get_theme_mod('footer_column_widgets') >= '2' ) { 
		register_sidebar(array( 
		'name' => esc_html__( 'Footer 2','skacero-pro'),
		'id' => 'footer-2', 
		'description' => esc_html__( 'Footer Column Widget 2','skacero-pro'), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)); }
		
		if ( get_theme_mod('footer_column_widgets') >= '3' ) { 
		register_sidebar(array( 
		'name' => esc_html__( 'Footer 3','skacero-pro'),
		'id' => 'footer-3', 
		'description' => esc_html__( 'Footer Column Widget 3', 'skacero-pro'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)); }
		
		if ( get_theme_mod('footer_column_widgets') >= '4' ) { 
		register_sidebar(array( 
		'name' => esc_html__( 'Footer 4','skacero-pro'),
		'id' => 'footer-4', 
		'description' => esc_html__( 'Footer Column Widget 4', 'skacero-pro'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)); }
	}
		
	   // registering the Front Page: Slider Area Sidebar
   if (get_theme_mod('home_page_slider_and_post_columns') !='off'){
		register_sidebar( array(
		'name'          => esc_html__( 'Home Page: Slider Area','skacero-pro'),
		'id'            => 'skacero-pro-front-slider-area',
		'description'   => esc_html__( 'This space is reserved SPECIFICALLY for Skacero: Home Page Post Slider widget only','skacero-pro'),
		'before_widget' => '<section id="%1$s" class="%2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
		) ); 
		
		// registering the Front Page: Area beside slider Sidebar
		register_sidebar( array(
		'name'          => esc_html__( 'Home Page: 4 Column Area','skacero-pro'),
		'id'            => 'skacero-pro-front-column-area',
		'description'   => esc_html__( 'This space is reserved SPECIFICALLY for Skacero: Home Page 4 Column widget only. Placed beside the Home Slider','skacero-pro'),
		'before_widget' => '<section id="%1$s" class="%2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
		) ); 
		
		register_widget('skacero_pro_posts_slider_widget');
		register_widget('skacero_pro_homepage_column_widget');
	}
}
add_action( 'widgets_init', 'skacero_pro_widgets_init' );

// Add Editor Style
function skacero_pro_add_editor_styles() {
    add_editor_style( 'custom-style.css' );
}
add_action( 'admin_init', 'skacero_pro_add_editor_styles' );


/**
 * Enqueue scripts and styles.
 */
function skacero_pro_scripts() {
	wp_enqueue_style( 'skacero-pro-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style( 'skacero-pro-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'skacero-pro-font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_script( 'skacero-pro-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js' );	
	
	wp_enqueue_script( 'skacero-pro-mobile-menu', get_template_directory_uri() . '/js/skacero-mobile-menu.js', array('jquery'), true );
	
	//Load Scripts for Slider
	wp_register_script( 'skacero-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );
	
	wp_enqueue_script( 'skacero-slider-js', get_template_directory_uri() . '/js/skacero-slider-setting.js', array( 'skacero-bxslider' ), false, true );
		
	wp_enqueue_script( 'skacero-pro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_style('skacero-pro-oswald-font', 'http://fonts.googleapis.com/css?family=Oswald');
	wp_enqueue_style('skacero-pro-roboto-font', 'http://fonts.googleapis.com/css?family=Roboto');
	
	wp_enqueue_script( 'skacero-pro-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skacero_pro_scripts' );

	
/*-----------------------------------------------------------------------------------*/
/*  Header and Footer Ads Area (banner).
/*-----------------------------------------------------------------------------------*/
//Display header ads area
if ( ! function_exists( 'skacero_pro_header_ads_area' ) ) {
	function skacero_pro_header_ads_area() { ?>
	<div class="header-ads-area">
		<?php dynamic_sidebar( 'header-ads-area' ); ?>
	</div><!-- .header_area -->
	<?php }
}
//Display Footer ads area
if ( ! function_exists( 'skacero_pro_footer_ads_area' ) ) {
	function skacero_pro_footer_ads_area() { ?>
	<div class="above-footer"><!-- #footer-ads -->
		<div class="footer-ads-area">
			<?php dynamic_sidebar( 'footer-ads-area' ); ?>
		</div><!-- .footer_area -->
	</div><!-- .footer_area -->
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/*  Post Meta infos
/*-----------------------------------------------------------------------------------*/
	//Display meta info if enabled.
if ( ! function_exists( 'skacero_pro_post_meta' ) ) {
function skacero_pro_post_meta(){ 
	if ( get_theme_mod('post_meta') != 'off' ) { ?>
		<ul>
			<li><?php skacero_pro_posted_on(); ?></li>
			<li><?php skacero_pro_entry_author(); ?></li>
			<li><?php skacero_pro_entry_category(); ?></li>
			<li><?php skacero_pro_entry_comments(); ?></li>
		</ul>
<?php }
	}
}
/*-----------------------------------------------------------------------------------*/
/*  Single Post Settings
/*-----------------------------------------------------------------------------------*/
//Display Post Next/Prev buttons if enabled.
if ( ! function_exists( 'skacero_pro_next_prev_post' ) ) {
function skacero_pro_next_prev_post() {
	
	 ?>
	<div class="next_prev_post">
		<?php 
			if ( get_theme_mod('next_prev_post') != 'off' ) {
				previous_post_link( '<div class="nav-previous"> %link</div>', '<i class="fa fa-chevron-left"></i>'. __('Previous Post','skacero-pro'));
				next_post_link( '<div class="nav-next">%link</div>', __('Next Post','skacero-pro'). '<i class="fa fa-chevron-right"></i>' );
				} 
		?>
	</div><!-- .next_prev_post -->	
<?php   
	}              
}

//Display Author box if enabled.
if ( ! function_exists( 'skacero_pro_author_box' ) ) {
	function skacero_pro_author_box() {
		if ( get_theme_mod('author_bio') != 'off' && get_the_author_meta( 'description' ) ) { ?>
			<div class="post-author-box">
				<div class="postauthor">
					<h4><?php _e('About The Author', 'skacero-pro'); ?></h4>
					<div class="author-box">
						<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '150' );  } ?>
						<div class="author-box-content">
							<div class="vcard clearfix">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="nofollow" class="fn"><i class="fa fa-user"></i><?php the_author_meta( 'nickname' ); ?></a>
							</div>
							<?php if( get_the_author_meta( 'description' ) ) { ?>
								<p><?php the_author_meta('description') ?></p>
							<?php }?>
						</div>
					</div>
				</div>
			</div>		
	<?php }
	}                 
}

//Footer
if (! function_exists('skacero_pro_copyright')){
	function skacero_pro_copyright(){ ?>
		<div class="foot-bottom">		
			<div class="row">
				<div class="col-md-6 float-l">
				<ul class="copyright">
					<li class="">Av. Paseo de las Palmas, Num. 910</li>
					<li class="">Col. Lomas de Chapultepec, CP. 11000</li>
					<li class="">Delegación Miguel Hidalgo, México DF</li>
					<li class="">Tel. &#40;55&#41; 520 275 39 &#47; &#40;55&#41; 520 262 43</li><li class=""></li>
					<li class="">contacto&#64;revistalidermexico.com</li>
					<li class="">&#169;2016 Revista Líder DF. Todos los derechos reservados.</li>
				<?php if (get_theme_mod('wordpress_powered_by') !='off') { ?>
					<li><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'skacero-pro' ) ); ?>"><?php //printf( esc_html__( 'Powered by %s', 'skacero-pro' ), 'WordPress' ); ?></a>
					</li>
				<?php }?>
				</ul>
				</div>
				
				<?php //skacero_pro_theme_option(); ?>
				
			</div>		
		</div>
	<?php }
}

/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'skacero_pro_related_posts' ) ) {

	function skacero_pro_related_posts() {
		wp_reset_postdata();
		global $post;
		$number_of_post = get_theme_mod('related_posts_number',3);
		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> $number_of_post,
		);
		// Related by categories
		if ( get_theme_mod('related_posts_query') == 'categories' ) {
			
			$cats = get_post_meta($post->ID, 'related-cat', true);
			
			if ( !$cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( get_theme_mod('related_posts_query') == 'tags' ) {
		
			$tags = get_post_meta($post->ID, 'related-tag', true);
			
			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		}
		
		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Excerpt
/*-----------------------------------------------------------------------------------*/
function skacero_pro_new_excerpt_more ($more){
	return '...';
}
add_filter('excerpt_more','skacero_pro_new_excerpt_more');

	// Remove [...] & shortcodes.
function skacero_pro_custom_excerpt( $output ) {
	return preg_replace( '/\[[^\]]*]/', '', $output );
}
add_filter( 'get_the_excerpt', 'skacero_pro_custom_excerpt' );


	//Edit the Excerpt lenth.
function skacero_pro_custom_excerpt_length ($lenth){
	return 20; // Excerpts
}
add_filter( 'excerpt_length', 'skacero_pro_custom_excerpt_length', 999 );

	// Truncate string to x letters/words.

function skacero_pro_truncate( $str, $length = 20, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {
	if ( $units == 'letters' ) {
		if ( mb_strlen( $str ) > $length ) {
			return mb_substr( $str, 0, $length ) . $ellipsis;
			} else {
			return $str;
		}
		} else {
		$words = explode( ' ', $str );
		if ( count( $words ) > $length ) {
			return implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
			} else {
			return $str;
		}
	}
}
// Excerpt for Sidebar Recent and Popular Widget
if ( ! function_exists( 'skacero_pro_excerpt' ) ) {
	function skacero_pro_excerpt( $limit = 40 ) {
		return skacero_pro_truncate( get_the_excerpt(), $limit, 'words' );
	}
}	

	
function skacero_pro_get_thumbnail_url( $size = 'featured' ) {
	global $post;
	if (has_post_thumbnail( $post->ID ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
		return $image[0];
	}
		
	// use first attached image if no featured image was already set.
	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
	if (!empty($images)) {
		$image = reset($images);
		$image_data = wp_get_attachment_image_src( $image->ID, $size );
		return $image_data[0];
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Pagination (for WP 4.0 and earlier versions)
/*-----------------------------------------------------------------------------------*/
if (!function_exists('skacero_pro_pagination')) {
	function skacero_pro_pagination($pages = '', $range = 3) { 
	if ( get_theme_mod('custom_navigation') != 'off'){
		// Get total number of pages
		global $wp_query;
		$total = $wp_query->max_num_pages;
		// Only paginate if we have more than one page
		if ( $total > 1 )  {
			 // Get the current page
			 if ( !$current_page = get_query_var('paged') )
				  $current_page = 1;
					 // Structure of “format” depends on whether we’re using pretty permalinks
					$permalinks = get_option('permalink_structure');
					$format = empty( $permalinks ) ? '&page=%#%' : 'page/%#%/';
					echo paginate_links(array(
						  'base' => get_pagenum_link(1) . '%_%',
						  'format' => $format,
						  'current' => $current_page,
						  'total' => $total,
						  'mid_size' => 2,
						  'type' => 'list'
					));
			}
		} else { 
		the_posts_navigation();
		}
	}
}
/*-----------------------------------------------------------------------------------*/
/*  Mobile Menu Admin Logged in fix
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'skacero_pro_mobile_menu_fix' ) ) {

	function skacero_pro_mobile_menu_fix() {
		if ( is_admin_bar_showing() ) {
			echo '<style type="text/css"> #sidemenu_hide{margin-top:50px;} </style>';
		}
	}
	
}
add_filter( 'wp_head', 'skacero_pro_mobile_menu_fix' );

	/*-----------------------------------------------------------------------------------*/
	/*  Loading theme widgets.
	/*-----------------------------------------------------------------------------------*/
	
	// Add Home Page Slider Posts
	include("functions/widget-homepageslide.php");	
	
	// Add Home Page 4 Column Posts
	include("functions/widget-homepagecolumns.php");	
	
	// Add the Social Widget
	//include("functions/widget-socialicons.php");	
	
	
	// Add Recent Posts Widget
	//include("functions/widget-recentposts.php");

	// Add Popular Posts Widget
	//include("functions/widget-popular.php");
	
	// Add Facebook Like box Widget
	//include("functions/widget-fblikebox.php");

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
