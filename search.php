<div class = "search-container">
<?php
$add_value = true;
$query_array = array();
$query_for_posts = "page_id=";
$search_guery = $_GET['s'];
$search_results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_value LIKE '%" . $search_guery ."%' ORDER BY post_id");

if(!empty($search_results))
{
    foreach ($search_results as $search_result) 
    {
        //loop through results
        for($i=0;$i<sizeof($query_array);$i++)
        {
            //check if post id in the array
            if($search_result->post_id == $query_array[$i])
                $add_value = false;
        }
        if($add_value)
        {
            //add the post id to the array if not a duplicate
            array_push($query_array, $search_result->post_id);
            //also add id for WP_Query
            $query_for_posts .= $search_result->post_id . ",";
        }
        $add_value = true;
    }
}


if(!empty($query_array))
{
    for($i=0;$i<sizeof($query_array);$i++)
    {
        //get post from array of ids
        $post = get_page($query_array[$i]);
        //make sure the post is published
        if($post->post_status == 'publish')
            echo '<h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>';
    }
	
}

else{
	?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
	<?php } ?>
