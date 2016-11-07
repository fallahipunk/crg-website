<?php
/**
 * Template Name: Press & Events 
 */
?>

<?php while (have_posts()) : the_post(); ?>

 
<?php endwhile; ?>


<div class ="news-list">

  <?php
      $args = array( 'category' => 1, 'post_type' =>  'post', 'posts_per_page' => -1, 											'orderby'=> 'date',
											'order' => 'DESC', ); 
      $postslist = get_posts( $args );    
      foreach ($postslist as $post) :  setup_postdata($post); 
      $end_date = strtotime(get('end_date',1,1,1,$post->ID));
	  $yesterday = strtotime("-1 days");
	  if ($end_date > $yesterday){
	  ?>  
	  <h4><a href="<?php the_permalink(); ?>"> <div class = "col-sm-6 current-title"><?php the_title(); ?></div>
	 <div class = "col-sm-6 current-image"> <?php 
	  the_post_thumbnail("current-thumb");
	  ?></div>
  		</a></h4>
	   <?php 
   }// end if current
	   endforeach; ?> 
	   
	    
</div>
</div>

