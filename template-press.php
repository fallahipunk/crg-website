<?php
/**
 * Template Name: Press
 */
?>


	<div class = "press-item">
<?php while (have_posts()) : the_post(); ?>
	<a class="print" href="#" onclick='jQuery("#press-print").print({stylesheet:"/wp-content/themes/crg-website/dist/styles/print.css"});'><span class="glyphicon glyphicon-print"></span> print</a>
  <div class="press-title">
  <?php get_template_part('templates/page', 'press'); ?>
  </div>
	<div id="press-print">
  <?php get_template_part('templates/content', 'page'); ?>
</div>
<?php endwhile; ?>
</div>
