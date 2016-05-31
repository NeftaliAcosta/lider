<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

register_nav_menus( array(

    'secondary' => 'Secondary Menu'
) );


require_once('wp_bootstrap_navwalker.php');

add_theme_support( 'site-logo' );

$args = array(
    'header-text' => array(
        'site-title',
        'site-description',
    ),
    'size' => 'medium',
);
add_theme_support( 'site-logo', $args );

add_filter('excerpt_length', 'mqw_largo_excerpt');
function mqw_largo_excerpt($largo) {
           return 25;
}

add_filter( "the_excerpt", "add_class_to_excerpt" );
function add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="myexcerpt"', $excerpt);
}



// Cambiar texto de "read more"
function wpdocs_excerpt_more( $more ) {
    return sprintf( '... <br><a class="read-more myButton" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Leer Más...', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


//Funcion para videos de youtube

function shortcode_videoyoutube() {

   
	return '.';
}
add_shortcode('vyoutube', 'shortcode_videoyoutube');


add_filter('vyoutube', 'shortcode_videoyoutube');






