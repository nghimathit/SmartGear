<?php
get_header();
?>
<?php
$reset_token = $_GET['reset_token'];
if (!empty($reset_token)) {
    if (check_reset_token($reset_token)) {
        if (isset($_POST['btn_new_pass'])) {
            $error = array();
            // ktra password
            if (empty($_POST['password'])) {
                $error['password'] = "Password cannot be left blank";
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Password is not in the correct format";
                } else {
                    $password = md5($_POST['password']);
                }
            }
            if (empty($error)) {
                $data = array(
                    'password' => $password
                );
                update_pass($data, $reset_token);
                redirect_to("?mod=users&act=reset_ok");
            }
        }
    } else {
        echo "Request to retrieve invalid password";
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
            <div class="login">
                <h1 class="post_title">New password</h1>
                <form id="form-login" action="" method="post">
                    <input type="password" name="password" class="email_forgot_pass" id="password" autocomplete="false" placeholder="Password">
                    <?php echo form_error('password'); ?>
                    <input type="submit" name="btn_new_pass" id="btn_new_pass" value="Lưu mật khẩu">
                    <?php echo form_error('account'); ?>
                </form>
                <div id="have-account">
                    <a href="<?php echo base_url("?mod=users&act=login"); ?>" id="lost-pass">Sign in</a>
                    <a href="<?php echo base_url("?mod=users&act=register"); ?>" id="lost-pass">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>