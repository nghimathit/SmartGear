<?php

$id = (int) $_GET['id'];
$sql = "update `users` set status = 0 where user_id = $id";
$list_users = array();
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_users[] = $row;
}
if ($list_users > 0) {
    $_SESSION['success'] = "Delete successfully";
    redirect_to("?mod=users&act=main");
} else {
    $_SESSION['error'] = "Delete failed";
    redirect_to("?mod=users&act=main");
}

?>
