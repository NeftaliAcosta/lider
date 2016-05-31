<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skacero Pro
 */

?>
<div class="post-content-box">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-image"><!--Featured Image-->
			<?php if ( has_post_thumbnail() ) : ?>
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('skacero_pro_smallfeatured'); ?></a>
				
			<?php endif; ?>
		</div>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<small><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php skacero_pro_posted_on(); ?></a>
			<span class="float-r"><?php skacero_pro_entry_comments(); ?></span></small>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="post-excerpt">
			<?php
			/* the post excerpts */
				the_excerpt();
			?> 
						
			
	</div>
</article><!-- #post-## -->
</div>