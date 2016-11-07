<?php
/**
 * Template Name: Press
 */
?>


	<div class = "press-item">
<?php while (have_posts()) : the_post(); ?>
	<a class="print" href="#" onclick='window.print();'>
		
		<span class="glyphicon glyphicon-print"></span> print</a>
  <div class="press-title">
  <?php get_template_part('templates/page', 'press'); ?>
  </div>
	<div id="press-print">
  <?php get_template_part('templates/content', 'page'); ?>
</div>
<?php endwhile; ?>
</div>
