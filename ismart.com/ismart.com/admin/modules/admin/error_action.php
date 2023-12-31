<?php
$id = (int) $_GET['id'];
$list_admin = get_admin_status($id);
if (empty($list_admin)) {$_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=admin&act=info_account");
}

$status = $list_admin['status'] == 0 ? 1 : 0;
$update = get_admin_status($id);
$update = update("admin", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Update successful";
    redirect_to("?mod=admin&act=info_account");
} else {
    $_SESSION['error'] = "Data unchanged";
    redirect_to("?mod=admin&act=info_account");
}
?>