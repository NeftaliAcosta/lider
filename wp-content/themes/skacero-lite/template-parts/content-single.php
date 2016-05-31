<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skacero Pro
 */
 
$image_full_featured = get_theme_mod( 'article_image_display', 'image_full_featured' );
$image_smallfeatured = get_theme_mod( 'article_image_display', 'image_smallfeatured' );



?>

<article id="post-<?php the_ID(); ?>" <?php post_class('hentry-content'); ?>>

<?php if ( get_theme_mod('featured_image_hide') != 'off' ) { ?>
	<header class="entry-header">
	
		<?php if (  $image_full_featured && $image_full_featured === 'image_full_featured' ) { ?>
			<div class="post-image"><!--Featured Image-->
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail('big'); ?>
				<?php endif; ?>
			</div>
		
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<div class="entry-meta">
			<?php skacero_pro_post_meta(); ?>
		</div><!-- .entry-meta -->
		<?php } else { ?>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<div class="entry-meta">
			<?php skacero_pro_post_meta(); ?>
		</div><!-- .entry-meta -->
		<?php// if ( $image_smallfeatured && $image_smallfeatured === 'image_smallfeatured' ) { ?>
			<div class="post-image" style="float: left; width: 50%; padding: 30px 10px 5px 0;">		<!--Featured Image-->
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>
			</div>
		<?php } ?>
		
	</header><!-- .entry-header -->
<?php } else { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php skacero_pro_post_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skacero-pro' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-tags">
		<?php skacero_pro_entry_tags(); ?>
	</div><!-- .entry-footer -->
	
	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit This Post', 'skacero-pro' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	
		
	<?php 
		if ( get_theme_mod( 'related_posts' ) != 'off' ) { 
			get_template_part('functions/related-posts'); 
		} 
	?>
	
	<nav class="navigation post-navigation" role="navigation">
		<?php skacero_pro_next_prev_post(); ?>
	</nav><!-- .navigation -->
	
	<?php skacero_pro_author_box(); ?>
</article><!-- #post-## -->

