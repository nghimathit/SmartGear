<?php

//$open = "post_cat";
$id = (int) $_GET['cat_id'];
$list_post_cat = get_post_cat_id($id);
if (empty($list_post_cat)) {
    $_SESSION['error'] = "Data does not exist";
    redirect_to("?mod=post_cat&act=main");
}

$status = $list_post_cat['status'] == 0 ? 1 : 0;
$update = get_post_cat_id($id);
$update = update("post_cat", array("status" => $status), array("cat_id" => $id));
if ($update > 0) {
    $_SESSION['success'] ="Update successful";
    redirect_to("?mod=post_cat&act=main");
} else {
    $_SESSION['error'] = "Data unchanged";
    redirect_to("?mod=post_cat&act=main");
}
?>