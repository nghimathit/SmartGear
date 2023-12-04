<?php
function get_post_cat_id($cat_id){
    $result = db_fetch_row("SELECT * FROM `post_cat` where cat_id = $cat_id");
    return $result;
}
function get_post_status($id){
    $result = db_fetch_row("SELECT * FROM `post` where id = $id");
    return $result;
}
function get_page_id($id){
    $result = db_fetch_row("SELECT * FROM `page` where id = $id");
    return $result;
}

function get_post($start, $num_per_page) {
    $result = db_fetch_array("SELECT *,post.id,post.status FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status != 2 LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_search_post($start, $num_per_page,$keyword="") {
    $result = db_fetch_array("SELECT *,post.id,post.status FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status != 2 and post_title like N'%$keyword%' LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_page($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `page` where status != 2 LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_search_page($start, $num_per_page, $keyword = "") {
    $result = db_fetch_array("select * from page where page_title like N'%$keyword%' or page_content like N'%$keyword%' LIMIT {$start}, {$num_per_page}");
    return $result;
}

function check_post_cat_exists($post_name) {
    $check_post_cat = db_num_rows("select * from `post_cat` where `post_name` = '{$post_name}'");
    echo $check_post_cat;
    if ($check_post_cat > 0)
        return TRUE;
    return FALSE;
}
function check_post_exists($post_title) {
    $check_post = db_num_rows("select * from `post` where `post_title` = '{$post_title}'");
    echo $check_post;
    if ($check_post > 0)
        return TRUE;
    return FALSE;
}
function check_page_exists($page_title) {
    $check_page = db_num_rows("select * from `page` where `page_title` = '{$page_title}'");
    echo $check_page;
    if ($check_page > 0)
        return TRUE;
    return FALSE;
}
//function get_update_post_cat_id($cat_id){
//    $result = db_fetch_row("SELECT * FROM `post_cat` where cat_id = $cat_id");
//    return $result;
//}
?>

