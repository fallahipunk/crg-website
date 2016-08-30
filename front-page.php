<?php // oroginally copied from page.php
	while (have_posts()) : the_post(); ?>
  
  <?php get_template_part('templates/page', 'header'); ?>
  
  <?php get_template_part('templates/content', 'page'); ?>
  
  <div class ="gray-arrow">
	  <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
  </div>
  
  <div class="container-fluid">
    
	<div class="row">  
		<!--   Mailing   List-->  <div   class="col-xs-12"> 
			 <div class="mailing-list-form"> 
				 <?php get_template_part('templates/form-newsletter');  ?>
			 </div> 
		 </div>
	</div>
	
	<div class="row">  
		<!--  address -->  <div   class="col-xs-12 col-sm-6 col-md-4"> 
			 <div class="address"> 
				 195 Chrystie Street, New York, NY 10002
			 </div> 
		 </div>

		<!--  google map -->  <div   class="col-xs-12 col-sm-6 col-md-4"> 
			 <div class="google-map"> 
				 google map
			 </div> 
		 </div>
  
		<!--   hours-->  <div   class="col-xs-12 col-md-4"> 
			 <div class="hours"> 
				 T - 212 229 2766
				 info@crggallery.com

				 Summer Schedule
				 June / July
				 Tuesday - Friday
				 11am - 6pm

				 August
				 By appointment
			 </div> 
		 </div>
	</div>
	
	<div class="row">  
		<!--   social media-->  <div   class="col-xs-12"> 
			 <div class="social-media"> 
				 Social Media
			 </div> 
		 </div>
	</div>
	
 </div>

 
<?php endwhile; ?>



