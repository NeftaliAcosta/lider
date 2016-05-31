<?php

/* Carousel loop for woocommerce */
?>
<div class="swiper-wrapper products">

		<?php
			global $post;

			$defaults = array(
				'post_type' => $type,
				'posts_per_page' => $number,
			);
			$args = apply_filters( 'appp_woo_carousel_query_args', $defaults, $post );

			//If they somehow don't return the right type of data, fall back to our default.
			if ( !is_array( $args ) || empty( $args ) ) {
				$args = $defaults;
			}
			//Force this one because of specificity to WooCommerce in this file.
			if ( empty( $args['product_cat'] ) || ! array_key_exists( 'product_cat', $args ) ) {
				$args['product_cat'] = $category;
			}

			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					// Should add back a custom template part
					// woocommerce_get_template_part( 'content', 'product' );

					global $product, $woocommerce_loop;

					// Store loop count we're currently on
					if ( empty( $woocommerce_loop['loop'] ) )
						$woocommerce_loop['loop'] = 0;

					// Store column count for displaying the grid
					if ( empty( $woocommerce_loop['columns'] ) )
						$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

					// Ensure visibility
					if ( ! $product->is_visible() )
						return;

					// Increase loop count
					$woocommerce_loop['loop']++;

					// Extra post classes
					$classes = array();
					if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
						$classes[] = 'first';
					if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
						$classes[] = 'last';
					?>
					<div class="swiper-slide product">

						<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

						<a href="<?php the_permalink(); ?>">

							<?php
								/**
								 * woocommerce_before_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_show_product_loop_sale_flash - 10
								 * @hooked woocommerce_template_loop_product_thumbnail - 10
								 */
								do_action( 'woocommerce_before_shop_loop_item_title' );

							?>

							<h3><?php the_title(); ?></h3>

							<?php
								/**
								 * woocommerce_after_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_template_loop_price - 10
								 */
								do_action( 'woocommerce_after_shop_loop_item_title' );
							?>

						</a>

						<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

					</div>
			<?php

				endwhile;
			} else {
				echo __( 'No products found', 'apppresser-swipers' );
			}
			wp_reset_postdata();
		?>

	</div><!-- .swiper-wrapper -->
