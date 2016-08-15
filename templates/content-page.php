<?php if (is_front_page()) : ?>
	
	<div class= "front-page-container">
	<?php the_content(); ?>
	</div>

<?php else: ?>
<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
<?php endif; ?>
