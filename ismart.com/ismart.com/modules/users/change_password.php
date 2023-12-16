<?php
get_header();
?>
<?php
//$id = (int) $_GET['id'];
//$sql = "select * from `users` where `id` = $id and status = 1";
//$result = mysqli_query($conn, $sql);
//$item = mysqli_fetch_array($result);
//show_array($item);
?>
<?php
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
        $sql_change_pass = "select * from users where password ='{$pass_old}' limit 1";
        $result = mysqli_query($conn, $sql_change_pass);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $sql = mysqli_query($conn, "update `users` set `password`='{$pass_new}' where `id`='{$id}'");
            echo "Thay đổi mật khẩu thành công";
        } else {
            $error['acount'] = "Change password failed";
        }
    }
}
?>
<div id="main-content-wp" class="clearfix info-member-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Home</a>
                    </li>
                    <li>
                        <a href="?" title="">Change password</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?mod=users&act=info_account" title="">Personal information</a>
                </li>
               <li>
                    <a href="?mod=users&act=update_users" title="">Cập nhật thông tin</a>
                </li>
                <li>
                    <a href="?mod=users&act=change_password" title="">Change password</a>
                </li>
                <li>
                    <a href="?mod=users&act=logout" onclick="return confirmAction_users()" title="">Exit</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Change password</h3>
                    </div>
                    <div class="section-detail">
                        <form method="POST" id="formChangePass">
                            <label for="pass_old">Old password</label>
                            <input type="password" name="pass_old" id="pass_old">
                            <?php echo form_error('pass_old'); ?>
                            <label for="new-pass">New password</label>
                            <input type="password" name="pass_new" id="pass_new">
                            <?php echo form_error('pass_new'); ?>
                                                   <label for="confirm_pass">Xác nhận mật khẩu</label>
                                                    <input type="password" name="confirm_pass" id="confirm_pass">
                            <?php echo form_error('confirm_pass'); ?>
                            <button type="submit" name="btn_change_pass" id="btn_change_pass">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>