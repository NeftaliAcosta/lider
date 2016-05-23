<header class="banner">
  <div class="container topbar">
	<div class="top2">
		<nav class="nav-primary">
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
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php /*bloginfo('name'); */?>
		<img src="<?php bloginfo( 'template_url' ); ?>/img/logo.png" class="responsive">
	</a>
	
      
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
</header>
