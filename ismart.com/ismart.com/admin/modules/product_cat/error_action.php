<?php

$id = (int) $_GET['cat_id'];
$list_product_cat = get_product_cat_id($id);
if (empty($list_product_cat)) {
    $_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=product_cat&act=main");
}

$status = $list_product_cat['status'] == 0 ? 1 : 0;
$update = get_product_cat_id($id);
$update = update("category", array("status" => $status), array("cat_id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Update successful";
    redirect_to("?mod=product_cat&act=main");
} else {
    $_SESSION['error'] = "Data unchanged";
    redirect_to("?mod=product_cat&act=main");
}
?>