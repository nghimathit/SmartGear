<?php

$id = (int) $_GET['id'];
$list_bill = get_bill_id($id);
if (empty($list_bill)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=bill&act=list_order");
}
$num_bill_detail = deletebill_detail("bill_detail",$id);// xóa detail trc
$num = deletebill("bill", $id);

if ($num > 0) {
    $_SESSION['success'] = "Hủy thành công";
    redirect_to("?mod=bill&act=list_order");
} else {
    $_SESSION['error'] = "Hủy thất bại";
    redirect_to("?mod=bill&act=list_order");
}
?>