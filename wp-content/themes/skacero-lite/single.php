<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Skacero Pro
 */

get_header(); ?>

<div id="primary" class="">
		<main id="main" class="col-md-8 primary" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>
				
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sidebar-box">
			<?php get_sidebar(); ?>
		</div>

</div><!-- #primary -->
<?php get_footer(); ?>
