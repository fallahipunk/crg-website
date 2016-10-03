<?php
/**
 * Template Name: editions & publications 
 */
?>

<?php while (have_posts()) : the_post(); ?>

 
<?php endwhile; ?>

<div class = "col-xs-6 editions" >

<h3>Editions<br><br></h3>

   <?php
   $my_wp_query = new WP_Query();
   $all_wp_pages = $my_wp_query->query(array(
	   										'post_type' => 'page',
											'order' => 'ASC',
											'posts_per_page' => -1));
   $artist_list = get_page_children(27, $all_wp_pages);
   $thumb_size = array("h" => 200, "w" => 160);
    foreach($artist_list as $artist){
		   	?>

		
			<div   class="col-xs-12 col-md-6">
				
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

<div class = "col-xs-6 editions" >

<h3>Publications<br><br></h3>

   <?php
   $publication_list = get_page_children(35, $all_wp_pages);
   $publication_thumb_size = array("h" => 200, "w" => 160);
    foreach($publication_list as $publication){
		   	?>

		
			<div   class="col-xs-12 col-md-6">
				
				<a href="<?php echo get_page_link( $publication->ID ); ?>">
					<div class = "artist-thumb">
					 <?php 
					 if (get_image('image',1,1,1,$publication->ID)){
					 echo get_image('image',1,1,1,$publication->ID,$publication_thumb_size); 
					 }
					 ?>
				 	</div>
		<div class="artist-link">
			<br>
			<?php echo $publication->post_title; ?>
		</a>
		</div>
	</div>
	  <?php
	}
   
 	?>
</div>

