<?php
if (61 == $post->post_parent) {
    include (TEMPLATEPATH . '/template-press.php'); // Name this for your child page template name
    exit();
} else {
    // Do something else
    // You might want to stick your regular page.php code in here, or alternatively, you could call another template
}; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
