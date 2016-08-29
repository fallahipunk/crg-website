<?php // oroginally copied from page.php
	while (have_posts()) : the_post(); ?>
  
  <?php get_template_part('templates/page', 'header'); ?>
  
  <?php get_template_part('templates/content', 'page'); ?>
  
  <div class ="gray-arrow">
	  <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
  </div>
  
  <div class="container-fluid">
    
	<div   class="row">  <!--   Mailing   List-->  <div   class="col-xs-12">  <div   class
="mailing-list-form"> <?php get_template_part('templates/form-newsletter');  // copied the
form example from the book, will change it later ?> </div> </div>
		
	</div>
	
	<div class="row">
		<!-- address-->
		 <div class="col-xs-12 col-sm-6 col-md-4 address">
		 address
	 	</div>
		<!-- google map -->
		<div class="col-xs-12 col-sm-6 col-md-4 google-map">
		google map
		</div>
		<!-- hours-->
		<div class="col-xs-12 col-sm-12 col-md-4 hours">
		hours</div>
		
	</div>
	<!-- Social Media -->
	<div class="col-xs-12 social-media">
		social media
	</div>
	
 </div>
 </div>
 
<?php endwhile; ?>



