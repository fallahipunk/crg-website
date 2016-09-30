<?php
/**
 * Template Name: Custom Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <div class="page-header">
  <?php get_template_part('templates/page', 'header'); ?>
  </div>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
