<article <?php post_class(); ?>>
	<div class = "col-xs-12">
  <header>
    <h4 class="search-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <?php if (get_post_type() === 'post') { get_template_part('templates/entry-meta'); } ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</div>
</article>
