<?php
/**
 * Template Name: Artist
 */
$pid = $post->ID;
$postname = $post->post_title;

?>
<?php while (have_posts()) : the_post(); ?>
  <!-- Image for Header -->
  <div class="artist-page-container">
    <img src="<?php echo get('image'); ?>">
    <?php get_template_part('templates/page', 'header'); ?>
  </div>

  <div class="container">
  <!-- <?php get_template_part('templates/content', 'page'); ?> -->
    <div class="row">
      <div class="col-xs-12 col-lg-8">
        <h4>Selected Work</h4>
        <img id="artist-page-carousel-demo" src="<?php echo get('selected_image'); ?>">
  <!-- <?php echo get('selected_caption'); ?> -->
      </div>
      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-4" id="artist-biography">
        <h4>Biography</h4>
        <?=get('bio');?>
      </div>
      
      <!-- Press -->
      <div class="col-lg-4">
        <h4>Press</h4>
        <?

        if ($pressID) :
          query_posts('name='.$pressID.'&post_type=page');
          the_post(); ?>

          <table border="0" cellspacing="0" cellpadding="0" width="480">
              <tr>
                <td class="copy">
                  <a class="print" href="#" onclick="window.print();"><img src="<?=FILES;?>/img/print.gif"></a>

                  <br><span class="print">&nbsp;</span><br><span class="print">&nbsp;</span><br>

                  <? if (get('url')) : ?>
                  <a href="<?=get('url');?>" target="_blank"><? the_title();?></a>
                  <? else : ?>
                  <? the_title();?>
                  <? endif;?>
                  <br><? the_time('F d, Y');?>
                  <?php edit_post_link("[edit]", "<br/>"); ?>
                  </td>
              </tr>

              <tr>
                <td><img src="<?=FILES;?>/img/sp.gif" width="1" height="30" alt=""></td>
              </tr>
              <tr>
                <td class="divider"><img src="<?=FILES;?>/img/sp.gif" width="1" height="6" alt=""></td>
              </tr>
              <tr>
                <td><img src="<?=FILES;?>/img/sp.gif" width="1" height="30" alt=""></td>
              </tr>

              <tr>
                <td class="copy">
                <div class="content"><?=the_content();?></div>
                </td>

              </tr>
            </table>

        <? else :

          query_posts('post_parent=61&meta_key=artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1&post_type=page');

          if (have_posts()) : while (have_posts()) : the_post();

          $year = get_the_time('Y');

          $press[$year][] = array(
            'title' 	=> get_the_title(),
            'id' 		=> $post->post_name,
            'date'		=> get_the_time('F d, Y'),
            'subhead'	=> get('subhead')

          );  endwhile; endif; wp_reset_query();?>



          			<? if (is_array($press)) :
          						foreach ($press as $year => $pressArray) : //print_r($exhibition);

          						$count = 1;
          							foreach ($pressArray as $press) :
          							$yearGroup = ($count == 1) ? $year : "";
          							$count++;

          					?>

          		<div style="margin-bottom:10px;"><b><?=$yearGroup;?></b></div>
          <div style="margin-bottom:10px;"><b><a href="?press=<?=$press['id'];?>" class="mmactive"><?=$press['title'];?></a></b> <?php edit_post_link("[edit]", "<br/>"); ?><span class="exdate"><i><?=$press['subhead'];?></i> <?=$press['date'];?></span></div>

          					<? endforeach; endforeach; endif; ?>

      <? endif ?>


      </div>

<!-- Publications -->
<div class="col-lg-4">
  <h4>Publications</h4>


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
<div class="row">
<?


foreach ($items as $item) :
//print_r($item);
$artists = "";
foreach ($item['artists'] as $artist) :
$artists .= get_the_title($artist)."<br/>";
endforeach;

?>
  <div class="col-lg-6">
  <a href="<?=$item['permalink'];?>"><?=$item['thumb'];?></a><br>
  <span><a href="<?=$item['permalink'];?>" class="mmactive"><?=$item['title'];?></a><span class="exdate"><br><?=$artists;?><?=$item['year'];?></span></span></div>
<?

endforeach;


?>
</div>
<?
endforeach;

else :

echo "There are no Publications available at this time.";

endif;
?>

</div>

<!-- Events -->
<div class="col-lg-4">
  <h4>Events</h4>
  <?
  query_posts('cat=1&meta_key=related_artist&meta_value='.$pid.'&orderby=date&order=DESC&showposts=-1');
  if (have_posts()) : while (have_posts()) : the_post();
  ?>

    <a href="<? the_permalink();?>"><? the_title(); ?></a><br/>
    <? the_time('m d, Y');?>
    <? edit_post_link("[edit]", "<br/>"); ?>
    <? endwhile; endif; wp_reset_query();?>
  </div>

  </div>
<div>
<?php endwhile; ?>
