<?php
$id = (int)$_GET['id'];
$sql = "update `post` set status = 0 where id = $id";
$list_post = array();
$result = mysqli_query($conn, $sql);
// $num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_post[] = $row;
}

if ($list_post > 0) {
    $_SESSION['success'] ="Delete successfully";
    redirect_to("?mod=post&act=main");
} else {
    $_SESSION['error'] = "Delete failed";
    redirect_to("?mod=post&act=main");
}
?>
