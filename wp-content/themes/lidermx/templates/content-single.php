<div class="container"><br>
	<div class="row">
		<div class="col-md-8 mypad">

			<?php while (have_posts()) : the_post(); ?>
			  <article <?php post_class(); ?>>
				<header>
				  <img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" class="img-responsive">
				  <h1 class="entry-title"><?php the_title(); ?></h1>
				  <i class="fa fa-calendar" aria-hidden="true"> Publicado el <?php echo get_the_date(); ?></i>
				</header>
				<div class="entry-content">
				  <?php the_content(); ?>
				</div>
				<footer>
				  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
				</footer>
				<?php //comments_template('/templates/comments.php'); ?>
				
			  </article>
			<?php endwhile; ?>
		</div>
		
		<div class="col-md-4"> 
			<?php dynamic_sidebar('sidebar-primary'); ?>

		</div>
	</div>
</div>
