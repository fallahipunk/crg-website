<?php
/**
 * Template Name: Press & Events 
 */
?>

<?php while (have_posts()) : the_post(); ?>

 
<?php endwhile; ?>

<div class = "col-xs-6 editions" >

<h3>Press<br><br></h3>

   <?php
   $my_wp_query = new WP_Query();
   $all_wp_pages = $my_wp_query->query(array(
	   										'post_type' => 'page',
											'orderby' => 'date',
											'order' => 'DESC',
											'posts_per_page' => -1));
   $artist_list = get_page_children(61, $all_wp_pages);
   $thumb_size = array("h" => 200, "w" => 160);
    foreach($artist_list as $artist){
		   	?>

		
			<div   class="col-xs-12 col-md-6">
				
				<a href="<?php echo get_page_link( $artist->ID ); ?>">

		<div class="press-link">
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

<h3>Events<br><br></h3>

  <?php
      $args = array( 'category' => 1, 'post_type' =>  'post', 'posts_per_page' => -1, 											'orderby' => 'date',
											'order' => 'DESC', ); 
      $postslist = get_posts( $args );    
      foreach ($postslist as $post) :  setup_postdata($post); 
      ?>  
	  <?php get_post_thumbnail_id($post);?>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	   <?php endforeach; ?> 
</div>

