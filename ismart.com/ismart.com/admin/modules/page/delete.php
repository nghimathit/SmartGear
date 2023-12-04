<?php

$id = (int) $_GET['id'];
$sql = "update `page` set status = 2 where id = $id";
$list_page = array();
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_page[] = $row;
}
if ($list_page > 0) {
    $_SESSION['success'] = "Xóa thành công";
    redirect_to("?mod=page&act=main");
} else {
    $_SESSION['error'] = "Xóa thất bại";
    redirect_to("?mod=page&act=main");
}
?>
