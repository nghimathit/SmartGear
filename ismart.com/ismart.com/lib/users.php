<?php
function check_login($username, $password) {
//chỉnh sửa biến toàn cục bên trong 1 hàm thì sử dụng GLOBAL 
//    global $list_users;
//    foreach ($list_users as $user) {
//        if ($username == $user['username'] && md5($password) == $user['password']) {
//            return true;
//        }
//    }
//    return false;
//    
}
function user_exists($username, $email) {
    $check_user = db_num_rows("select * from `users` where `username` = '{$username}' or `email` = '{$email}'");
    echo $check_user;
    if ($check_user > 0)
        return TRUE;
    return FALSE;
}

function add_user($data) {
    return db_insert('users', $data);
}
//Trả về true nếu đã login
function is_login() {
    if (isset($_SESSION['is_login']))
        return TRUE;
    return FALSE;
}

//Trả về username của người đã login
function user_login() {
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return FALSE;
}
function id_user() {
    $list_users = db_fetch_array("SELECT * FROM `users` where status = 1");
    foreach ($list_users as $user) {
    if(($_SESSION['user_login']) == $user['username']){
        return $user["user_id"];
    }
}
// function get_id($user_login){
//     $result = db_fetch_row("select user_id from users where username like {$user_login}'");
//     return $result;
// }
}
function get_bill_user($start, $num_per_page) {
    $user_id = id_user();
    $result = db_fetch_array("SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id
     FROM bill_detail,bill, product 
     WHERE
     bill.user_id = '{$user_id}' 
     AND bill.bill_id = bill_detail.bill_id 
     AND product.id = bill_detail.product_id 
     and bill_detail.status != 2 
     GROUP by bill.bill_id
      LIMIT {$start}, {$num_per_page}");
    return $result;   
}

function info_user($field = 'id') { //$field:trường
    $list_users = db_fetch_array("SELECT * FROM `users` where status = 1");
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            if ($_SESSION['user_login'] == $user['username']) {
                if (array_key_exists($field, $user)) {
                    return $user[$field];
                }
            }
        }
    }
    return FALSE;
}
function get_bill_detail_id($id){
    $result = db_fetch_array("SELECT * FROM `bill_detail` where bill_id = $id");
    return $result;
}
function show_gender($gender) {
    $list_gender = array(
        'male' => 'Nam',
        'female' => 'Nữ'
    );
    if (array_key_exists($gender, $list_gender)) {
        return $list_gender[$gender];
    }
}
// lấy active_token để ktra xem email có tồn tai hay k
function active_user($active_token) {
    return db_update('users', array('is_active' => 1), "`active_token`='{$active_token}'");
}

function check_active_token($active_token) {
    $check = db_num_rows("select * from `users` where `active_token` = '{$active_token}' and `is_active` = '0'");
    if ($check > 0)
        return true;
    return false;
}

// ktr email có tồn tai hay k để lấy lai mật khẩu
function update_reset_token($data, $email) {
    return db_update('users', $data, "`email`='{$email}'");
}
function update_users($data){
    return db_update('users', $data);
}

function check_email($email) {
    $check = db_num_rows("select * from `users` where `email` = '{$email}'");
    if ($check > 0)
        return true;
    return false;
}

// ktra mã token để đổi mật khẩu

function update_pass($data , $reset_token){
    return db_update('users', $data, "`reset_token`='{$reset_token}'");
}
function check_reset_token($reset_token) {
    $check = db_num_rows("select * from `users` where `reset_token` = '{$reset_token}'");
    if ($check > 0)
        return true;
    return false;
}
function get_list_users_cat($user_login){
    $result = db_fetch_row("select * from users where username like '{$user_login}'");
    return $result;
}


function get_bill_id($bill_id){
    $result = db_fetch_row("SELECT * FROM `bill` where bill_id = $bill_id");
    return $result;
}
function deletebill_detail($table, $id)  {
    global $conn;
    $sql = "DELETE FROM {$table} WHERE bill_id = $id ";
    mysqli_query($conn, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
function deletebill($table, $id) {
    global $conn;
    $sql = "DELETE FROM {$table} WHERE bill_id = $id ";
//    print_r($sql);
//    
//    die();
    mysqli_query($conn, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
?>

