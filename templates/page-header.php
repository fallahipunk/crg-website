<?php use Roots\Sage\Titles; ?>

<?php if (is_front_page()) : ?>
<?php else: ?>
  <h3><?= Titles\title(); ?></h3>
<?php endif; ?>
