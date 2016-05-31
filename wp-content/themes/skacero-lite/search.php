<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Skacero Pro
 */

get_header(); ?>

<div id="primary" class="">
	<main id="main" class="col-md-8" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'skacero-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 content-box">
				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>
			</div>
			<?php endwhile; ?>

			<?php skacero_pro_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #main -->
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 secondary">
			<?php get_sidebar(); ?>
		</div>

</div><!-- #primary -->
<?php get_footer(); ?>
