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
#content {
    width: 70%;
    margin: 0 auto;
    background-color: #f4f4f4;
    padding: 20px;
}

.main-content1 {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
}

.section-head {
    margin-bottom: 20px;
}

.section-titi {
    margin: 0;
    font-size: 35px;
    color: #333;
    font-weight: bold;
    color: #2196f3;
}

.section-detail {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
}

.button:hover {
    background-color: #45a049;
}

@media only screen and (max-width: 768px) {
    #content {
        width: 100%;
    }
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
            <div class="main-content1 fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-titi">Change password</h3>
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
                                <button type="submit" name="btn_change_pass" id="btn_change_pass12">Update</button>
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