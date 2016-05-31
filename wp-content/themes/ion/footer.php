<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Ion
 */
?>

				</div><!-- #main -->

			</div><!-- #page -->

			<div id="footer-menu">
				<?php

				$footer_menu_classes = 'tabs tabs-icon-top';

				$footer_menu_classes = apply_filters( 'appp_footer_menu_classes', $footer_menu_classes );

				$navargs = array(
					'menu_class'      => 'footer-menu ' . $footer_menu_classes,
					'theme_location' => 'footer-menu',
					'link_before' => '<div class="tab-item">',
					'link_after' => '</div>'
				);
				if( has_nav_menu( 'footer-menu' ) )
					wp_nav_menu( $navargs);
				?>
			</div>

		</div><!-- .menu-content. Left menu should be below. -->

		<div class="menu menu-left menu-layer">
			<div class="bar bar-header">
				<div class="title"></div>
			</div>

			<div class="scroll-content ionic-scroll has-header">

				<div class="scroll">

				<?php appp_left_panel_before(); // Hook for search, user profile, and cart items ?>

				<!-- menu goes here. should be .list > .item -->

				<?php
					$navargs = array(
						'menu_class'      => 'list',
						'theme_location' => 'primary-menu'
					);
					if( has_nav_menu( 'primary-menu' ) )
						wp_nav_menu( $navargs );
					?>
				
				<?php if( is_user_logged_in() ) : ?>
					<div class="item log-out-button"><a class="button button-block button-primary noajax" href="<?php echo wp_logout_url( home_url() ); ?>" title="<?php _e( 'Sign Out', 'appp_ion' ); ?>"><?php _e( 'Sign Out', 'appp_ion' ); ?></a></div>
				<?php else: ?>
					<div class="item log-out-button"><a class="button button-block button-primary noajax io-modal-open" href="#loginModal" title="<?php _e( 'Sign In', 'appp_ion' ); ?>"><?php _e( 'Sign In', 'appp_ion' ); ?></a></div>
				<?php endif; ?>

				</div><!-- .scroll -->

			</div><!-- .scroll-content -->
			
		</div><!-- .menu-left -->

</div><!-- #body-container -->

<?php wp_footer(); ?>

</body>
</html>