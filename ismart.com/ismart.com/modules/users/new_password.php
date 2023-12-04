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
                $error['password'] = "Không được để trống mật khẩu";
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu chưa đúng định dạng";
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
        echo "Yêu cầu lấy lai mật khẩu k hợp lệ";
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
                <h1 class="post_title">Mật khẩu mới</h1>
                <form id="form-login" action="" method="post">
                    <input type="password" name="password" class="email_forgot_pass" id="password" autocomplete="false" placeholder="Password">
                    <?php echo form_error('password'); ?>
                    <input type="submit" name="btn_new_pass" id="btn_new_pass" value="Lưu mật khẩu">
                    <?php echo form_error('account'); ?>
                </form>
                <div id="have-account">
                    <a href="<?php echo base_url("?mod=users&act=login"); ?>" id="lost-pass">Đăng nhập</a>
                    <a href="<?php echo base_url("?mod=users&act=register"); ?>" id="lost-pass">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>