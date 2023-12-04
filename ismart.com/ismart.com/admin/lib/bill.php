<?php
function get_list_bill(){
    $result = db_fetch_array("SELECT bill.fullname,bill.note,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id GROUP by bill.bill_id");
    return $result;
}
function get_list_bill_id($id){
    $result = db_fetch_row("SELECT * FROM `bill` where bill_id = $id");
    return $result;
}
function get_list_bill_detail_id($id){
    $result = db_fetch_array("SELECT * FROM `bill_detail` where bill_id = $id");
    return $result;
}

function get_list_product($id) {
    $result = db_fetch_array("SELECT * FROM `product` where id = $id");
    return $result;
}
function get_list_number($id) {
    $result = db_fetch_array("SELECT * FROM `product`,`bill_detail` where product.id = bill_detail.product_id");
    return $result;
}
function get_bill($start, $num_per_page) {
    $result = db_fetch_array("SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status != 2 GROUP by bill.bill_id LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_bill_status($start, $num_per_page) {
    $result = db_fetch_array("SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status = 1 GROUP by bill.bill_id LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_search_bill($start, $num_per_page, $keyword = "") {
    $result = db_fetch_array("SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status !=2 and bill.fullname like N'%$keyword%' GROUP by bill.bill_id LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_bill_id($bill_id){
    $result = db_fetch_row("SELECT * FROM `bill` where bill_id = $bill_id");
    return $result;
}

function bill_total($username, $email) {
    $check_user = db_num_rows("select * from `bill_detail`");
    echo $check_user;
    if ($check_user > 0)
        return TRUE;
    return FALSE;
}

function get_total($item) {
    $total = 0;
    $result = db_fetch_array("SELECT * FROM `bill_detail` WHERE bill_id = $id");
    $total = $total + $item['sub_total'];
    return $result;
}
function active_order($id) {
    return db_update('bill_detail', array('status' => 1), "`id`='{$id}'");
}
function check_active_order($id) {
    $check = db_num_rows("select * from `bill_detail` where `id` = '{$id}' and `status` = '0'");
    if ($check = 0)
        return true;
    return false;
}
?>

