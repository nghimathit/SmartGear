
<?php

$id = (int) $_GET['id'];
$data = array(
    'status' => 2
);
$list_bill = get_bill_id($id);
if (empty($list_bill)) {
    $_SESSION['error'] ="Data does not exist";
    redirect_to("?mod=bill&act=list_order");
}
$num_rows = update("bill", $data, array("bill_id" => $id));
$num_bill_detail = update("bill_detail", $data, array("bill_id" => $id));
if ($num_rows > 0) {
    $_SESSION['success'] = "Delete successfully";
    redirect_to("?mod=bill&act=list_order");
} else {
    $_SESSION['error'] = "Delete failed";
    redirect_to("?mod=bill&act=list_order");
}
?>