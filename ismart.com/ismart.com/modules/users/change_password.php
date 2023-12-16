<?php
get_header();
?>
<?php
require_once __DIR__ . '/../../lib/users.php';
$user_id = 0;

$id = (int) $_GET['user_id'];
$sql = "select * from `users` where `user_id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
?>
<style>
   .section-detail{
    width: 300px;
   }
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="password"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    margin-bottom: 10px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


</style>
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
                        <h3 class="section-title">Change password</h3>
                    </div>
                    <div class="section-detail">
                        <form method="POST" id="formChangePass">
                            <div class="form-group">
                                <label for="pass_old">Old password</label>
                                <input type="password" name="pass_old" id="pass_old" class="form-control">
                                <?php echo form_error('pass_old'); ?>
                            </div>
                            <div class="form-group">
                                <label for="pass_new">New password</label>
                                <input type="password" name="pass_new" id="pass_new" class="form-control">
                                <?php echo form_error('pass_new'); ?>
                            </div>
                            <div class="form-group">
                                <label for="confirm_pass">Confirm password</label>
                                <input type="password" name="confirm_pass" id="confirm_pass" class="form-control">
                                <?php echo form_error('confirm_pass'); ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_change_pass" id="btn_change_pass">Update</button>
                            </div>
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