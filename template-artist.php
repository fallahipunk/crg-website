<?php
/**
 * Template Name: Artist
 */
$pid = $post->ID;
$postname = $post->post_title;
?>
<script type="text/javascript">
//Script for firing arrows
(function($) {
  $.fn.hasOverflow = function() {
    var $this = $(this);
    return $this[0].scrollHeight > $this.outerHeight() ||
        $this[0].scrollWidth > $this.outerWidth();
  };
})(jQuery);
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

<script>
jQuery( document ).ready(function($) {

  //Arrows functions
  $('.expand-arrow').toggle(function() {

    var e = $(this).closest("div").find('div');
    var a = $(this).children("span");
    var b = $(this).closest("div").next(".cheat");


      $(e).addClass("expand");
      $(a).removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
      $(b).removeClass("clearfix");

    }, function () {
  var e = $(this).closest("div").find('div');
  var a = $(this).children("span");
  var b = $(this).closest("div").next(".cheat");


  $(e).removeClass("expand");
  $(a).removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
  $(b).addClass("clearfix");
  });


//Firing arrows
var $content = jQuery('.artist-biography');
if($content.hasOverflow()) {
 var e = jQuery($content).closest("div").next(".expand-arrow");
 jQuery(e).removeClass("hidden");}
 var $content = jQuery('.artist-press');
if($content.hasOverflow()) {
 var e = jQuery($content).closest("div").next(".expand-arrow");
 jQuery(e).removeClass("hidden");}
 var $content = jQuery('.artist-events');
if($content.hasOverflow()) {
 var e = jQuery($content).closest("div").next(".expand-arrow");
 jQuery(e).removeClass("hidden");}
 var $content = jQuery('.artist-publications');
if($content.hasOverflow()) {
 var e = jQuery($content).closest("div").next(".expand-arrow");
 jQuery(e).removeClass("hidden");}


  })
</script>



<?php while (have_posts()) : the_post(); ?>
  <!-- Image for Header -->
  <div class="artist-page-container">
    <img src=<?php echo get('image'); ?>>
    <?php get_template_part('templates/page', 'header'); ?>
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
                <img src="<?=$item['selected_image'][1][o];?>">
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
        <h4>Biography</h4>
        <div class="artist-biography">
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
          query_posts('post_parent=61&meta_key=artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1&post_type=page');

          if (have_posts()) : while (have_posts()) : the_post();

          $year = get_the_time('Y');

          $press[$year][] = array(
            'title' 	=> get_the_title(),
            'id' 		=> $post->post_name,
            'date'		=> get_the_time('F d, Y'),
            'subhead'	=> get('subhead')

          );  endwhile; endif; wp_reset_query();?>

          			<? if (is_array($press)) : ?>
                <div class="col-sm-6 col-md-6 col-lg-4 pull-right-md pull-left-lg">
                  <h4>Press</h4>
                  <div class="artist-press">
                  <?

          						foreach ($press as $year => $pressArray) : //print_r($exhibition);
                        $count = 1;
                        foreach ($pressArray as $press) :  //slices amount in year period

          							$yearGroup = ($count == 1) ? $year : "";
          							$count++;
          					?>

          		<div style="margin-bottom:10px;"><b><?=$yearGroup;?></b></div>
              <div style="margin-bottom:10px;"><b><a href="<?=$press['id'];?>"><?=$press['title'];?></a></b> <?php edit_post_link("[edit]", "<br/>"); ?><span class="exdate"><i><?=$press['subhead'];?></i> <?=$press['date'];?></span></div>
            <? endforeach; ?>

        <?  endforeach;
?>

          </div>

            <button  type="button" class="btn btn-link expand-arrow pull-right hidden" >
              <span class="glyphicon glyphicon-menu-down"></span>
            </button>
          </div>

          <? endif; ?>
          <div class="cheat clearfix visible-sm-block visible-md-block"></div>
          <div class="cheat clearfix visible-sm-block"></div>

          <!-- Publications -->
          <?
          query_posts('post_parent=35&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1&post_type=page');

          if (have_posts()) : while (have_posts()) : the_post();

          $args = array("h" => 110, "w" => 90);
          $itemsArray[] = array(
            'title'=>get_the_title(),
            'artists'=>get_field_duplicate('related_artist'),
            'permalink'=>get_permalink(),
            'thumb'=>get_image('image',1,1,1,NULL,$args),
            'year'=>get('year')
          );

          endwhile; endif; wp_reset_query();

          if(count($itemsArray)) :
            $itemsChunk = array_chunk($itemsArray,10,true);
            foreach ($itemsChunk as $items) :
          ?>

          <div class="col-sm-5 col-md-6 col-lg-4">
              <h4>Publications</h4>

                <div class="row artist-publications">
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
              <button  type="button" class="btn btn-link expand-arrow pull-right hidden" >
                <span class="glyphicon glyphicon-menu-down"></span>
              </button>
            </div>
            <div class="clearfix visible-sm-block visible-md-block"></div>

            <? else: endif;?>

      <!-- Events -->
      <? query_posts('cat=1&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1');
      if (have_posts()) : ?>
      <div class="col-sm-5 col-md-5 col-lg-4">
        <h4>Events</h4>
        <div class="artist-events">
        <? while (have_posts()) : the_post(); ?>
          <a href="<? the_permalink();?>"><? the_title(); ?></a><br/><br/>
          <? edit_post_link("[edit]", "<br/>"); ?>
        <? endwhile;?>
      </div>
      <button  type="button" class="btn btn-link expand-arrow pull-right hidden" >
        <span class="glyphicon glyphicon-menu-down"></span>
      </button>
      </div>
      <? endif; wp_reset_query();?>



</div>

<?php endwhile; ?>
