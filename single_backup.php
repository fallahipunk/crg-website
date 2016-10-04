<?php
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
?>


<? if (have_posts()) : while (have_posts()) : the_post();


the_post_thumbnail();
echo get_post(get_post_thumbnail_id())->post_excerpt; ?>

<!-- <?
       $images = get_posts(
           array(
               'post_type'      => 'attachment',
               'post_mime_type' => 'image',
               'post_parent'    => $post->ID,
               'post_caption'   => $post->post_excerpt,
               'posts_per_page' => 1, /* Save memory, only need one */
           )
       );

      foreach ($images as $image);
      $attachment_meta = wp_get_attachment($image->ID);
      echo $image->ID
   ?> -->


  <!-- <h1><? the_title();?></h1> -->
  <!-- <?       echo $image->post_excerpt;
  ?><img src="<?$attachment_meta['src'];?>">
<?  echo $attachment;
  ?> -->

  <? $args = array( 'post_type' => 'attachment', 'numberposts' => 1, 'post_status' =>'any', 'post_parent' => $post->ID );
         $attachments = get_posts($args);
         if ($attachments) {
                 foreach ( $attachments as $attachment ) {
			echo apply_filters( 'the_title' , $attachment->post_title );
			echo apply_filters( 'the_excerpt' , $attachment->post_excerpt );
			the_attachment_link( $attachment->ID , true );
                  }
        } ?>

<? endwhile; endif; ?>
