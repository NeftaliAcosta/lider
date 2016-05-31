<?php 
/**
 * The template for displaying Related Post.
 *
 * @package Skacero Pro
 */

$related = skacero_pro_related_posts(); 

?>

<?php if ( $related->have_posts() ): ?>

<h3 class="heading">
	<?php _e('You may also like...','skacero-pro'); ?>
</h3>

<div class="related-posts group">
	
	<?php while ( $related->have_posts() ) : $related->the_post(); ?>
	<div class="related post-hover col-sm-4 col-xs-6">
		<article <?php post_class(); ?>>

			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() ): ?>
						<?php the_post_thumbnail('skacero_pro_small'); ?>
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/thumb-medium.png" alt="<?php the_title(); ?>" />
					<?php endif; ?>
				</a>
			</div><!--/.post-thumbnail-->
			
			<div class="related-inner">
				
				<h4 class="post-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h4><!--/.post-title-->
				
				<div class="post-meta group">
				<?php if ( get_theme_mod('related_posts_date') !='off') :?>
					<p class="post-date"><?php skacero_pro_posted_on();?></p>
				<?php endif; ?>
				</div><!--/.post-meta-->
					
			
			</div><!--/.related-inner-->

		</article>
	</div><!--/.related-->
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>

</div><!--/.post-related-->
<?php endif; ?>

<?php wp_reset_query(); ?>
