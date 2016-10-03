<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h4 class="entry-title"><?php the_title(); ?></h4>
    </header>
	<div class = "col-xs-12">
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
	</div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
