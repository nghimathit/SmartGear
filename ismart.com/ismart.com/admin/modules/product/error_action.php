<?php
$id = (int) $_GET['id'];
$list_product = get_product_status($id);
if (empty($list_product)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=product&act=main");
}

$status = $list_product['status'] == 0 ? 1 : 0;
$update = get_product_status($id);
$update = update("product", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Cập nhật thành công";
    redirect_to("?mod=product&act=main");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirect_to("?mod=product&act=main");
}
?>