<?php
$id = (int) $_GET['id'];
$list_post = get_post_status($id);
if (empty($list_post)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=post&act=main");
}

$status = $list_post['status'] == 0 ? 1 : 0;
$update = get_post_status($id);
$update = update("post", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Cập nhật thành công";
    redirect_to("?mod=post&act=main");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirect_to("?mod=post&act=main");
}
?>