<?php
/**
 * Template Name: Press
 */
?>


	<div class = "press-item">
<?php while (have_posts()) : the_post(); ?>
  <div class="press-title">
  <?php get_template_part('templates/page', 'header'); ?>
  </div>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
</div>

