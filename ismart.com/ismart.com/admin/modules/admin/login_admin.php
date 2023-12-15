
<?php
if (isset($_POST['btn_login'])) {

    $error = array();
    //ktra username
    if (empty($_POST['username'])) {
        $error['username'] ="Do not leave your username blank";
    } else {
        if (!is_username($_POST['username'])) {
            $error['username'] = "Username is not in the correct format";
        } else {
            $username = $_POST['username'];
        }
    }

// ktra password
    if (empty($_POST['password'])) {
        $error['password'] ="Password cannot be left blank";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = "Password is not in the correct format";
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
            $error['account'] ="Username or password does not exist";
        }
    }
}
?>
<html>
    <head>
        <title>Login Pages</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/import/dangnhap.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link href="public/css/import/login.css" rel="stylesheet" type="text/css"/> -->
    </head>
    <body>
        <form class="box" method="post">
        <div class="icon">
            <div>
            <i class="fa-solid fa-address-card"></i>
            </div>
           
        </div>
            <input type="text" name="username" value="" id="username" placeholder="Username">
            <?php echo form_error('username') ?>
            <input type="password" name="password" id="password" placeholder="Password">
            <?php echo form_error('password') ?>
            <input type="submit" name="btn_login" id="btn_login" value="Login">
            <?php echo form_error('account') ?>
        </form>
        
    </body>
</html>
