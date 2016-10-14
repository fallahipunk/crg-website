<?php
/**
 * Template Name: Exhibitions upcoming Template
 */
?>
<div calss="row">
<div class = "exhibition-links">
	<div  class="col-xs-12">	
	<h3><div class = "selected-link"><a href="/index.php?page_id=20">Upcoming Exhibitions</a></div><h3>
	<h4><a href="/index.php?page_id=22">Past</a><h4>
	<h4><a href="/index.php?page_id=11">Current</a><h4>
	</div>
</div>

</div>

	<div class = "exhibition-list">


<?php if ( have_posts() ) { /* Query and display the parent. */
 while ( have_posts() ) {
	 the_post();
 }
}
?>
   <?php
   $my_wp_query = new WP_Query();
   $all_wp_pages = $my_wp_query->query(array(
	   										'post_type' => 'page',
											'orderby'   => 'meta_value',
											'meta_key'  => 'end_date',
											'meta_type' => 'DATE',
											'order' => 'DESC',
									        'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
									            array(
									                'key' => 'start_date', // Check the start date field
									                'value' => date("Y-m-d"), // Set today's date (note the similar format)
									                'compare' => '>=', // Return the ones greater than today's date
									                'type' => 'NUMERIC,' // Let WordPress know we're working with numbers
									                )
									            ),
											
											'posts_per_page' => -1));
											
											
										    $exhibition_list = get_page_children(11, $all_wp_pages);
   
										     $thumb_size = array("h" => 220, "w" => 260);
	

										 		foreach($exhibition_list as $exhibition){
										 			$full_date = get('start_date',1,1,1,$exhibition->ID) . " - " .get('end_date',1,1,1,$exhibition->ID);
										 		   	?>
		
										 			<div   class="current-exhibition-item">
										 		<dic class = "row">
										 				<a href="<?php echo get_page_link( $exhibition->ID ); ?>">
										 				<div class = "current-exhibition-thumb col-sm-6">
										 						<?php
										 							 if(get_image('installation_image',1,1,1,$exhibition->ID)){
										 							echo get_image('installation_image',1,1,1,$exhibition->ID,$thumb_size); 
										 							}
										 							elseif (get_image('selected_image',1,1,1,$exhibition->ID)){
										 							echo get_image('selected_image',1,1,1,$exhibition->ID,$thumb_size); 
										 							}
										 							else{ ?>
										 								<img src="<?= get_template_directory_uri() . '/assets/images/placeholder-tumb.png'; ?>">
										 							 <?php }  
										 							 ?>
										 				</div>
		
										 				<div class = "current-exhibition-label col-sm-6">
										 					<?php
										 					 echo $exhibition->post_title, "<br>";
										 					 echo '<div class = "exhibition-date"> ',$full_date, '</div>';
										 					?>
										 				</div>
		
										 				</a>
										 			</div>
										 			</div>
										 	  <?php
										 	}
   
										  	?>

 
   
 
										 </div> 
  