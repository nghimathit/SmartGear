<?php
get_header();
?>
<?php


$user_id = (int)$_GET['user_id'];
$sql = "select * from `users` where `user_id` = $user_id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);

if (isset($_POST['btn_change_pass'])) {
    $error = array();


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
   // ktra password nhap lai
   if (empty($_POST['confirm_pass'])) {
    $error['confirm_pass'] = "Confirmation password is required";
} else {
    // Check if the confirmation password matches the new password
    if ($_POST['confirm_pass'] !== $_POST['pass_new']) {
        $error['confirm_pass'] = "Confirm password does not match the new password";
    } else {
        // Confirmation password matches, proceed with validation
        if (!is_password($_POST['confirm_pass'])) {
            $error['confirm_pass'] = "Confirm password is not in the correct format";
        } else {
            $confirm_pass = md5($_POST['confirm_pass']);
        }
    }
}
if (empty($error)) {
    $sql_change_pass = "SELECT * FROM users WHERE password = '{$pass_old}' LIMIT 1";
    $result = mysqli_query($conn, $sql_change_pass);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        $sql = mysqli_query($conn, "UPDATE `users` SET `password` = '{$pass_new}' WHERE `user_id` = '{$user_id}'");
        
        // Set the success message before redirecting
        $_SESSION['success'] = "Password changed successfully";

        // Redirect after setting the session variable
        redirect_to("?mod=users&act=info_account");
    } else {
        $_SESSION['error'] = "Old password is incorrect";
    }
}

}
?>

<style>
   .section-detail{
    width: 300px;
   }
.linhbede {
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
    margin-bottom: 8px;
}

.btn_change_pass {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


</style>

<div id="main-content-wp" class="clearfix info-member-page">
<div class="clearfix"></div>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success'])
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
                            <div class="linhbede">
                                <label for="pass_old">Old password</label>
                                <input type="password" name="pass_old" id="pass_old" class="linhbong">
                                <?php echo form_error('pass_old'); ?>
                            </div>
                            <div class="linhbede">
                                <label for="pass_new">New password</label>
                                <input type="password" name="pass_new" id="pass_new" class="linhbong">
                                <?php echo form_error('pass_new'); ?>
                            </div>
                            <div class="linhbede">
                                <label for="confirm_pass">Confirm password</label>
                                <input type="password" name="confirm_pass" id="confirm_pass" class="linhbong">
                                <?php echo form_error('confirm_pass'); ?>
                            </div>
                            <div class="linhbede">
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