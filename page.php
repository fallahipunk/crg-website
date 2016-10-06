<?php
if (61 == $post->post_parent) {
    include (TEMPLATEPATH . '/template-press.php'); // Name this for your child page template name
} else {
while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
  <?php endwhile;
}; ?>
