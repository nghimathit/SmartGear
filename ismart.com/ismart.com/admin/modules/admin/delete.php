<?php
$id = (int)$_GET['id'];
$sql = "delete from admin where id = $id";
$list_admin = array();
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
        $list_admin[] = $row;
    }
    if ($list_admin > 0) {
        $_SESSION['success'] = "Xóa thành công";
        redirect_to("?mod=admin&act=info_account");
    } else {
        $_SESSION['error'] = "Xóa thất bại";
        redirect_to("?mod=admin&act=info_account");
    }
?>