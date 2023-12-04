<?php

$id = (int) $_GET['id'];
$list_product_cat = get_product_cat_id($id);
if (empty($list_product_cat)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirect_to("?mod=product_cat&act=main");
}

/**
 * 	kiểm tra xem rằng danh mục có sản phẩm chưa
 */
$sql = "select * from product where cat_id = $id LIMIT 1";
$list_product = array();
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_product[] = $row;
}


if ($list_product == NULL) {
//    $num = deletecategory("category", $id);
    $sql = "delete from category where cat_id = $id";
    $list_category = array();
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
        $list_category[] = $row;
    }
    if ($list_category > 0) {
        $_SESSION['success'] = "Xóa thành công";
        redirect_to("?mod=product_cat&act=main");
    } else {
        $_SESSION['error'] = "Xóa thất bại";
        redirect_to("?mod=product_cat&act=main");
    }
} else {
    $_SESSION['error'] = "Danh mục có sản phẩm ! Bạn không thể xóa";
    redirect_to("?mod=product_cat&act=main");
}
?>