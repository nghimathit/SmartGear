<?php
$id = (int) $_GET['id'];
$list_slider = get_slider_id($id);
if (empty($list_slider)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=slider&act=list_slider");
}

$status = $list_slider['status'] == 0 ? 1 : 0;
$update = get_slider_id($id);
$update = update("slider", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Cập nhật thành công";
    redirect_to("?mod=slider&act=list_slider");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirect_to("?mod=slider&act=list_slider");
}
?>