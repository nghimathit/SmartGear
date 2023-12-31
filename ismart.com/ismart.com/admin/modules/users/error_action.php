<?php
$id = (int) $_GET['id'];
$list_users = get_users_status($id);
if (empty($list_users)) {
    $_SESSION['error']= "Data does not exist";
    redirect_to("?mod=users&act=main");
}

$status = $list_users['status'] == 0 ? 1 : 0;
$update = get_users_status($id);
$update = update("users", array("status" => $status), array("user_id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Update successful";
    redirect_to("?mod=users&act=main");
} else {
    $_SESSION['error'] = "Data unchanged";
    redirect_to("?mod=users&act=main");
}
?>