<?php
$id = (int) $_GET['id'];
$list_admin = get_admin_status($id);
if (empty($list_admin)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=admin&act=info_account");
}

$status = $list_admin['status'] == 0 ? 1 : 0;
$update = get_admin_status($id);
$update = update("admin", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Cập nhật thành công";
    redirect_to("?mod=admin&act=info_account");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirect_to("?mod=admin&act=info_account");
}
?>