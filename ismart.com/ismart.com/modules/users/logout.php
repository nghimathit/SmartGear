<?php

# Hủy cookie
//setcookie('is_login', true, time() - 3600); 
//setcookie('user_logn', $username, time() - 3600);

# Xử lý logout
unset($_SESSION['is_login']);
unset($_SESSION['user_login']);
unset($_SESSION['cart']['buy']);

redirect_to('?mod=users&act=login');
?>