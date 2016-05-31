<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Skacero Pro
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class('container'); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'skacero-pro' ); ?></a>
	

	<header id="masthead" class="site-header" role="banner">
				<!--MOBILE MENU-->
				<div id="mobile-menu-wrapper" class="logged-in">
					<a href="javascript:void(0); " id="sidemenu_hide" class="sideviewtoggle"><i class="fa fa-arrow-left"></i> <?php esc_html_e( 'Hide Menu', 'skacero-pro' ); ?> <i class="fa fa-bars"></i></a>
					
					<nav id="navigation" class="clearfix">
						<div id="mobile-menu" class="mobile-menu">
							<?php wp_nav_menu( array( 
								'theme_location' => 'mobile-menu' ) ); ?>
						</div>
					</nav>							
				</div><!--#MOBILE-menu-wrapper-->
		
			<div class="topbar <?php if ( get_theme_mod('header_image') != ''){ echo 'site-header-image'; } ?>">
				<?php if (get_theme_mod('top_bar_menu') !='off'): ?>
					<nav id="site-navigation" class="topbar-menu main-navigation secondary-navigation" role="navigation">
						<?php wp_nav_menu( array( 
						'theme_location' => 'topbar' ) ); ?>
						
					<div class="search-bar float-r">
						<?php get_search_form(); ?>
					</div>
						
					</nav>
				<?php endif; ?>
			</div>
		
		
		<div class="<?php if ( get_theme_mod('header_image') == ''){ echo 'site-branding'; } ?>">
		<?php if ( get_theme_mod('header_image') == '' ): ?>
		
			<div class="logo-box float-l">
				<?php if ( get_theme_mod('custom_logo') ) {?>
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="<?php bloginfo( 'name' ); ?>">
					<img src="<?php echo esc_url(get_theme_mod('custom_logo'))?>">
					</a>
				</div>
				<?php } else { ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php if ( get_theme_mod('site_description') != 'off' ) {?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php } ?>
				<?php } ?>
				
			</div>
			<div class="float-r">
				<?php skacero_pro_header_ads_area(); ?>
			</div>
			
			<div class="clearfix"></div>
		<?php endif; ?> <!--./End If Header Image-->
		
		<?php if ( get_theme_mod('header_image') ): ?>
			<div class="header-image">
				<a href="<?php echo home_url('/'); ?>" rel="home">
					<img class="site-image" src="<?php echo esc_url(get_theme_mod('header_image')); ?>" alt="<?php get_bloginfo('name'); ?>">
				</a>
			</div>
		<?php endif; ?> <!--./End If Header Image-->
		</div><!-- .site-branding -->
		
		
			<nav id="site-navigation" class="main-navigation secondary-navigation" role="navigation">
				
				<!--MOBILE MENU-->
					<div id="sideviewtoggle">
						<div class="container clearfix"> 
							<a href="javascript:void(0); " id="sidemenu_show" class="sideviewtoggle"><i class="fa fa-bars"></i> <?php esc_html_e( 'Menu', 'skacero-pro' ); ?></a>  
						</div><!--.container-->
					</div><!--#sideviewtoggle--> 
				<?php wp_nav_menu( array( 
				'theme_location' => 'primary', 
				 ) ); ?>
				 
				
			</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->

<div id="content" class="site-content">
