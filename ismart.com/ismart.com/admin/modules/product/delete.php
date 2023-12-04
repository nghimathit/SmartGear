<?php

$id = (int) $_GET['id'];
$sql = "update `product` set status = 0 where id = $id";
$list_product = array();
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_product[] = $row;
}

if ($list_product > 0) {
    $_SESSION['success'] = "Xóa thành công";
    redirect_to("?mod=product&act=main");
} else {
    $_SESSION['error'] = "Xóa thất bại";
    redirect_to("?mod=product&act=main");
}
?>