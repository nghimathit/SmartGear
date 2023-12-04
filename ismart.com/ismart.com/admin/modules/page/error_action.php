<?php
$id = (int) $_GET['id'];
$list_page = get_page_id($id);
if (empty($list_page)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=page&act=main");
}

$status = $list_page['status'] == 0 ? 1 : 0;
$update = get_page_id($id);
$update = update("page", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Cập nhật thành công";
    redirect_to("?mod=page&act=main");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirect_to("?mod=page&act=main");
}
?>