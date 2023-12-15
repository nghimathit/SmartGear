<?php

$id = (int) $_GET['id'];
//$sql = "SELECT * FROM `bill_detail` WHERE `id` = '{$id}'";
//$result = mysqli_query($conn, $sql);
//$list_bill_detail = array();
//$num_rows = mysqli_num_rows($result);
//if ($num_rows > 0) {
//    $row = $result->fetch_assoc();
//    $list_bill_detail[] = $row;
//}
$list_bill_detail = fetchID("bill_detail", $id);
if (empty($list_bill_detail)) {
    $_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=bill&act=list_order");
}
if ($list_bill_detail["status"] == 1) {
    $_SESSION['success'] = "Order has been processed";
    redirect_to("?mod=bill&act=list_order");
}
$status = 1;
$update = update("bill_detail", array("status" => $status), array("bill_id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Update successful";
    $sql = " SELECT * FROM bill_detail WHERE bill_id = $id";
    $order = fetchsql($sql);
    foreach ($order as $item) {
        $product_id = intval($item['product_id']);
        $product = fetchID_product("product", $product_id);

        $number = $product["qty_product"] - $item['qty'];
        $update_pro = update("product", array("qty_product" => $number), array("id" => $product_id));
    }
    redirect_to("?mod=bill&act=list_order");
} else {
    $_SESSION['error'] = "Data unchanged";
    redirect_to("?mod=bill&act=list_order");
}
?>