<?php

//$open = "post_cat";
$id = (int) $_GET['cat_id'];
$list_post_cat = get_post_cat_id($id);
if (empty($list_post_cat)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=post_cat&act=main");
}

$status = $list_post_cat['status'] == 0 ? 1 : 0;
$update = get_post_cat_id($id);
$update = update("post_cat", array("status" => $status), array("cat_id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Cập nhật thành công";
    redirect_to("?mod=post_cat&act=main");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirect_to("?mod=post_cat&act=main");
}
?>