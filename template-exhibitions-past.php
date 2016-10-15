<?php
/**
 * Template Name: Exhibitions Past Template
 */
?>

<div class = "exhibition-links">

	<h3><div class = "selected-link"><a href="/index.php?page_id=22">Past Exhbitions</a></div><h3>
	<h4><a href="/index.php?page_id=11">Current</a><h4>
	<h4><a href="/index.php?page_id=20">Upcoming</a><h4>

</div>

	<div class = "past-exhibitions-list">


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
									                'key' => 'end_date', // Check the start date field
									                'value' => date("Y-m-d"), // Set today's date (note the similar format)
									                'compare' => '<=', // Return the ones smaller than today's date
									                'type' => 'NUMERIC,' // Let WordPress know we're working with numbers
									                )
									            ),
											
											'posts_per_page' => -1));
											
   $exhibition_list = get_page_children(11, $all_wp_pages);
   $exhibition_years = array();
   
    $thumb_size = array("h" => 220, "w" => 260);
	
	//create an array of all the exhibition years
	
    foreach($exhibition_list as $exhibition){
	 $ex_end_date = strtotime(get('end_date',1,1,1,$exhibition->ID));
	 $end_date_year = date('Y',$ex_end_date);
	 if (!in_array($end_date_year, $exhibition_years)){
	 	array_push($exhibition_years, $end_date_year);
	 }
	}
 	?>

 <?php
 	foreach($exhibition_years as $year){
 		?>
		<div class = "col-xs-12"><h3><?php echo $year ?><h3></div>
<?php
	foreach($exhibition_list as $exhibition){
   	 $ex_end_date = strtotime(get('end_date',1,1,1,$exhibition->ID));
   	 $end_date_year = date('Y',$ex_end_date);
	 $full_date = get('start_date',1,1,1,$exhibition->ID) . " - " .get('end_date',1,1,1,$exhibition->ID); 
if (strcmp($end_date_year, $year) == 0){ ?>
	
	<div   class="col-xs-12 col-sm-6 col-md-3 exhibition-item">
		
		<a href="<?php echo get_page_link( $exhibition->ID ); ?>">
		<div class = "exhibition-thumb col-xs-12">
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
		
		<div class = "exhibition-label col-xs-12">
			<?php
			 echo $exhibition->post_title, "<br>";
			 echo '<div class = "exhibition-date"> ',$full_date, '</div>';
			?>
		</div>
		
		</a>
	</div>
				
<?php					
}//end if exhibition year matches current year
	 }// end for each exhibition in a year
} //end for each year
			
 ?>
   
 
</div> 
