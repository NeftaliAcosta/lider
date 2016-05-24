<header class="container-fluid banner ">
  <div clas="myshadow">
 
	<div class="mymenu topbar container">
		<nav id="site-navigation" >
								<?php /* Primary navigation */
									wp_nav_menu( array(
									  'menu' => 'Menu Secundario',
									  'depth' => 2,
									  'container' => false,
									  'menu_class' => 'nav navbar-nav ',
									  //Process nav menu using our custom nav walker
									  'walker' => new wp_bootstrap_navwalker())
									);
								?>
		</nav>
		
		
		
		
	</div>
	
	<div class="container">
		<a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php /*bloginfo('name'); */?>
			<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
		</a>
	</div>
		

	<div class="container mymenu	class="topbar-menu main-navigation secondary-navigation" role="navigation">
	<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="#">Brand</a>-->
    </div>
			
		<nav class="nav-primary">
					  
		 <?php
								wp_nav_menu( array(
									'menu'              => 'Menu principal',
									'theme_location'    => 'Menu principal',
									'depth'             => 2,
									'container'         => 'div',
									'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'bs-example-navbar-collapse-1',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker())
								);
			?>
		</nav>
	</div>

  </div>
</header>
