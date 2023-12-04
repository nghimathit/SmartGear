<?php


# Xử lý logout
unset($_SESSION['is_login_admin']);
unset($_SESSION['user_login_admin']);
unset($_SESSION['role']);
redirect_to('?mod=admin&act=login_admin');
?>