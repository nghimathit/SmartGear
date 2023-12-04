<?php
session_start();
ob_start();

//if (isset($_COOKIE['is_login_admin_admin'])) { // ktra dữ liệu
//    echo "{$_COOKIE['user_login_admin']}"; // lấy ra cookie
////    echo "Cookie:{$_COOKIE['user_login_admin']}"; // lấy ra cookie
//}

require 'db/connect.php';
require 'db/database.php';
//Function: thư viện hàm
require 'lib/function.php';
require 'lib/validation.php';
require 'lib/data.php';
require 'lib/url.php';
require 'lib/template.php';
require 'lib/number.php';
require 'lib/users.php';
require 'lib/pagging.php';
require 'lib/product.php';
require 'lib/post.php';
require 'lib/bill.php';
require 'lib/cat.php';
require 'lib/slider.php';
?>


<?php

$mod = !empty($_GET['mod']) ? $_GET['mod'] : 'home';
$act = !empty($_GET['act']) ? $_GET['act'] : 'main'; // action: hanh` dong
$path = "modules/{$mod}/{$act}.php";


if (!is_login_admin() && $mod != 'login_admin' && $act != 'login_admin') {
    redirect_to("?mod=admin&act=login_admin");
} 


if (file_exists($path)) {
    require $path;
} else {
    require './inc/404.php';
}
?>