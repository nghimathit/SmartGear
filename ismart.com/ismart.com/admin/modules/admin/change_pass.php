<?php
get_header();
?>
<?php
$id = (int) $_GET['id'];
$sql = "select * from `admin` where `id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);


if (isset($_POST['btn_change_pass'])) {
    $error = array();

    // ktra password cũ
    if (empty($_POST['pass_old'])) {
        $error['pass_old'] = "Old password cannot be left blank";
    } else {
        if (!is_password($_POST['pass_old'])) {
            $error['pass_old'] = "The old password is not in the correct format";
        } else {
            $pass_old = md5($_POST['pass_old']);
        }
    }
    // ktra password mới
    if (empty($_POST['pass_new'])) {
        $error['pass_new'] = "New password cannot be left blank";
    } else {
        if (!is_password($_POST['pass_new'])) {
            $error['pass_new'] = "New password is not in the correct format";
        } else {
            $pass_new = md5($_POST['pass_new']);
        }
    }
//    // ktra password nhap lai
//    if (empty($_POST['confirm_pass'])) {
//        $error['confirm_pass'] = "Không được để trống Xác nhận mật khẩu";
//    } else {
//        if (!is_password($_POST['password'])) {
//            $error['confirm_pass'] = "Xác nhận mật khẩu chưa đúng định dạng";
//        } else {
//            $confirm_pass = md5($_POST['confirm_pass']);
//        }
//    }

    if (empty($error)) {
        $sql_change_pass = "select * from admin where password ='{$pass_old}' limit 1";
        $result = mysqli_query($conn, $sql_change_pass);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $sql = mysqli_query($conn, "update `admin` set `password`='{$pass_new}' where `id`='{$id}'");
            $_SESSION['success'] = "Password changed successfully";
            redirect_to("?mod=product&act=main");
        } else {
            $_SESSION['error'] = "Old password is incorrect";
        }
    }
}
?>

<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">

    </div>
    <div id="main-content-wp" class="info-account-page">
        <div class="wrap clearfix">
            <?php
            get_sidebar();
            ?>
            <div id="content" class="fl-right">  
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Change password</h3>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error'])
                        ?>
                    </div>
                <?php endif; ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST" id="formChangePass">
                            <label for="pass_old">Old password</label>
                            <input type="password" name="pass_old" id="pass_old">
                            <?php echo form_error('pass_old'); ?>
                            <label for="new-pass">New password</label>
                            <input type="password" name="pass_new" id="pass_new">
                            <?php echo form_error('pass_new'); ?>
                            <!--                        <label for="confirm_pass">Xác nhận mật khẩu</label>
                                                    <input type="password" name="confirm_pass" id="confirm_pass">-->
                            <?php echo form_error('confirm_pass'); ?>
                            <button type="submit" name="btn_change_pass" id="btn_change_pass">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>