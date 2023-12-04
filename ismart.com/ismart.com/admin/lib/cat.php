<?php
function get_product_cat($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `category` LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_search_product_cat($start, $num_per_page,$keyword="") {
    $result = db_fetch_array("select * from category where cat_name like N'%$keyword%' LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_post_cat($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `post_cat` where status != 2 LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_search_post_cat($start, $num_per_page,$keyword="") {
    $result = db_fetch_array("select * from post_cat where status != 2 and post_name like N'%$keyword%' LIMIT {$start}, {$num_per_page}");
    return $result;
}

?>

