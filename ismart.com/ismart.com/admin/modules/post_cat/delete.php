<?php

$id = (int) $_GET['id'];
$list_post_cat = get_post_cat_id($id);
if (empty($list_post_cat)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=post_cat&act=main");
}

/**
 * 	kiểm tra xem rằng danh mục có sản phẩm chưa
 */
$sql = "select * from post where cat_id = $id LIMIT 1";
$list_post = array();
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_post[] = $row;
}


if ($list_post == NULL) {
//    $num = deletecategory("category", $id);
    $sql = "delete from post_cat where cat_id = $id";
    $list_category = array();
    $result = mysqli_query($conn, $sql);
    // $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
        $list_category[] = $row;
    }
    if ($list_category > 0) {
        $_SESSION['success'] = "Delete successfully";
        redirect_to("?mod=post_cat&act=main");
    } else {
        $_SESSION['error'] = "Delete failed";
        redirect_to("?mod=post_cat&act=main");
    }
} else {
    $_SESSION['error'] = "Category has posts! You cannot delete";
    redirect_to("?mod=post_cat&act=main");
}
?>