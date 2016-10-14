<?php
/**
 * Template Name: editions & publications 
 */
?>

<?php while (have_posts()) : the_post(); ?>

 
<?php endwhile; ?>






   <?php
   $my_wp_query = new WP_Query();
   $all_wp_pages = $my_wp_query->query(array(
	   										'post_type' => 'page',
											'orderby'   => 'meta_value',
											'meta_key'  => 'artist_lastname',
											'order' => 'ASC',
											'posts_per_page' => -1));
											
   $edition_list = get_page_children(27, $all_wp_pages);
   $edition_thumb_size = array("h" => 200, "w" => 160);
   
   $publication_list = get_page_children(35, $all_wp_pages);
   $publication_thumb_size = array("h" => 140, "w" => 160);
   
   $artist_list = array();
   
   foreach($publication_list as $publication){
	   $publication_last_name =  get('artist_lastname',1,1,1,$publication->ID);
	   if (!in_array($publication_last_name,$artist_list)){
	   	array_push($artist_list, $publication_last_name);
	   }
   } // for each publication
   
   foreach($edition_list as $edition){
	   $edition_last_name =  get('artist_lastname',1,1,1,$edition->ID);
	   if (!in_array($edition_last_name,$artist_list)){
	   	array_push($artist_list, $edition_last_name);
	   }
   } // for each publication
   
   
   
   // cycle through all of the artists, create two new arrays for each artist, one for editions and the other for publications
   
   foreach($artist_list as $artist){
	   
	   $artist_publications = array();
	   $artist_editions = array();
	   $artist_first_name = " ";
	   
	   foreach($publication_list as $publication){
		 
	   	$publication_last_name =  get('artist_lastname',1,1,1,$publication->ID);
							
		if (strcmp($artist, $publication_last_name) == 0){
			array_push($artist_publications, $publication);
			if (get('artist_firstname',1,1,1,$publication->ID)){
			$artist_first_name  =  get('artist_firstname',1,1,1,$publication->ID);}
		}
		
	   }// for each publication
	  
	   foreach($edition_list as $edition){
		   
	   	$edition_last_name =  get('artist_lastname',1,1,1,$edition->ID);
		if (strcmp($artist, $edition_last_name) == 0){
			array_push($artist_editions, $edition);
			if (get('artist_firstname',1,1,1,$edition->ID)){
			$artist_first_name  =  get('artist_firstname',1,1,1,$edition->ID);
		}
		}
	   }// for each eiditions
	   ?>
	   
<div class = "editions-and-publications">
		 <?php  
	   if (count($artist_publications) > 0 || count($artist_editions) > 0 ) {?>
		   
		   <div class = "col-xs-12 col-md-12 ed-pub-artist-name">
		  <h3> <?php echo $artist_first_name . " " . $artist;?>
			  </h3>
	   		</div>
			
			<?php 
			if (count($artist_publications) > 0) {
			?>
			<h4><div class = "col-xs-12 pub-label"> Publications </div></h4>
			
		    <?php foreach($artist_publications as $publication){
				   	?>
					<div   class="col-xs-12 col-sm-6 col-md-3">
				
						<a href="<?php echo get_page_link( $publication->ID ); ?>">
							<div class = "artist-thumb">
							 <?php 
							 if (get_image('image',1,1,1,$publication->ID)){
							 echo get_image('image',1,1,1,$publication->ID,$publication_thumb_size); 
							 }
							 ?>
						 	</div>
					<br>
					<?php echo $publication->post_title; ?>
				</a>
			</div>
			
			<?php
		}// end for each artist publication
			} // end if publicationd
			if (count($artist_editions) > 0){
			?>
			<h4><div class = "col-xs-12 ed-label"> Editions </div></h4>
			
		    <?php foreach($artist_editions as $edition){
				   	?>
					<div   class="col-xs-12 col-sm-6 col-md-3">
				
						<a href="<?php echo get_page_link( $edition->ID ); ?>">
							<div class = "artist-thumb">
							 <?php 
							 if (get_image('image',1,1,1,$edition->ID)){
							 echo get_image('image',1,1,1,$edition->ID,$edition_thumb_size); 
							 }
							 ?>
						 	</div>
					<br>
					<?php echo $edition->post_title; ?>
				</a>
			</div>
			
		<?php  
			}// end for each artist edition
			}// end if editions
		 } // end if publications and editions
	   ?>
	 

		<?php } //for each artist	?>

</div>
		
		