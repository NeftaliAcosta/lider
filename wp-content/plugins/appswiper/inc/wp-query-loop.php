<?php

/* Normal query loop for carousel */

	?>
	<div class="swiper-wrapper ajaxify post-carousel">

	<?php

	global $post;

	$defaults = array(
		'post_type' => $type,
		'posts_per_page' => $number,
		'category_name' => $category
	);
	$args = apply_filters( 'appp_carousel_query_args', $defaults, $post );

	//If they somehow don't return the right type of data, fall back to our default.
	if ( !is_array( $args ) || empty( $args ) ) {
		$args = $defaults;
	}
	$carousel_query = new WP_Query( $args );

	// The Loop
	if ( $carousel_query->have_posts() ) : while ( $carousel_query->have_posts() ) : $carousel_query->the_post();

	?>

	<div class="swiper-slide">

	<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('phone'); ?></a>
	<?php endif; ?>

	<div class="swiper-slide-content">

	<a href="<?php the_permalink(); ?>"><?php 
	$thetitle = get_the_title(); 
	$getlength = strlen($thetitle);
	$thelength = 35;
	echo '<h3 class="carousel-title">';
	echo substr($thetitle, 0, $thelength);
	if ($getlength > $thelength) echo "...";
	echo '</h3>';
	?></a>

	<div class="carousel-excerpt"><?php the_excerpt(); ?></div>

	</div>
	</div>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	</div><!-- /.swiper-wrapper -->
