<?php

global $post;
global $more;

/* WP query loop for swiper slider */

$defaults = array(
	'posts_per_page' => $number,
	'category_name' => $category,
	'post_type' => $type,
);

$args = apply_filters( 'appp_swiper_query_args', $defaults, $post );

//If they somehow don't return the right type of data, fall back to our default.
if ( !is_array( $args ) || empty( $args ) ) {
	$args = $defaults;
}

// Use only the 'category' taxonomy.  If using category_name in the query args, make sure the current post type has a 'category' taxonomy
if( isset($args['category_name']) && !empty($args['category_name'] ) ) {
	$posttype = get_post_type_object( $args['post_type'] );
	if( $posttype && ( empty($posttype->taxonomies) || !in_array('category', $posttype->taxonomies) ) ) {
		unset($args['category_name']);
	} else {
		if( is_home() )
			$args['post_type'] = array('post','swiper');
	}
} else if( isset($args['category_name']) && empty($args['category_name'] ) ) {
	unset($args['category_name']);
}

$swiper_query = new WP_Query( $args );

// The Loop
if ( $swiper_query->have_posts() ) : ?>
<section id="swiper-<?php echo self::$id_counter; ?>" class="swiper-container swiper-slider swiper-slider-sc">
	<div class="swiper-wrapper">
		<?php while ( $swiper_query->have_posts() ) : $swiper_query->the_post(); 

$more = 0;

?>

		<div class="swiper-slide">
			<?php 

				if ( has_post_thumbnail() ) : 

					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'phone' );
					$full_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'tablet' );
					$thumb_url = $thumb_url[0];
					$full_url  = $full_url[0];
				else:

					$thumb_url = get_site_url() . '/wp-includes/images/blank.gif';
					$full_url  = $thumb_url;
				endif;
			?>
				<a class="ajaxify" href="<?php the_permalink(); ?>">
					<span data-picture data-alt="Slider image">
					    <span data-src="<?php echo $thumb_url; ?>"></span>
					    <span data-src="<?php echo $full_url; ?>" data-media="(min-width: 500px)"></span>
					    <noscript>
					        <img src="<?php echo $thumb_url; ?>" alt="<?php esc_attr_e('Slider image', 'apppresser-swipers'); ?>">
					    </noscript>
					</span>
				</a>

			<?php if ( get_the_title() || get_the_content() ) : ?>
			<div class="swiper-slide-content" data-href="<?php the_permalink(); ?>">
			<?php 

				// Title
				if ( get_the_title() ) : 
					echo apply_filters('slide_title', '<a href="' . get_the_permalink() . '" class="ajaxify"><h3>'. get_the_title() . '</h3></a>' );
				endif; 

				// Content
				echo apply_filters('slide_content', get_the_content() );

				do_action('after_swiper_loop');
			
			?>
			</div>
			<?php endif; ?>
		</div>

		<?php endwhile; ?>
	</div><!-- /.swiper-wrapper -->
	<div class="pagination"></div>
</section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>