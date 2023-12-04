<?php
function get_list_slider(){
    $sql = "select * from slider";
    $result = db_fetch_array($sql);
    return $result;
}
// phân trang
function get_slider($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `slider` where status != 2 LIMIT {$start}, {$num_per_page}");
    return $result;
}
function get_slider_id($id){
    $result = db_fetch_row("SELECT * FROM `slider` where id = $id");
    return $result;
}
function check_slider_exists($slider_name) {
    $check_slider = db_num_rows("select * from `slider` where `slider_name` = '{$slider_name}'");
    echo $check_slider;
    if ($check_slider > 0)
        return TRUE;
    return FALSE;
}

