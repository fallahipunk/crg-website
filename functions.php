<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

require_once('wp_bootstrap_navwalker.php'); // necessary to include bootsreap nav menu in header.php


function events_callback() {
	global $wpdb;
  $pid = $_REQUEST['pid']; // grabing the $pid variable passed by jQuery
  $events_query = new WP_Query();
  $events_query->query('cat=1&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1');
  if ($events_query->have_posts()) :
  while($events_query->have_posts()) : $events_query->the_post(); ?>
  <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/><br/>
<?  endwhile;
endif;
	wp_die(); // this is required to terminate immediately and return a proper response
}

function publications_callback() {
	global $wpdb;
  $pid = $_REQUEST['pid']; // grabing the $pid variable passed by jQuery
  $publications_query = new WP_Query();
  $publications_query->query('post_parent=35&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1&post_type=page');
  if ($publications_query->have_posts()) : while ($publications_query->have_posts()) : $publications_query->the_post();

  $args = array("h" => 110, "w" => 90);
  $itemsArray[] = array(
    'title'=>get_the_title(),
    'artists'=>get_field_duplicate('related_artist'),
    'permalink'=>get_permalink(),
    'thumb'=>get_image('image',1,1,1,NULL,$args),
    'year'=>get('year')
  );

  endwhile; endif;

  if(count($itemsArray)) :
    $itemsChunk = array_chunk($itemsArray,10,true);
    foreach ($itemsChunk as $items) :

      foreach ($items as $item) : //print_r($item);
        $artists = "";
        foreach ($item['artists'] as $artist) :
          $artists .= get_the_title($artist)."<br/>";
        endforeach; ?>
        <div class="col-lg-6">
          <a href="<?=$item['permalink'];?>"><?=$item['thumb'];?></a><br>
          <span><a href="<?=$item['permalink'];?>"><?=$item['title'];?></a><span><br><?=$artists;?><?=$item['year'];?></span></span>
        </div>
      <?
        endforeach;
      endforeach; endif;
	   wp_die(); // this is required to terminate immediately and return a proper response
   }

function press_callback() {
	global $wpdb;
  $pid = $_REQUEST['pid']; // grabing the $pid variable passed by jQuery
  $press_query = new WP_Query();
  $press_query->query('post_parent=61&meta_key=artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1&post_type=page');
  if ($press_query->have_posts()) : while ($press_query->have_posts()) : $press_query->the_post();

  $year = get_the_time('Y');

  $press[$year][] = array(
    'title' 	=> get_the_title(),
    'id' 		=> $post->post_name,
    'date'		=> get_the_time('F d, Y'),
    'subhead'	=> get('subhead'),
    'permalink' => get_permalink()

  );  endwhile; endif;
      foreach ($press as $year => $pressArray) : //print_r($exhibition);

        $count = 1;
        foreach ($pressArray as $press) :

        $yearGroup = ($count == 1) ? $year : "";
        $count++;
    ?>
      <div style="margin-bottom:10px;"><b><?=$yearGroup;?></b></div>
      <div style="margin-bottom:10px;"><b><a href="<?=$press['permalink'];?>"><?=$press['title'];?></a></b> <?php edit_post_link("[edit]", "<br/>"); ?><span class="exdate"><i><?=$press['subhead'];?></i> <?=$press['date'];?></span></div>
      <? endforeach; endforeach;
	    wp_die(); // this is required to terminate immediately and return a proper response
}

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 200, 200, true ); // default Post Thumbnail dimensions (cropped)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'current-thumb', 500, 500 ); //300 pixels wide (and unlimited height)
}



add_action( 'wp_ajax_press', 'press_callback' );
add_action( 'wp_ajax_nopriv_press', 'press_callback' );
add_action( 'wp_ajax_publications', 'publications_callback' );
add_action( 'wp_ajax_nopriv_publications', 'publications_callback' );
add_action( 'wp_ajax_events', 'events_callback' );
add_action( 'wp_ajax_nopriv_events', 'events_callback' );
add_filter('posts_orderby','my_sort_custom',10,2);
