<?php

$active_token = $_GET['active_token'];
$link_login = base_url("?mod=users&act=login");
if (check_active_token($active_token)) {
    active_user($active_token);
    echo "Bạn đã kích hoạt thành công, vui lòng click vào đây để đăng nhập <a href= '{$link_login}'>Đăng nhập</a>";
} else {
    echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó, vui lòng click vào đây để đăng nhập <a href= '{$link_login}'>Đăng nhập</a>";
}

?>
