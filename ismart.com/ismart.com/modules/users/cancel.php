<?php

$id = (int) $_GET['id'];
$list_bill = get_bill_id($id);
if (empty($list_bill)) {
    $_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=users&act=view");
}
$num_bill_detail = deletebill_detail("bill_detail",$id);// delete previous detail
$num = deletebill("bill", $id);

if ($num > 0) {
    $_SESSION['success'] = "Cancellation successful";
    redirect_to("?mod=users&act=view");
} else {
    $_SESSION['error'] = "Cancel failed";
    redirect_to("?mod=users&act=view");
}
?>