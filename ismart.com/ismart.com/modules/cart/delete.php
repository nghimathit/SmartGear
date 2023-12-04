<?php
// Xóa sản phẩm nào
$id = (int) $_GET['id'];
delete_cart($id);
redirect_to("?mod=cart&act=show") // chuyển hướng
?>

