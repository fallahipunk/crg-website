<?php use Roots\Sage\Titles; ?>

<?php if (is_front_page()) : ?>
<?php else: ?>
  <h1><?= Titles\title(); ?></h1>
<?php endif; ?>
