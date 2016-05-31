<div class="container">
	<div class="row">
	
			<div class="col-md-8"><br>
				<?php 
				$args = array ( 
				 'posts_per_page' => 8, 
				  'cat' => $cat,
				);
				$the_query = new WP_Query($args ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				
					<div clasS="col-xs-12 col-md-6 mycat">
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<img src="<?php echo the_post_thumbnail_url( 'large' ); ?>" class="img-responsive mythumbnail">
						</a>
						<?php the_title( '<h4>', '</h4>' ); ?>
						<i class="fa fa-calendar" aria-hidden="true"> Publicado el <?php echo get_the_date(); ?></i>
						<?php the_excerpt(); ?>
					
					</div>
				
					  					
					<?php  
					$var++;	
					endwhile;
						wp_reset_postdata();
					?>
			
			</div>
			<div class="col-md-4"> 
				<?php dynamic_sidebar('sidebar-primary'); ?>
			</div>
			
		
	</div>
</div>