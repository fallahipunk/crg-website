<?php
/**
 * Template Name: Exhibitions upcoming Template
 */
?>
<div calss="row">
	<h4>
<div class = "exhibition-links">
	<div  class="col-xs-4">		
	<a href="/index.php?page_id=11">Current</a>
	</div>
	<div  class="col-xs-4 selected-link">		
	<a href="/index.php?page_id=20">Upcoming</a>
	</div>
	<div  class="col-xs-4">		
	<a href="/index.php?page_id=22">Past</a>
	</div>
</div>
	</h4>
</div>

	<div class = "artist-list">


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
											
   $artist_list = get_page_children(11, $all_wp_pages);
    foreach($artist_list as $artist){
		   	?>
		
	<div   class="col-xs-12">
		<div class="upcoming-exhibition-link">
			<a href="<?php echo get_page_link( $artist->ID ); ?>">
				<h4><?php echo $artist->post_title; ?></h4>
				<br>
				<?php echo get('start_date',1,1,1,$artist->ID); ?>
				 - 
				 <?php echo get('end_date',1,1,1,$artist->ID); ?>
			</a>
		</div>
	</div>
	
	  <?php
	}
   
 	?>

 
</div> 
