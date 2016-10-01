<?
/* Template Name: Edition */
?>

<? if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container edition-page">
  <div class="row">
  <div class="col-sm-8 col-md-5 col-lg-6 col-md-push-2 col-lg-push-1">
<? echo get_image('image'); ?>
  </div>

  <div class="col-sm-4 col-md-3 col-md-push-2 col-lg-push-1">
  <p class="name"><?  echo get('artist_firstname') ?> <?  echo get('artist_lastname') ?></p>
  <p class="title"><? echo wp_title('') ?></p>
  <? the_content();?>
  </div>
</div>
</div>
<? endwhile; endif; ?>
