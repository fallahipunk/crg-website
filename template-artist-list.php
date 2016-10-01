<?php
/**
 * Template Name: Artist List Template
 */
?>

	<div class = "artist-list">


<?php if ( have_posts() ) { /* Query and display the parent. */
 while ( have_posts() ) {
	 the_post();
	 the_content();
 }
}
?>
   <?php
   $my_wp_query = new WP_Query();
   $all_wp_pages = $my_wp_query->query(array(
	   										'post_type' => 'page',
											'orderby'   => 'meta_value',
											'meta_key'  => 'artist_lastname',
											'order' => 'ASC',
											'posts_per_page' => -1));
   $artist_list = get_page_children(25, $all_wp_pages);
   $thumb_size = array("h" => 120, "w" => 160);
    foreach($artist_list as $artist){
		   	?>
		
			<div   class="col-xs-6 col-md-4 col-lg-3">
				
				<a href="<?php echo get_page_link( $artist->ID ); ?>">
					<div class = "artist-thumb">
					 <?php 
					 if (get_image('image',1,1,1,$artist->ID)){
					 echo get_image('image',1,1,1,$artist->ID,$thumb_size); 
					 }
					 
					 
					 ?>
				 	</div>
		<div class="artist-link">
			<br>
			<?php echo $artist->post_title; ?>
		</a>
		</div>
	</div>
	  <?php
	}
   
 	?>

 
   
 
</div> 
