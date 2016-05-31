<?php
/**
 * Template Name: Página Principal
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
 
<?php endwhile; ?>

<div class="container"><br>
	<div class="row">
		<div class="col-md-8 mypad">
			<?php 
				$args= array( 
				'posts_per_page' => 1,
				'cat' => 3 ,
				 );
				 
				$the_query = new WP_Query(  $args ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<img src="<?php echo the_post_thumbnail_url( 'large' ); ?>" class="img-responsive ">
						</a>
						
					<?php 
					endwhile;
						wp_reset_postdata();
					?>
				<br><br>
			<div class="row">
				<?php 
				$args= array( 
				'posts_per_page' => 6,
				'cat' => 33 ,
				 );
				 
				$the_query = new WP_Query(  $args ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					<div clasS="col-xs-12 col-md-6">
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<img src="<?php echo the_post_thumbnail_url( 'large' ); ?>" class="img-responsive mythumbnail">
						</a>
						<?php the_title( '<h4>', '</h4>' ); ?>
						<i class="fa fa-calendar" aria-hidden="true"> Publicado el <?php echo get_the_date(); ?></i>
						<?php the_excerpt(); ?>
					
					</div>
					
					<?php 
					endwhile;
						wp_reset_postdata();
					?>
			</div>
			
			
			
			<br><br>
			<div class="video-container">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/BOHsLzv7shc?list=PL_Jq3-Ye9TpEnx32Y1qKI3D3ppYwPl-LX" frameborder="0" allowfullscreen></iframe>
			</div>
			<!--Imprime el short code creado para los videos-->
			<?php /*echo do_shortcode('[vyoutube]'); */?> 
			<br><br>
			 
	
			
			
			 
		</div>
		<div class="col-md-4"> 
			<?php dynamic_sidebar('sidebar-primary'); ?>

		</div>
		
		
		
		
		
		
		
	</div>
	
		<div class="row">
				<?php
			
				$args= array( 
				'posts_per_page' => 6,
				'cat' => 34 ,
				 );
				 
				$the_query = new WP_Query(  $args ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					<div clasS="col-xs-12 col-md-4 mypost">
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<img src="<?php echo the_post_thumbnail_url( 'large' ); ?>" class="img-responsive mythumbnail">
						</a>
						<?php the_title( '<h4>', '</h4>' ); ?>
						<i class="fa fa-calendar" aria-hidden="true"> Publicado el <?php echo get_the_date(); ?></i>
						<?php the_excerpt(); ?>
					
					</div>
					
					<?php 
					endwhile;
						wp_reset_postdata();
					?>
			</div>
	
	<br>
</div>  <br>
