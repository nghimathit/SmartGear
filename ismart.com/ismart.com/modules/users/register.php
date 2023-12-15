<?php
get_header();
?>

<?php
if (isset($_POST['btn_reg'])) {
    $error = array();
    // Kiểm tra fullname
    if (empty($_POST['fullname'])) {
        $error['fullname'] = "Full name cannot be left blank";
    } else {
        $fullname = $_POST['fullname'];
    }

    // Kiểm tra username
    if (empty($_POST['username'])) { // nếu bằng rỗng =>
        $error['username'] = "Username cannot be left blank";
    } else { // Ngược lại đã nhập dữ liệu rồi
        if (!(strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 20)) {
            $error['username'] = "Login name requires 4 to 20 characters";
        } else {
            if (!is_username($_POST['username'])) { // ktra username với $partten có khớp với nhau k
                $error['username'] = "Username is not in the correct format";
            } else { // khớp định dạng
                $username = $_POST['username']; // xuất ra username
            }
        }
    }

    // Kiểm tra password
    if (empty($_POST['password'])) {
        $error['password'] ="Password cannot be blank";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] ="Password is not in the correct format";
        } else { // khớp định dạng
            $password = md5($_POST['password']); // xuất ra password
        }
    }

    // Kiểm tra email
    if (empty($_POST['email'])) {
        $error['email'] ="Email cannot be left blank";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Email invalidate";
        } else { // khớp định dạng
            $email = $_POST['email'];
        }
    }

    // Kiểm tra phone
    if (empty($_POST['phone'])) {
        $error['phone'] = "Phone number cannot be left blank";
    } else {
        if (!is_phone_number($_POST['phone'])) {
            $error['phone'] = "Phone number is not in correct format";
        } else {
            $phone = $_POST['phone'];
        }
    }

    // Kiểm tra address
    if (empty($_POST['address'])) {
        $error['address'] = "Address cannot be left blank";
    } else {
        $address = $_POST['address'];
    }

    // Check gender
    if (empty($_POST['gender'])) {
        $error['gender'] = "You have not selected your Gender";
    } else {
        $gender = $_POST['gender'];
    }

    // Bước 3: Kết luận
    if (empty($error)) {
        if (!user_exists($username, $email)) {
            $active_token = md5($username . time()); // mã kích hoạt 
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'gender' => $gender,
                'active_token' => $active_token
            );
            add_user($data);
            redirect_to("?mod=users&act=login");
        } else {
            $error['account'] = "Email hoặc username đã tồn tại trên hệ thống";
        }
    }
}
?>

<div id="main-content-reg" class="reg-page">
    <div class="wp-inner clearfix">
        <div class="info fl-left">
           <h3 class="title">System accounts</h3>
            <p class="desc">Technology is the trend and always strong<br> Join the system now - Learn immediately!</p>
            <div class="thumb">
                <img src="public/images/reg4.png">
            </div>
        </div>
        <div class="form-reg-wp fl-right">
            <div class="register">
                <h3 class="title">Member registration</h3>
                <form action="" method="POST" id="form-register">
                    <input type="text" value="<?php echo set_value('fullname');?>" name="fullname" placeholder="Full name">
                    <?php
                    if (!empty($error['fullname'])) {
                        ?>
                        <p class="error"><?php echo $error['fullname']; ?></p>
                        <?php
                    }
                    ?>
                        <input type="text" value="<?php echo set_value('username');?>" name="username" placeholder= "Login name" >
                    <?php
                    if (!empty($error['username'])) {
                        ?>
                        <p class="error"><?php echo $error['username']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="password" name="password" placeholder="Password" >
                    <?php
                    if (!empty($error['password'])) {
                        ?>
                        <p class="error"><?php echo $error['password']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="text" value="<?php echo set_value('email');?>" name="email" placeholder="Email">
                    <?php
                    if (!empty($error['email'])) {
                        ?>
                        <p class="error"><?php echo $error['email']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="text" value="<?php echo set_value('phone');?>" name="phone" placeholder="Phone number" >
                    <?php
                    if (!empty($error['phone'])) {
                        ?>
                        <p class="error"><?php echo $error['phone']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="text" value="<?php echo set_value('address');?>" name="address" placeholder="Address" >
                    <?php
                    if (!empty($error['address'])) {
                        ?>
                        <p class="error"><?php echo $error['address']; ?></p>
                        <?php
                    }
                    ?>
                   <select name="gender" id="gender">
                        <option value="">-- Select gender --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <?php
                    if (!empty($error['gender'])) {
                        ?>
                        <p class="error"><?php echo $error['gender']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="submit" id="btn_reg" name="btn_reg" value="Đăng ký">
                    <?php echo form_error('account'); ?>
                </form>
                <div id="have-account">
                <span>Already have an account?</span>
                    <a href="?mod=users&act=login" id="lost-pass" title="Login">Login</a>
                </div>
            </div> 
        </div>
    </div>
</div>

<?php
get_footer();
?>
