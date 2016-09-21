<?php
/**
 * Template Name: Artist
 */
$pid = $post->ID;
$postname = $post->post_title;
?>
<script>
jQuery( document ).ready(function($) {
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

// //Press-expand
//   $('.more-press').toggle(function() {
//       $('.artist-press').addClass("expand");
//       $('.expand-press').removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
//
//     }, function () {
//   $(".artist-press").removeClass("expand");
//   $('.expand-press').removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
//   });
//
//   //Events-expand
//   $('.more-events').toggle(function() {
//       $('.artist-events').addClass("expand");
//       $('.expand-events').removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
//
//     }, function () {
//   $(".artist-events").removeClass("expand");
//   $('.expand-events').removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
//   });

})
</script>

<?php while (have_posts()) : the_post(); ?>
  <!-- Image for Header -->
  <div class="artist-page-container">
    <img src="<?php echo get('image'); ?>">
    <?php get_template_part('templates/page', 'header'); ?>
  </div>

  <div class="container">
  <!-- <?php get_template_part('templates/content', 'page'); ?> -->
    <div class="row">

      <!-- Selected work -->
      <div class="col-lg-8">
        <h4>Selected Work</h4>
        <img id="artist-page-carousel-demo" src="<?php echo get('selected_image'); ?>">
  <!-- <?php echo get('selected_caption'); ?> -->
      </div>

      <!-- Biography -->
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 pull-right-lg">
        <h4>Biography</h4>
        <div class="artist-biography">
        <?=get('bio');?>
        </div>
        <button  type="button" class="btn btn-link expand-arrow pull-right" >
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
                <div class="col-sm-6 col-md-6 col-lg-5 pull-right-md pull-left-lg">
                  <h4>Press</h4>
                  <div class="artist-press">
                  <?
          						foreach ($press as $year => $pressArray) : //print_r($exhibition);

          						$count = 1;
          							foreach ($pressArray as $press) :
          							$yearGroup = ($count == 1) ? $year : "";
          							$count++;

          					?>

          		<div style="margin-bottom:10px;"><b><?=$yearGroup;?></b></div>
              <div style="margin-bottom:10px;"><b><a href="<?=$press['id'];?>"><?=$press['title'];?></a></b> <?php edit_post_link("[edit]", "<br/>"); ?><span class="exdate"><i><?=$press['subhead'];?></i> <?=$press['date'];?></span></div>

            <? endforeach; endforeach; ?>
          </div>
            <button  type="button" class="btn btn-link expand-arrow pull-right" >
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

          <div class="col-sm-5 col-md-6 col-lg-3">
              <h4>Publications</h4>
              <div class="artist-publications">
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
                  </div>
                <? endforeach; ?>
              </div>
              <button  type="button" class="btn btn-link expand-arrow pull-right" >
                <span class="glyphicon glyphicon-menu-down"></span>
              </button>
            </div>
            <? else: endif;?>

      <!-- Events -->
      <? query_posts('cat=1&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1');
      if (have_posts()) : ?>
      <div class="col-sm-5 col-md-6 col-lg-4">
        <h4>Events</h4>
        <div class="artist-events">
        <? while (have_posts()) : the_post(); ?>
          <a href="<? the_permalink();?>"><? the_title(); ?></a><br/><br/>
          <? edit_post_link("[edit]", "<br/>"); ?>
        <? endwhile;?>
      </div>
      <button  type="button" class="btn btn-link expand-arrow pull-right" >
        <span class="glyphicon glyphicon-menu-down"></span>
      </button>
      </div>
      <? endif; wp_reset_query();?>



</div>
<?php endwhile; ?>
