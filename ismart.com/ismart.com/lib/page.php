<?php

function get_page($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status = 1 and post_cat.status = 1 LIMIT {$start}, {$num_per_page}");
    return $result;
}

?>

