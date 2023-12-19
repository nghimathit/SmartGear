<?php
$id = (int) $_GET['id'];
$list_product = get_product_status($id);
if (empty($list_product)) {
    $_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=product&act=main");
}

$status = $list_product['status'] == 0 ? 1 : 0;
$update = get_product_status($id);
$update = update("product", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] ="Update successful";
    redirect_to("?mod=product&act=main");
} else {
    $_SESSION['error'] = "Data unchanged";
    redirect_to("?mod=product&act=main");
}
?>