<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skacero Pro
 */

get_header();

//Column Classes
//$homebar6= 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
$homebar8 = 'col-lg-8 col-md-8 col-sm-6 col-xs-12';
$col = 'col';
//$col2 = 'col-2';
 ?>
 
<?php if (get_theme_mod('home_page_slider_and_post_columns') !='off') :?>
  <div class="front-page-top-section">
      <div class="widget_slider_area">
         <?php // Display the Home Page Slider Widget
         if( is_active_sidebar( 'skacero-pro-front-slider-area' ) ) {
            if ( !dynamic_sidebar( 'skacero-pro-front-slider-area' ) ):
            endif;
         }
         ?>
      </div>

      <div class="widget_beside_slider">
         <?php // Display the Home Page Column Widget
         if( is_active_sidebar( 'skacero-pro-front-column-area' ) ) {
            if ( !dynamic_sidebar( 'skacero-pro-front-column-area' ) ):
            endif;
         }
         ?>
      </div>
   </div>
<?php endif; ?>


<div id="primary" class="primary-content">

	<main id="main" class="<?php if ( get_theme_mod('home_page_sidebar') == 'on' ) { echo $homebar8 ; } else { echo 'col-md-12' ; } ?>" role="main">
	
	<div id="<?php if ( get_theme_mod('home_page_sidebar') == 'on' ) { echo $col ; } else { echo $col2 ; } ?>" class="card-columns">

		<?php if ( have_posts() ) : ?>
		
	

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
				
				
			<div class="content-box">

					<?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
					?>
			
			</div>
				<?php endwhile; ?>

				<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>
	
		<?php endif; ?>
	</div>	
	<div class="skacero_pro_pagination">
		<?php skacero_pro_pagination(); ?>
	</div>
	</main><!-- #main -->
	<?php if ( get_theme_mod('home_page_sidebar') == 'on' ) { ?>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sidebar-box home-sidebar-box">
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>

</div><!-- #primary -->


<?php get_footer(); ?>
