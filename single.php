


<? if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="contaiter-fluid">
  <? the_content();?>



  <? $gallery_images = wp_prepare_attachment_for_js(12607);
  echo $gallery_images['caption'];?>
</div>
<? endwhile; endif; ?>
