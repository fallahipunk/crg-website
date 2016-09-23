<?php
/**
 * Template Name: About Template
 */
?>

	<div class = "about">
				 <div class="map-img">
					<a href="https://www.google.com/maps/place/CRG+Gallery/@40.7221163,-73.9943267,17z/data=!3m1!4b1!4m5!3m4!1s0x89c259c7f0a4a6d1:0xeecfca023ef23f1b!8m2!3d40.7221123!4d-73.9921326" target="_blank">
						<img src="<?= get_template_directory_uri() . '/assets/images/about-map.png'; ?>">
					</a>
 				</div>
					<div   class="col-md-6">
											<a href="https://www.google.com/maps/place/CRG+Gallery/@40.7221163,-73.9943267,17z/data=!3m1!4b1!4m5!3m4!1s0x89c259c7f0a4a6d1:0xeecfca023ef23f1b!8m2!3d40.7221123!4d-73.9921326" target="_blank">
							<h1> 195 Chrystie Street,<br> New York, NY 10002</h1>
						</a>
					</div>
					<div   class="col-md-6">
						<h3>T – 212 229 2766<br>
							F – 212 229 2788<br>
							<a href = "mailto:info@crggallery.com">info@crggallery.com </a></h3>
						</div>
					</div>
				</div>
 <div   class="col-md-6 ">
<?php if ( have_posts() ) { /* Query and display the parent. */
 while ( have_posts() ) {
	 the_post();
	 the_content();
 $thispage=$post->ID;
 }
} ?>
</div>

<?php $childpages = query_posts('post_per_page=3&orderby=menu_order&order=asc&post_type=page&post_parent='.$thispage);
 if($childpages){ /* display the children content */
 foreach ($childpages as $post) :
 setup_postdata($post); ?>
 
 <div class="child-pages">
	 
  <div   class="col-md-6">
 <h2><?php the_title(); ?></h2>
 <?php the_content();?>
   </div>
  </div>

 <?php
 endforeach;
 
 
 } ?>
 
</div> 
