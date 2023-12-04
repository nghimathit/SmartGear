<?php
function get_list_price_under_10m($cat_id){
    $result = db_fetch_array("SELECT * FROM `product` WHERE cat_id = $cat_id and status = 1 and `price_new`< 10000000");
    return $result;
}
function get_list_price_10m_to_15m($cat_id){
    $result = db_fetch_array("SELECT * FROM `product` WHERE cat_id = $cat_id and status = 1 and `price_new`>= 10000000 and `price_new`<= 15000000");
    return $result;
}
function get_list_price_15m_to_20m($cat_id){
    $result = db_fetch_array("SELECT * FROM `product` WHERE cat_id = $cat_id and status = 1 and `price_new`>=15000000 and `price_new`<= 20000000");
    return $result;
}
function get_list_price_20m_to_25m($cat_id){
    $result = db_fetch_array("SELECT * FROM `product` WHERE cat_id = $cat_id and status = 1 and `price_new`>= 20000000 and `price_new`<= 25000000");
    return $result;
}
function get_list_price_on_25m($cat_id){
    $result = db_fetch_array("SELECT * FROM `product` WHERE cat_id = $cat_id and status = 1 and `price_new`> 25000000");
    return $result;
}


