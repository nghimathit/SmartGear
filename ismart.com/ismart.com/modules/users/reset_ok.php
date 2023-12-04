<?php
get_header();
?>
<div id="main-content-login" class="login-page">
    <div class="wp-inner clearfix">
        <div class="form-reg-wp fl-right">
            <div class="login">
                <h1 class="post_title">Khôi phục mật khẩu</h1>
                <p>Bạn đã thay đổi mật khẩu thành công, vui lòng click vào link sau để đăng nhập:
                    <a href="<?php echo base_url("?mod=users&act=login"); ?>" id="">Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>