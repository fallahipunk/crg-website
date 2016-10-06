<?php
/**
 * Template Name: Press
 */
?>


	<div class = "press-item">
<?php while (have_posts()) : the_post(); ?>
	<a class="print" href="#" onclick='jQuery("#press-print").print({stylesheet:"/wp-content/themes/crg-website/dist/styles/print.css", globalStyles: false,prepend:"<div><h1><b>CRG Gallery</h1></b><small>195 Chrystie Street, New York, NY 10002</small>  |  <small>T – 212 229 2766, F – 212 229 2788</small>  |  <small>info@crggallery.com</small><div><br><h2><? the_title(); ?></h2>"});'><span class="glyphicon glyphicon-print"></span> print</a>
  <div class="press-title">
  <?php get_template_part('templates/page', 'press'); ?>
  </div>
	<div id="press-print">
  <?php get_template_part('templates/content', 'page'); ?>
</div>
<?php endwhile; ?>
</div>
