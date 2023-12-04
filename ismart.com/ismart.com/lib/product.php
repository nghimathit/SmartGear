<?php
// trang chủ để lấy giới han hiển thi 12 sp
function get_list_product_by_cat_id($cat_id) {
    $result = db_fetch_array("SELECT *,product.created_at FROM `product`,category WHERE product.cat_id = category.cat_id and product.cat_id = {$cat_id} and category.status = 1 and product.status = 1 ORDER by product.created_at DESC limit 8");
    return $result;
}

function get_list_cat_product_by_cat_id($cat_id) {
    $result = db_fetch_array("SELECT *,product.created_at FROM `product`,category WHERE product.cat_id = category.cat_id and product.cat_id = {$cat_id} and category.status = 1 and product.status = 1 ORDER by product.created_at DESC "  );
    return $result;
}

// lấy danh muc sản phẩm theo cat_id
function get_info_cat($cat_id) {
    $result = db_fetch_row("SELECT * FROM `category` WHERE `cat_id` = {$cat_id} and status = 1");
    return $result;
}

// lấy sản phẩm đổ vào detail
function get_product_by_id($id) {
    $result = db_fetch_row("SELECT * FROM `product` WHERE `id` = {$id} and status = 1");
    return $result;
}

// sản phẩm nổi bật
function get_product_highlights() {
    $result = db_fetch_array("SELECT *,product.created_at FROM `product`,`category` WHERE product.cat_id = category.cat_id and product.featured_products='Nổi bật' and product.status = 1 and category.status = 1");
    return $result;
}

// sản phẩm bán chạy
function get_selling_products() {
    $result = db_fetch_array("SELECT * FROM `product` ,`category` WHERE product.cat_id = category.cat_id and `selling_products` = 'Bán chạy' and product.status = 1 and category.status = 1");
    return $result;
}

// sắp xếp sp
function get_default_sorting() {
    $result = db_fetch_array("SELECT * FROM `sort` where status = 1");
    return $result;
}

//phân trang
function get_product($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `product` where status = 1 LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_search_product($start, $num_per_page,$keyword) {
    $result = db_fetch_array("select *,product.created_at from product, category where product.cat_id = category.cat_id and category.status = 1 and product.status = 1 and product_name like N'%{$keyword}%' ORDER by product.created_at DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_product_categoryes($start, $num_per_page, $id) {
    $result = db_fetch_array("SELECT * FROM `product` where cat_id = {$id} and status = 1 ORDER by product.created_at DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// giá từ cao xuống ----------------------------------------------------------thấp
function get_highlow() {
    $sql = "SELECT * FROM product where status = 1 ORDER BY price_new DESC";
    $result = db_fetch_array($sql);
    return $result;
}

function get_product_highlow_cate($start, $num_per_page, $id) {
    $result = db_fetch_array("SELECT * FROM product where cat_id= $id and status = 1  ORDER BY price_new DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_product_highlow($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM product where and status = 1  ORDER BY price_new DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// giá từ thấp lên ----------------------------------------------------------cao
function get_lowhigh() {
    $sql = "SELECT * FROM product where status = 1 ORDER BY price_new ASC";
    $result = db_fetch_array($sql);
    return $result;
}

function get_product_lowhigh_cate($start, $num_per_page, $id) {
    $result = db_fetch_array("SELECT * FROM product where cat_id={$id} and status = 1  ORDER BY price_new ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_product_lowhigh($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM product where status = 1  ORDER BY price_new ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Tên sp từ A----------------------------------------------------------Z
function get_A_Z() {
    $sql = "SELECT * FROM product where status = 1 ORDER BY `product_name` ASC";
    $result = db_fetch_array($sql);
    return $result;
}

function get_product_A_Z_cate($start, $num_per_page, $id) {
    $result = db_fetch_array("SELECT * FROM product where cat_id={$id} and status = 1 ORDER BY `product_name` ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_product_A_Z($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM product where status = 1 ORDER BY `product_name` ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Tên sp từ Z----------------------------------------------------------A
function get_Z_A() {
    $sql = "SELECT * FROM product where status = 1 ORDER BY `product_name` DESC";
    $result = db_fetch_array($sql);
    return $result;
}

function get_product_Z_A_cate($start, $num_per_page, $id) {
    $result = db_fetch_array("SELECT * FROM product where cat_id={$id} and status = 1 ORDER BY `product_name` DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}

function get_product_Z_A($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM product where status = 1 ORDER BY `product_name` DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}
?>

