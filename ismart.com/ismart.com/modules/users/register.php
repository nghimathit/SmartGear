<?php
get_header();
?>

<?php
if (isset($_POST['btn_reg'])) {
    $error = array();
    // Kiểm tra fullname
    if (empty($_POST['fullname'])) {
        $error['fullname'] = "Không được để trống Họ và tên";
    } else {
        $fullname = $_POST['fullname'];
    }

    // Kiểm tra username
    if (empty($_POST['username'])) { // nếu bằng rỗng =>
        $error['username'] = "Không được để trống Tên đăng nhập";
    } else { // Ngược lại đã nhập dữ liệu rồi
        if (!(strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 20)) {
            $error['username'] = "Tên đăng nhập yêu cầu từ 4 đến 20 ký tự";
        } else {
            if (!is_username($_POST['username'])) { // ktra username với $partten có khớp với nhau k
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else { // khớp định dạng
                $username = $_POST['username']; // xuất ra username
            }
        }
    }

    // Kiểm tra password
    if (empty($_POST['password'])) {
        $error['password'] = "Không được để trống Mật khẩu";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = "Mật khẩu không đúng định dạng";
        } else { // khớp định dạng
            $password = md5($_POST['password']); // xuất ra password
        }
    }

    // Kiểm tra email
    if (empty($_POST['email'])) {
        $error['email'] = "Không được để trống Email";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Email không đúng định dạng";
        } else { // khớp định dạng
            $email = $_POST['email'];
        }
    }

    // Kiểm tra phone
    if (empty($_POST['phone'])) {
        $error['phone'] = "Không được để trống Số điện thoại";
    } else {
        if (!is_phone_number($_POST['phone'])) {
            $error['phone'] = "Số điện thoại k đúng định dạng";
        } else {
            $phone = $_POST['phone'];
        }
    }

    // Kiểm tra address
    if (empty($_POST['address'])) {
        $error['address'] = "Không được để trống Địa chỉ";
    } else {
        $address = $_POST['address'];
    }

    // Kiểm tra giới tính
    if (empty($_POST['gender'])) {
        $error['gender'] = "Bạn chưa chọn Giới tính";
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
            <h3 class="title">Tài khoản hệ thống</h3>
            <p class="desc">Công nghệ là xu thế và luôn mạnh mẽ<br> Tham gia ngay hệ thống - Học ngay lập tức!</p>
            <div class="thumb">
                <img src="public/images/reg4.png">
            </div>
        </div>
        <div class="form-reg-wp fl-right">
            <div class="register">
                <h3 class="title">Đăng ký thành viên</h3>
                <form action="" method="POST" id="form-register">
                    <input type="text" value="<?php echo set_value('fullname');?>" name="fullname" placeholder="Họ và tên">
                    <?php
                    if (!empty($error['fullname'])) {
                        ?>
                        <p class="error"><?php echo $error['fullname']; ?></p>
                        <?php
                    }
                    ?>
                        <input type="text" value="<?php echo set_value('username');?>" name="username" placeholder="Tên đăng nhập" >
                    <?php
                    if (!empty($error['username'])) {
                        ?>
                        <p class="error"><?php echo $error['username']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="password" name="password" placeholder="Mật khẩu" >
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
                    <input type="text" value="<?php echo set_value('phone');?>" name="phone" placeholder="Số điện thoại" >
                    <?php
                    if (!empty($error['phone'])) {
                        ?>
                        <p class="error"><?php echo $error['phone']; ?></p>
                        <?php
                    }
                    ?>
                    <input type="text" value="<?php echo set_value('address');?>" name="address" placeholder="Địa chỉ" >
                    <?php
                    if (!empty($error['address'])) {
                        ?>
                        <p class="error"><?php echo $error['address']; ?></p>
                        <?php
                    }
                    ?>
                    <select name="gender" id="gender">
                        <option value="">-- Chọn giới tính --</option>
                        <option value="male">Nam</option>
                        <option value="female">Nữ</option>
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
                    <span>Đã có tài khoản?</span>
                    <a href="?mod=users&act=login" id="lost-pass" title="Đăng Nhập">Đăng Nhập</a>
                </div>
            </div> 
        </div>
    </div>
</div>

<?php
get_footer();
?>
