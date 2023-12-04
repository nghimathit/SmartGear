<?php
get_header();
?>
<?php
$list_users = get_list_users_cat($_SESSION['user_login']);
//show_array($list_users);
?>
<div id="main-content-wp" class="clearfix info-member-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?" title="">Thông tin cá nhân</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?mod=users&act=info_account" title="">Thông tin cá nhân</a>
                </li>
<!--                <li>
                    <a href="?mod=users&act=update_users" title="">Cập nhật thông tin</a>
                </li>-->
<!--                <li>
                    <a href="?mod=users&act=change_password" title="">Đổi mật khẩu</a>
                </li>-->
                <li>
                    <a href="?mod=users&act=logout" onclick="return confirmAction_users()" title="">Đăng xuất</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Thông tin cá nhân</h3>
                    </div>
                    <div class="section-detail">
                        <form action="" id="form-profile" method="post" accept-charset="utf-8">
                            <label for="display_name">Họ và tên</label>
                            <input type="text" value="<?php echo $list_users['fullname'] ?>" name="display_name" id="display_name" disabled="true"><br>
                            <label for="user_login">Tên đăng nhập</label>
                            <input type="text" value="<?php echo $list_users['username'] ?>" name="user_login" id="display_name" disabled="true"><br>
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="user_tel" value="<?php echo $list_users['phone'] ?>" id="user_tel" disabled="true"><br>
                            <label for="email">Email</label>
                            <input type="email" name="user_email" id="user_email" value="<?php echo $list_users['email'] ?>" disabled="true"><br>
                            <label for="user_address">Địa chỉ</label>
                            <input type="text" name="user_address" id="user_address" disabled="true" value="<?php echo $list_users['address'] ?>"><br>
                            <label for="gender">Giới tính</label>
                            <input type="text" name="user_address" id="user_address" disabled="true" value="<?php echo show_gender($list_users['gender']) ?>"><br>
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