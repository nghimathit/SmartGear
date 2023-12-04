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

function add_user($data) {
    return db_insert('admin', $data);
}
//Trả về true nếu đã login
function is_login_admin() {
    if (isset($_SESSION['is_login_admin']))
        return TRUE;
    return FALSE;
}

//Trả về username của người đã login
function user_login_admin() {
    if (!empty($_SESSION['user_login_admin'])) {
        return $_SESSION['user_login_admin'];
    }
    return FALSE;
}

function info_user($field = 'id') { //$field:trường
    $list_users = db_fetch_array("SELECT * FROM `admin`");
    if (isset($_SESSION['is_login_admin'])) { // Nếu tồn tại is_login_admin
        foreach ($list_users as $admin) {
            if ($_SESSION['user_login_admin'] == $admin['username']) {
                if (array_key_exists($field, $admin)) {
//Nếu tồn tại id trong mảng $user =>
// array_key_exists: ktra 1 key có tồn tại trong mảng hay k
                    return $admin[$field];
                }
            }
        }
    }
    return FALSE;
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
function get_users($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM `users` where status != 2 LIMIT {$start}, {$num_per_page}");
    return $result;
}
// phân trang sản phẩm
function get_search_users($start, $num_per_page,$keyword="") {
    $result = db_fetch_array("SELECT * FROM `users` where status != 2 and fullname like N'%$keyword%' or email like N'%$keyword%' or address like N'%$keyword%' LIMIT {$start}, {$num_per_page}");
    return $result;
}
function check_users_exists($email) {
    $check_users = db_num_rows("select * from `users` where `email` = '{$email}'");
    echo $check_users;
    if ($check_users > 0)
        return TRUE;
    return FALSE;
}
function check_admin_exists($username,$email) {
    $check_admin = db_num_rows("select * from `admin` where `email` = '{$email}' or `username` = '{$username}' ");
    echo $check_admin;
    if ($check_admin > 0)
        return TRUE;
    return FALSE;
}
function check_password_old($pass_old) {
    $check_password_old = db_num_rows("select * from `admin` where `password` = '{$pass_old}'");
    echo $check_password_old;
    if ($check_password_old > 0)
        return TRUE;
    return FALSE;
}

function get_users_status($id){
    $result = db_fetch_row("SELECT * FROM `users` where user_id = $id");
    return $result;
}
function get_admin_status($id){
    $result = db_fetch_row("SELECT * FROM `admin` where id = $id");
    return $result;
}
?>

