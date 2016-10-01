<?
/* Template Name: Publication */
?>

	<? if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container publication-page">
<div class="row">
  <div class="col-sm-8 col-md-5 col-lg-6 col-md-push-2 col-lg-push-1">
  <?=get_image('image');?>
  </div>

  <div class="col-sm-4 col-md-3 col-md-push-2 col-lg-push-1">
  <p><? the_title();?></p>
  <p><? the_content();?></p>
  <? $details = get('details');
  if($details != ''){
  ?>Details:
    <?echo $details;
} else {
}
?>

  <? $publisher = get('publisher');
  if($publisher != ''){
  ?>Publisher:
  <p><? echo $publisher;?></p><?
} else {
}
  ?>

  <? $availability = get('availability');
  if ($availability != ''){
  ?>Availability:
  <? echo $availability;
  } else {
  }
  ?>


  <? $retailer_links = get('retailer_links');
  if ($retailer_links != ''){
  ?>Retailer Links:
  <? echo $retailer_links;
  } else {
  }
  ?>

  <? if (is_array(get_field_duplicate('related_artist'))) :
    ?><p>Related Artists:<br><?
    foreach (get_field_duplicate('related_artist') as $artist) : ?>
    <a href="<?=get_permalink($artist);?>"><?=get_the_title($artist);?></a><br/>
  <? endforeach;
    else :
    echo get('artist_firstname')." ".get('artist_lastname');
?></p><?
  endif;?>
  <p>Inquiries:<br>Inquiries regarding this publication should be directed to <a href="mailto:info@crggallery.com">info@crggallery.com</a>.</p>
  </div>
</div>
</div>
  <? endwhile; endif; ?>
