<?php

$active_token = $_GET['active_token'];
$link_login = base_url("?mod=users&act=login");
if (check_active_token($active_token)) {
    active_user($active_token);
    echo "You have successfully activated, please click here to log in <a href= '{$link_login}'>Sign in</a>";
} else {
    echo "Invalid activation request or account has been activated before, please click here to log in <a href= '{$link_login}'>Log in</a>";
}
?>
