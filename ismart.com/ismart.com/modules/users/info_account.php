<?php
get_header();
?>
<?php
$list_users = get_list_users_cat($_SESSION['user_login']);

$list_users['url'] = "?mod=users&act=change_password&user_id={$list_users['user_id']}";
$list_users['url_change_pass'] =  "?mod=users&act=change_password&user_id={$list_users['user_id']}";
?>
<div class="clearfix"></div>
<?php if (isset($_SESSION['success'])) : ?>
<div class="alert alert-success">
    <?php
                    echo $_SESSION['success'];
                   
                    ?>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])) : ?>
<div class="alert alert-danger">
    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                    ?>
</div>
<?php endif; ?>

<div id="main-content-wp" class="clearfix info-member-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Home</a>
                    </li>
                    <li>
                        <a href="?" title="">Personal information</a>
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
                    <a href="<?php echo $list_users['url']; ?>">Change Password</a>
                </li>

                <li>
                    <a href="?mod=users&act=logout" onclick="return confirmAction_users()" title="">Sign out</a>
                </li>
                <li>
                    <a href="?mod=users&act=view" title="">Purchase order</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Personal information</h3>
                    </div>
                    <div class="section-detail">
                        <form action="" id="form-profile" method="post" accept-charset="utf-8">
                            <label for="display_name">First and last name</label>
                            <input type="text" value="<?php echo $list_users['fullname'] ?>" name="display_name"
                                id="display_name" disabled="true"><br>
                            <label for="user_login">Username</label>
                            <input type="text" value="<?php echo $list_users['username'] ?>" name="user_login"
                                id="display_name" disabled="true"><br>
                            <label for="phone">Phone number</label>
                            <input type="tel" name="user_tel" value="<?php echo $list_users['phone'] ?>" id="user_tel"
                                disabled="true"><br>
                            <label for="email">Email</label>
                            <input type="email" name="user_email" id="user_email"
                                value="<?php echo $list_users['email'] ?>" disabled="true"><br>
                            <label for="user_address">Address</label>
                            <input type="text" name="user_address" id="user_address" disabled="true"
                                value="<?php echo $list_users['address'] ?>"><br>
                            <label for="gender">Gender</label>
                            <input type="text" name="user_address" id="user_address" disabled="true"
                                value="<?php echo show_gender($list_users['gender']) ?>"><br>
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