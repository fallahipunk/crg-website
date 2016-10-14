<?php
/**
 * Template Name: Press & Events 
 */
?>

<?php while (have_posts()) : the_post(); ?>

 
<?php endwhile; ?>


<div class ="news-list">

  <?php
      $args = array( 'category' => 1, 'post_type' =>  'post', 'posts_per_page' => -1, 											'orderby' => 'date',
											'order' => 'DESC', ); 
      $postslist = get_posts( $args );    
      foreach ($postslist as $post) :  setup_postdata($post); 
      $end_date = strtotime(get('end_date',1,1,1,$post->ID));
	  $yesterday = strtotime("-1 days");
	  if ($end_date > $yesterday){
	  ?>  
	  <h3><a href="<?php the_permalink(); ?>"> <div class = "col-sm-6 current-title"><?php the_title(); ?></div>
	 <div class = "col-sm-6 current-image"> <?php 
	  the_post_thumbnail("current-thumb");
	  ?></div>
  		</a></h3>
	   <?php 
   }// end if current
	   endforeach; ?> 
	   
	     <?php foreach ($postslist as $post) :  setup_postdata($post); 
	      $end_date = strtotime(get('end_date',1,1,1,$post->ID));
		  $yesterday = strtotime("-1 days");
		  if ($end_date <= $yesterday){
		  ?>  
		  <div class = "col-xs-6 col-sm-3 col-md-2 past-event">
		  <h5><a href="<?php the_permalink(); ?>"><div class = "col-sm-12 past-news-title"><?php the_title(); ?></div>
		 <div class = "col-sm-12 past-news-img">
		  <?php 
		  the_post_thumbnail();
		  ?>
	  </div>
	  		</a></h5> </div>
		   <?php 
	   }// end if past
		   endforeach; ?>
</div>
</div>

