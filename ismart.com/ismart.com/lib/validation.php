<?php

function is_username($username) {
    $partten = "/^[A-Za-z0-9_\.]{4,20}$/";
    if (!preg_match($partten, $username, $matchs))
        return FALSE;
    return TRUE;
}

function is_password($password) {
    $partten = "/^[A-Za-z0-9_\.!@#$%^&*()]{4,20}$/";
    if (!preg_match($partten, $password, $matchs))
        return FALSE;
    return TRUE;
}
function is_email($email) {
    $partten = "/^[A-Za-z0-9_.]{2,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (!preg_match($partten, $email, $matchs))
        return FALSE;
    return TRUE;
}
function is_phone_number($number){
    $partten = "/^(09|08|03)+([0-9]{8})$/";
    if (!preg_match($partten, $number, $matchs))
        return FALSE;
    return TRUE;
}
# --label_field: nhãn
function form_error($label_field){//$label_field: là tên của trường
    global $error;
    if (!empty($error[$label_field])) return "<p class='error'>{$error[$label_field]}</p>";
// Function form_error dùng để hiển thị thông báo cho người dùng...
}

function set_value($label_field){//$label_field: là tên của trường (fullname) đóng vai trò 1 chuỗi
    global $$label_field;// $ dùng để khai báo biến
    //$label_field là tên biến, tên biến nhé vdu như username hay fullname
    if(!empty($$label_field)) return $$label_field;
 // Function set_value dùng để lưu dữ liệu khi nhập vào, méo cần nhập lại! Mệt
}
?>
