<?php

/*-----------------------------------------------------------------------------------	Plugin Name: Skacero Home Page Slider widget	Description: A widget that displays Post Slides in the Home page.	Version: 1.5-----------------------------------------------------------------------------------*/

 
 class skacero_pro_posts_slider_widget extends WP_Widget {

   function __construct() {
		$widget_ops = array('classname' => 'skacero_featured_slider widget_featured_meta', 'description' => __('Display latest posts of specific category in the Home page. Add to Home Page: Slider Area', 'skacero-pro') );
		parent::__construct('slider-posts', __('Skacero: Home Page Post Slider', 'skacero-pro'), $widget_ops);
	}

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'skacero-pro' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'skacero-pro' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'skacero-pro' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'skacero-pro' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }
      echo $before_widget;
      ?>
      <?php $featured = 'skacero_pro_featureslider'; ?> 
         <div class="widget_slider_area_rotate">
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

            if ( $i == 1 ) { $classes = "single-slide displayblock"; } else { $classes = "single-slide displaynone"; }

            ?>
            <div class="<?php echo $classes; ?>">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure class="slider-featured-image">';
                  $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                  $image .= '</figure>';
                  echo $image;
               } else { ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                     <img src="<?php echo get_template_directory_uri(); ?>/images/slider-featured-image.png">
                  </a>
               <?php }
               ?>
               <div class="slide-content">
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="below-entry-meta">
                     <?php if ( get_theme_mod('post_meta') != 'off' ) { ?>
					 <span class="posted-on">
					 <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>" rel="bookmark">		<?php skacero_pro_posted_on(); ?></a>
					 </span>
					 <?php if ( get_theme_mod('comments_count') != 'off' ) { ?>                 
						<span class="comments"><i class="fa fa-comments"></i><?php comments_popup_link( '0', '1', '%' );?></span>
					 <?php } } ?>
                  </div>
               </div>

            </div>
         <?php
            $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}