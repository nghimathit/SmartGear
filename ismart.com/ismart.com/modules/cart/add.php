<?php

$id = (int) $_GET['id'];
$sl = $_GET['sl'];
// _debug($sl);die;
$sql = "SELECT * FROM `product` WHERE `id` = '{$id}'"; // lấy dữ liệu sp
$result = mysqli_query($conn, $sql);
$item = array(); // tạo 1 mảng $item
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $item = $row;
}
//show_array($item);
# Lấy đc thông tin SP cần thêm vào giỏ hàng
//
$_SESSION['cart']['buy'][$id] = add_cart($id, $item, $sl);
// show_array($_SESSION['cart']['buy'][$id]);
$_SESSION['cart']['info'] = update_info_cart();
redirect_to("?mod=cart&act=show"); // chuyển hướng
?>

