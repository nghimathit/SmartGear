<?php
get_header();
?>
<?php
if (isset($_POST['btn_reset'])) {
    $error = array();
    if (empty($_POST['email'])) {
        $error['email'] = "Không được để trống email";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Email chưa đúng định dạng";
        } else {
            $email = $_POST['email'];
        }
    }
    // Kết luận
    if (empty($error)) {
        if (check_email($email)) {
            $reset_token = md5($email . time());
            $data = array(
                'reset_token' => $reset_token
            );
            // update mã reset pass cho user cần khôi phục mật khẩu
            update_reset_token($data, $email);
            // gửi link khôi phục vào email ngdung
            $link = base_url("?mod=users&act=new_password&reset_token={$reset_token}");
            $content = "<p>Bạn vui lòng click vào link sau để khôi phục password:</p>
                <a href='{$link}'>Lấy Lại Mật Khẩu </a>
                ";
            send_mail($email, '', 'Khôi phục password SmartGear', $content);
            echo "Bạn vui lòng vào email để xác nhận!";
        } else {
            $error['account'] = "Email không tồn tại trong hệ thống ";
        }
    }
}
?>

<div id="main-content-login" class="login-page">
    <div class="wp-inner clearfix">
        <div class="info fl-left">
            <div class="thumb thumb_login1">
                <img src="public/images/124.jpg">
            </div>
        </div>
        <div class="form-reg-wp fl-right">
            <div class="forgot_password">
                <h1 class="post_title">Khôi phục mật khẩu</h1>
                <form id="form-forgot-password" action="" method="post">
                    <input type="text" name="email" value="<?php echo set_value('email') ?>" class="email_forgot_pass" placeholder="Email">
                    <?php echo form_error('email'); ?>
                    <input type="submit" name="btn_reset" id="btn_reset" value="Gửi yêu cầu">
                    <?php
                    if (!empty($error['acount'])) {
                        ?>
                        <p class="error"><?php echo $error['acount']; ?></p>
                        <?php
                    }
                    ?>
                </form>
                <div id="have-account">
                <a href="<?php echo base_url("?mod=users&act=login"); ?>" id="lost-pass">Đăng nhập</a> /
                <a href="<?php echo base_url("?mod=users&act=register"); ?>" id="lost-pass">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>