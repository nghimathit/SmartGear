<?php
get_header();
?>
<?php

if (isset($_POST['btn_login'])) {

    $error = array();
    //ktra username
    if (empty($_POST['username'])) {
        $error['username'] = "Username cannot be left blank";
    } else {
        if (!(strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 20)) {
            $error['username'] = "Username requires 4 to 20 characters";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Username is not in the correct format";
            } else {
                $username = $_POST['username'];
            }
        }
    }
    // ktra password
    if (empty($_POST['password'])) {
        $error['password'] ="Password cannot be blank";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = "Password is not in the correct format";
        } else {
            $password = md5($_POST['password']);
        }
    }
    // Kết luận
    if (empty($error)) {
//        $password = md5($password);
        $sql = "SELECT `username`,`password` FROM `users` where `username` ='{$username}' and `password` ='{$password}' and status = 1";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
//            if (isset($_POST['remember_me'])) {
//                setcookie('is_login', true, time() + 3600);
//                setcookie('user_login', $username, time() + 3600);
//            }
            //Lưu trữ phiên đăng nhập vào SESSION
            $_SESSION['is_login'] = true; // gán giá trị SESSION khi nó đúng
            $_SESSION['user_login'] = $username; // gán giá trị SESSION khi nó đúng
            //Chuyển hướng vào trong hệ thống
            if (!empty($_SESSION['cart']['buy'])) {
                redirect_to("?mod=cart&act=show");
            } else {
                redirect_to("?mod=home&act=main");
            }
        } else {
            $error['acount'] = "Username or password does not exist";
        }
    }
}

?>
<style>
    .lele{
        text-align: center;
    }
</style>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success">
        <div class="lele">
        <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success'])
                    ?>
        </div>
    </div>
    <?php

endif; ?>
<div id="main-content-login" class="login-page">

    
    <div class="wp-inner clearfix">
        <div class="info fl-left">
            <div class="thumb thumb_login">
                <img src="public/images/124.jpg">
            </div>
        </div>
        <div class="form-reg-wp fl-right">
            <div class="login">
                <h1 class="post_title">Log in</h1>
                <form id="form-login" action="" method="post">
                    <input type="text" name="username" value="" id="username" placeholder="user name">
                    <?php
                    if (!empty($error['username'])) {
                        ?>
                        <p class="error"><?php echo $error['username']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="password" name="password" id="password" placeholder="Password">
                    <?php
                    if (!empty($error['password'])) {
                        ?>
                        <p class="error"><?php echo $error['password']; ?></p>
                        <?php
                    }
                    ?>
                    <a href="?mod=users&act=forgot_password" id="lost-pass">Forgot your password?</a>
                    <input type="submit" name="btn_login" id="btn_login" value="Login">
                    <?php
                    if (!empty($error['acount'])) {
                        ?>
                        <p class="error"><?php echo $error['acount']; ?></p>
                        <?php
                    }
                    ?>
                </form>

                <div id="not-account">
                    <span>Don't have an account yet?</span>
                    <a href="?mod=users&act=register" title="Register" id="reg">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>