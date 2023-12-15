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
        $_SESSION['success'] = "Delete successfully";
        redirect_to("?mod=admin&act=info_account");
    } else {
        $_SESSION['error'] = "Delete failed";
        redirect_to("?mod=admin&act=info_account");
    }
?>