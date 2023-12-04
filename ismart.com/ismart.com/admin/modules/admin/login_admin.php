
<?php
if (isset($_POST['btn_login'])) {

    $error = array();
    //ktra username
    if (empty($_POST['username'])) {
        $error['username'] = "Không được để trống tên đăng nhập";
    } else {
        if (!is_username($_POST['username'])) {
            $error['username'] = "Tên đăng nhập không đúng định dạng";
        } else {
            $username = $_POST['username'];
        }
    }

// ktra password
    if (empty($_POST['password'])) {
        $error['password'] = "Không được để trống mật khẩu";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = "Mật khẩu chưa đúng định dạng";
        } else {
            $password = md5($_POST['password']);
        }
    }
// Kết luận
    if (empty($error)) {
        $sql = "SELECT `username`,`password`,`role` FROM `admin` where `username` ='{$username}' and `password` ='{$password}' and status = 1";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_fetch_assoc($result);
        if ($num_rows > 0) {
            //Lưu trữ phiên đăng nhập vào SESSION
            $_SESSION['is_login_admin'] = true; // gán giá trị SESSION khi nó đúng
            $_SESSION['user_login_admin'] = $username; // gán giá trị SESSION khi nó đúng
            $_SESSION['role'] = $num_rows['role'];
            
            //Chuyển hướng vào trong hệ thống
            redirect_to("?mod=home&act=main");
        } else {
            $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
        }
    }
}
?>
<html>
    <head>
        <title>Trang đăng nhập</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/import/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form class="box" method="post">
            <h1>Login</h1>
            <input type="text" name="username" value="" id="username" placeholder="Username">
            <?php echo form_error('username') ?>
            <input type="password" name="password" id="password" placeholder="Password">
            <?php echo form_error('password') ?>
<!--            <input type="checkbox" name="remember_me">Ghi nhớ đăng nhập-->
            <input type="submit" name="btn_login" id="btn_login" value="Login">
            <?php echo form_error('account') ?>
        </form>
        
    </body>
</html>
