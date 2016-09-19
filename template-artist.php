<?php
/**
 * Template Name: Artist
 */
$pid = $post->ID;
$postname = $post->post_title;
?>
<script>
jQuery( document ).ready(function($) {
  $('.more-biography').toggle(function() {
      $('.artist-biography').addClass("expand");
      $('.expand-biography').removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
      $('.cheat').removeClass("clearfix");

    }, function () {
  $(".artist-biography").removeClass("expand");
  $('.expand-biography').removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
  $('.cheat').addClass("clearfix");
  });

//Press-expand
  $('.more-press').toggle(function() {
      $('.artist-press').addClass("expand");
      $('.expand-press').removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");

    }, function () {
  $(".artist-press").removeClass("expand");
  $('.expand-press').removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
  });

  //Events-expand
  $('.more-events').toggle(function() {
      $('.artist-events').addClass("expand");
      $('.expand-events').removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");

    }, function () {
  $(".artist-events").removeClass("expand");
  $('.expand-events').removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
  });

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
      <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 pull-right-lg">
        <h4>Biography</h4>
        <div class="artist-biography">
        <?=get('bio');?>
        </div>
        <button  type="button" class="btn btn-link more-biography pull-right" >
          <span class="glyphicon glyphicon-menu-down expand-biography expand-arrow"></span>
        </button>
        </div>
        <div class="cheat clearfix visible-lg-block"></div>
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
                <div class="col-md-6 col-lg-4">
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
            <button  type="button" class="btn btn-link more-press pull-right" >
              <span class="glyphicon glyphicon-menu-down expand-arrow expand-press"></span>
            </button>
          </div>

          <? endif; ?>

      <!-- Publications -->
      <?
      query_posts('post_parent=35&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1&post_type=page');

      if (have_posts()) : while (have_posts()) : the_post();

      $args = array("h" => 150, "w" => 130);
      $itemsArray[] = array(
        'title'=>get_the_title(),
        'artists'=>get_field_duplicate('related_artist'),
        'permalink'=>get_permalink(),
        'thumb'=>get_image('image',1,1,1,NULL,$args),
        'year'=>get('year')
      );

      endwhile; endif; wp_reset_query();

      if(count($itemsArray)) :
        $itemsChunk = array_chunk($itemsArray,3,true);
        foreach ($itemsChunk as $items) :
      ?>

        <div class="col-md-6 col-lg-4">
          <h4>Publications</h4>
            <div class="row">
              <? foreach ($items as $item) : //print_r($item);
                $artists = "";
                foreach ($item['artists'] as $artist) :
                  $artists .= get_the_title($artist)."<br/>";
                endforeach; ?>
                <div class="col-lg-6">
                  <a href="<?=$item['permalink'];?>"><?=$item['thumb'];?></a><br>
                  <span><a href="<?=$item['permalink'];?>" class="mmactive"><?=$item['title'];?></a><span class="exdate"><br><?=$artists;?><?=$item['year'];?></span></span></div>
                <? endforeach; ?>
              </div>
            <? endforeach; ?>
          </div>
        <? else: endif;?>


      <!-- Events -->
      <? query_posts('cat=1&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1');
      if (have_posts()) : ?>
      <div class="col-md-6 col-lg-4">
        <h4>Events</h4>
        <div class="artist-events">
        <? while (have_posts()) : the_post(); ?>
          <a href="<? the_permalink();?>"><? the_title(); ?></a><br/><br/>
          <? edit_post_link("[edit]", "<br/>"); ?>
        <? endwhile;?>
      </div>
      <button  type="button" class="btn btn-link more-events pull-right" >
        <span class="glyphicon glyphicon-menu-down expand-arrow expand-events"></span>
      </button>
      </div>
      <? endif; wp_reset_query();?>

</div>
<?php endwhile; ?>
