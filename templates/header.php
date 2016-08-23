<?php
	// Haitham replaced the original header.php file with this one to to make the navbar a bootstrap navbar.
  // This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
  // somewhere in your theme.
?>

<header class="banner navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container-fluid">
    <div class="navbar-header">
    <div class="hamberger-menu-btn">  <button type="button" class="navbar-toggle collapsed btn btn-link" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
  	  <div class="hamburger-nav-address">
  		  195 Chrystie St.
  	  </div>
      </button>
  </div>

      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">

		  <?php //bloginfo('name'); // we need to change the following logo image when switching from mobile to desktop ?>
		  <img src="<?= get_template_directory_uri() . '/assets/images/logo-sm.png'; ?>">

	  </a>
    </div>
 <div class= "menu-container">
     <nav class="collapse navbar-collapse" role="navigation">  <!-- added navbar collapse back on because it is the navbar itself :) -->
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
      endif;
      ?>
    </nav>
</div>
  </div>
  <div class="desktop-nav-address hidden-xs">
  	195 Chrystie Street, New York
  </div>
</header>
