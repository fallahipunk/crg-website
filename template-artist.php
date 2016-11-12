<?php
/**
 * Template Name: Artist
 */
$pid = $post->ID;
?>
<script>
jQuery(document).ready(function($)
{
// Arrows behavior after click
  $('.expand-arrow').toggle(function() {

    var e = $(this).closest("div").find('div');
    var a = $(this).children("span");
    var b = $(this).closest("div").next(".cheat");

    // Getting the heights of the container
    var height = $(e[0]).outerHeight();

      $(e[0]).css({"height": height}); // injecting the heights into css
      $(e[0]).addClass("expand");
      $(a).removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
      $(b).removeClass("clearfix");

    }, function () {
  var e = $(this).closest("div").find('div');
  var a = $(this).children("span");
  var b = $(this).closest("div").next(".cheat");


  $(e[0]).removeClass("expand");
  $(a).removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
  $(b).addClass("clearfix");
  });

// Maintaining visibility of the arrows which are not related to any ajax containers (e.g. Biography)
  $.fn.hasOverflow = function() {
  var $this = $(this);
  return $this[0].scrollHeight > $this.outerHeight() ||
      $this[0].scrollWidth > $this.outerWidth();
    };

  var $content = jQuery('#biography');
  if($content.hasOverflow()) {
   var e = jQuery($content).closest("div").next(".expand-arrow");
   jQuery(e).removeClass("hidden");}

// Ajax script
  jQuery('.fire-ajax').one('click', function() { //one means that the function will work only once
    var theClass = this; //needed within the ajax call

    $(this).addClass("invisible"); //hiding container's arrow during the call (while spinner spins)

    var action = jQuery(this).closest("div").find('div'); // looking for the right div
    var idName = jQuery(action).attr('id'); // getting id attribute from that div

    // Spinner options
    var opts = {
      lines: 13 // The number of lines to draw
    , length: 24 // The length of each line
    , width: 12 // The line thickness
    , radius: 25 // The radius of the inner circle
    , scale: 0.25 // Scales overall size of the spinner
    , corners: 1 // Corner roundness (0..1)
    , color: '#000' // #rgb or #rrggbb or array of colors
    , opacity: 0.25 // Opacity of the lines
    , rotate: 0 // The rotation offset
    , direction: 1 // 1: clockwise, -1: counterclockwise
    , speed: 1 // Rounds per second
    , trail: 60 // Afterglow percentage
    , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
    , zIndex: 2e9 // The z-index (defaults to 2000000000)
    , className: 'spinner' // The CSS class to assign to the spinner
    , top: '95%' // Top position relative to parent
    , left: '50%' // Left position relative to parent
    , shadow: false // Whether to render a shadow
    , hwaccel: false // Whether to use hardware acceleration
    , position: 'absolute' // Element positioning
    }

    // Spinner
    var target = jQuery('#' + idName)[0];
    var spinner = new Spinner(opts).spin(target);

    // Ajax call
    jQuery.ajax({

      type : 'GET',
      url  : ajaxurl, // always same in wordpress, defined in head.php
      data : {
            action: idName, //firing the callout
            pid: '<? echo $pid ?>' //sending the post ID to ajax callout
        },
        success :  function(data)
        {
          jQuery("#" + idName).html(data); //gettind response and injeting the data
          $(theClass).removeClass("invisible"); //showing the arrow back again
          $(theClass).removeClass("fire-ajax"); //class self destruction
        }
      });
      return false;
    });
});
</script>

<script type="text/javascript">
//Selected Work slider
    jQuery(document).ready(function(){
      jQuery('.selected-work-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        fade: true,
        lazyLoad: 'progressive',
        customPaging: function(slider, i) {
    var thumb = jQuery(slider.$slides[i]).data();
    return '<div class="numberCircle"><div class="height_fix"></div><a class="content">'+(i+1)+'</a></div>';
            },
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                      // adaptiveHeight: true,
                      // mobileFirst: true,
                      // arrows: true,
                      // variableWidth: true,
                  }
                }
              ]
      });
    });

    var $status = jQuery('.pagingInfo');
     var $slickElement = jQuery('.slider');

     $slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
         //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
         var i = (currentSlide ? currentSlide : 0) + 1;
         $status.text(i + '/' + slick.slideCount);
     });
  </script>




<?php while (have_posts()) : the_post(); ?>
  <!-- Image for Header -->
  <div class="artist-page-container">
    <img src=<?php echo get('image'); ?>>
    <div class="page-header">
    <?php get_template_part('templates/page', 'header'); ?>
    </div>
  </div>

  <div class="container">
  <!-- <?php get_template_part('templates/content', 'page'); ?> -->
    <div class="row">

      <!-- Selected work -->
      <div class="col-lg-8">
        <h4>Selected Work</h4>
          <?
        	$items = get_group('Selected Work');

        	//print_r($items);
        	//$photoID = $_GET['photo'];


        	if(count($items)) :

        	$itemsChunk = array_chunk($items,1,true);

        	?>
        	<div class="selected-work-slider">

        	<?
        	foreach ($itemsChunk as $items) :
        		?>
        	<div class="selected-work-slider-container">
        	<?


        		foreach ($items as $key => $item) :
        				?>
						
                <div class="slide-image"><img data-lazy="<?=$item['selected_image'][1][o];?>"></div>
                <div class="slide-captions"><?=$item['selected_caption'][1];?></div>
        				<?
        		endforeach;
        	?>
        </div>
        	<?
        		endforeach;
        	endif; //count/items
        	?>
        </div>
      </div>
      <!-- Biography -->
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 pull-right-lg">

        <?php $category = wp_get_post_parent_id( $pid );
        echo $category; 

        ?>

        <h4>Biography</h4>
        <a class="print small" href="#" onclick='jQuery("#biography").print({stylesheet:"/wp-content/themes/crg-website/dist/styles/print.css"});'><span class="glyphicon glyphicon-print"></span> print</a>
        <div id="biography">
		
		<div class = "visible-print-block">
		<h3><?php echo get_the_title();?></h3>
		<br><br>
		</div>
		
        <?=get('bio');?>
        </div>
        <button  type="button" class="btn btn-link expand-arrow pull-right hidden" >
          <span class="glyphicon glyphicon-menu-down"></span>
        </button>
        </div>
        <div class="cheat clearfix visible-lg-block"></div>
        <div class="cheat clearfix visible-xs-block"></div>

      <!-- Press -->
      <?
          $press_query = new WP_Query();
          $press_query->query('post_parent=61&meta_key=artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=7&post_type=page');
          if ($press_query->have_posts()) : while ($press_query->have_posts()) : $press_query->the_post();

          $year = get_the_time('Y');

          $press[$year][] = array(
            'title' 	=> get_the_title(),
            'id' 		=> $post->post_name,
            'date'		=> get_the_time('F d, Y'),
            'subhead'	=> get('subhead')

          );  endwhile; endif;?>

          			<? if (is_array($press)) : ?>
                <div class="col-sm-6 col-md-6 col-lg-4 pull-right-md pull-left-lg">
                  <h4>Press</h4>
                  <div id="press">
                  <?
          						foreach ($press as $year => $pressArray) : //print_r($exhibition);

                        $count = 1;
                        foreach ($pressArray as $press) :

          							$yearGroup = ($count == 1) ? $year : "";
          							$count++;
          					?>

          		<div style="margin-bottom:10px;"><b><?=$yearGroup;?></b></div>
              <div style="margin-bottom:10px;"><b><a href="http://crggallery.com/press/<?=$press['id'];?>"><?=$press['title'];?></a></b> <?php edit_post_link("[edit]", "<br/>"); ?><span class="exdate"><i><?=$press['subhead'];?></i> <?=$press['date'];?></span></div>
            <? endforeach; endforeach;?>

          </div>

          <? if ($press_query->found_posts > 7 ) : ?>
          <button  type="button" class="btn btn-link expand-arrow pull-right fire-ajax" >
            <span class="glyphicon glyphicon-menu-down"></span>
          </button>
        <? endif;?>

          </div>
          <? endif; ?>
          <div class="cheat clearfix visible-sm-block visible-md-block"></div>
          <div class="cheat clearfix visible-sm-block"></div>

          <!-- Publications -->
          <?
          $publications_query = new WP_Query();
          $publications_query->query('post_parent=35&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=2&post_type=page');

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
          ?>

          <div class="col-sm-5 col-md-6 col-lg-4">
              <h4>Publications</h4>
              <div id="publications">
                <div class="row">
                  <? foreach ($items as $item) : //print_r($item);
                    $artists = "";
                    foreach ($item['artists'] as $artist) :
                      $artists .= get_the_title($artist)."<br/>";
                    endforeach; ?>
                    <div class="col-lg-6">
                      <a href="<?=$item['permalink'];?>"><?=$item['thumb'];?></a><br>
                      <span><a href="<?=$item['permalink'];?>"><?=$item['title'];?></a><span><br><?=$artists;?><?=$item['year'];?></span></span>
                    </div>
                    <? endforeach; ?>

                <? endforeach; ?>
              </div>
            </div>
              <? if ($publications_query->found_posts > 2 ) : ?>
              <button  type="button" class="btn btn-link expand-arrow pull-right fire-ajax" >
                <span class="glyphicon glyphicon-menu-down"></span>
              </button>
            <? endif;?>
            </div>
            <div class="clearfix visible-sm-block visible-md-block"></div>

            <? else: endif; ?>

      <!-- Events -->
      <?php
      $events_query = new WP_Query();
	  $args = array('category' => 1,
	  				'meta_key' => 'related_artist',
					'meta_value' => $pid,
					'orderby' => 'date',
					'order' => 'DESC',
					'showposts' => 3,
					'meta_query' => array(
						array(
						            'key'     => 'end_date',		            
									'value'   => date("Y-m-d"),		            
									'type'    => 'DATE',		          
									'compare' => '>=')
								)
					);
					
      $events_query->query($args);
	  $events_list = get_posts($events_query);
      if ($events_query->have_posts()) : ?>
      <div class="col-sm-5 col-md-5 col-lg-4">
          <h4>Events</h4>
        <div id="events">
      <? while($events_query->have_posts()) : $events_query->the_post(); ?>
      <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/><br/>
      <?php endwhile; ?>
      </div>
      <? if ($events_query->found_posts > 3 ) : ?>
      <button  type="button" class="btn btn-link expand-arrow pull-right fire-ajax" >
        <span class="glyphicon glyphicon-menu-down"></span>
      </button>
    <? endif;?>
      </div>
      <?endif; ?>
  </div>
</div>
<?php endwhile; ?>
