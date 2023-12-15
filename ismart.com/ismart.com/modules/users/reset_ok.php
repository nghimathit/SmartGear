<?php
get_header();
?>
<div id="main-content-login" class="login-page">
    <div class="wp-inner clearfix">
        <div class="form-reg-wp fl-right">
            <div class="login">
            <h1 class="post_title">Password recovery</h1>
                <p>You have successfully changed your password, please click on the following link to log in:
                    <a href="<?php echo base_url("?mod=users&act=login"); ?>" id="">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>