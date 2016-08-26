<?php // oroginally copied from page.php
	while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php get_template_part('templates/form-newsletter'); // copied the form example from the book, will change it later
 ?>
<?php endwhile; ?>



