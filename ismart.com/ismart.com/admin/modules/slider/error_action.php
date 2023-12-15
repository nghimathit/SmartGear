<?php
$id = (int) $_GET['id'];
$list_slider = get_slider_id($id);
if (empty($list_slider)) {
    $_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=slider&act=list_slider");
}

$status = $list_slider['status'] == 0 ? 1 : 0;
$update = get_slider_id($id);
$update = update("slider", array("status" => $status), array("id" => $id));
if ($update > 0) {
    $_SESSION['success'] = "Update successful";
    redirect_to("?mod=slider&act=list_slider");
} else {
    $_SESSION['error'] = "Data does not change";
    redirect_to("?mod=slider&act=list_slider");
}
?>