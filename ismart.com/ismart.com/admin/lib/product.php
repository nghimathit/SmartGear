<?php
// ktra giá
//function is_price($price) {
//    $pattern = "/^[0-9].{6,32}$/";
//    if (!preg_match($partten, $price, $matchs))
//        return FALSE;
//    return TRUE;
//}

// phân trang sản phẩm
function get_product($start, $num_per_page) {
    $result = db_fetch_array("SELECT *,product.id,product.status,product.created_at FROM `product`,`category` where product.cat_id = category.cat_id and product.status != 2 ORDER by product.created_at DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_search_product($start, $num_per_page,$keyword="") {
    $result = db_fetch_array("SELECT *,product.id,product.status FROM `product`,`category` where product.cat_id = category.cat_id and product.status != 2 and product_name like N'%$keyword%' ORDER by product.created_at DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_product_cat_id($cat_id){
    $result = db_fetch_row("SELECT * FROM `category` where cat_id = $cat_id");
    return $result;
}
function get_product_status($id){
    $result = db_fetch_row("SELECT * FROM `product` where id = $id");
    return $result;
}
function check_product_cat_exists($cat_name) {
    $check_product_cat = db_num_rows("select * from `category` where `cat_name` = '{$cat_name}'");
    echo $check_product_cat;
    if ($check_product_cat > 0)
        return TRUE;
    return FALSE;
}
function check_product_exists($product_name) {
    $check_product = db_num_rows("select * from `product` where `product_name` = '{$product_name}'");
    echo $check_product;
    if ($check_product > 0)
        return TRUE;
    return FALSE;
}
?>

