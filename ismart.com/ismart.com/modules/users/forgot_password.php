<?php
get_header();
?>
<?php
if (isset($_POST['btn_reset'])) {
    $error = array();
    if (empty($_POST['email'])) {
        $error['email'] = "Email cannot be left blank";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] ="Email is not in the correct format";
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
            $content = "<p>Please click on the following link to recover your password:</p>
                <a href='{$link}'>Password retrieval </a>
                ";
            send_mail($email, '', 'Recover SmartGear password', $content);
            echo "Please check your email to confirm!";
        } else {
            $error['account'] = "Email does not exist in the system";
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
                <h1 class="post_title">Password recovery</h1>
                <form id="form-forgot-password" action="" method="post">
                    <input type="text" name="email" value="<?php echo set_value('email') ?>" class="email_forgot_pass" placeholder="Email">
                    <?php echo form_error('email'); ?>
                    <input type="submit" name="btn_reset" id="btn_reset" value="Send require">
                    <?php
                    if (!empty($error['acount'])) {
                        ?>
                        <p class="error"><?php echo $error['acount']; ?></p>
                        <?php
                    }
                    ?>
                </form>
                <div id="have-account">
                <a href="<?php echo base_url("?mod=users&act=login"); ?>" id="lost-pass">Sign in</a> /
                <a href="<?php echo base_url("?mod=users&act=register"); ?>" id="lost-pass">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>