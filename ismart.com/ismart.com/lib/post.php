<?php

function get_list_cat_post_by_cat_id($cat_id) {
    $result = db_fetch_array("SELECT * FROM post,post_cat where post.cat_id = post_cat.cat_id and post.cat_id= {$cat_id} and post.status = 1 and post_cat.status = 1");
    
    return $result;
}
function get_post_cat($start, $num_per_page, $id) {
    $result = db_fetch_array("SELECT * FROM `post` where cat_id = {$id} and status = 1 LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_list_post_cat($id){
    $result = db_fetch_row("SELECT * FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and id={$id} and status = 1");
    return $result;
}
function get_post(){
    $result = db_fetch_array("SELECT * FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status = 1 and post_cat.status = 1 and featured_posts = 'Nổi bật'");
    return $result;
}