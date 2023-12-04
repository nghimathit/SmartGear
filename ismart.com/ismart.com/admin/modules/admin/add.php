<?php
get_header();
?>
<?php
//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    show_array($_POST);
//}
?>
<?php
if (isset($_POST['btn_add'])) {
    $error = array();

    // Kiểm tra fullname
    if (empty($_POST['fullname'])) {
        $error['fullname'] = "Không được để trống Tên hiển thị";
    } else {
        $fullname = $_POST['fullname'];
    }

    // Kiểm tra username
    if (empty($_POST['username'])) { // nếu bằng rỗng =>
        $error['username'] = "Không được để trống Tên đăng nhập";
    } else { // Ngược lại đã nhập dữ liệu rồi
        if (!is_username($_POST['username'])) { // ktra username với $partten có khớp với nhau k
            $error['username'] = "Tên đăng nhập không đúng định dạng";
        } else { // khớp định dạng
            $username = $_POST['username']; // xuất ra username
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
    if (empty($_POST['role'])) {
        $error['role'] = "Bạn chưa chọn Quyền";
    } else {
        $role = $_POST['role'];
    }


    if (isset($_FILES['file'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file'] = "Bạn chưa upload hình ảnh";
        }
        $avatar = $_FILES['file']['name'];
    } else {
        $error['file'] = "Bạn chưa upload hình ảnh";
    }

// Bước 3: Kết luận 
    // Bước 3: Kết luận
    if (empty($error)) {
        if (!check_admin_exists($username,$email)) {
            $sql = "INSERT INTO `admin` (`fullname`,`avatar`,`username`,`password`,`email`,`phone`,`address`,`gender`,`role`)"
                    . "VALUES('{$fullname}','{$avatar}', '{$username}', '{$password}', '{$email}','{$phone}','{$address}', '{$gender}', '{$role}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_to("?mod=admin&act=info_account");
            } else {
                $_SESSION['error'] = "Thêm mới thất bại";
            }
        } else {
            $_SESSION['error'] = "Username hoặc email đã tồn tại";
        }
    }
}
?>
<div id="main-content-wp" class="info-account-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới tài khoản</h3>
                </div>
            </div>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                    ?>
                </div>
            <?php endif; ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form id="form-upload-single"  action="" enctype="multipart/form-data" method="post">

                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" id="fullname" >
                        <?php echo form_error('fullname') ?>

                        <div class="form_group clearfix" id="">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=admin&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                            </div>
                            <?php echo form_error('file') ?>
                        </div>

                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="usernam" >
                        <?php echo form_error('username') ?>

                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" >
                        <?php echo form_error('password') ?>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" >
                        <?php echo form_error('email') ?>

                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" >
                        <?php echo form_error('address') ?>

                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" >
                        <?php echo form_error('phone') ?>

                        <label>Giới tính</label>
                        <select name="gender" id="gender_admin">
                            <option value="">-- Chọn giới tính --</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                        </select>
                        <?php echo form_error('gender') ?>
                        <label>Quyền</label>
                        <select name="role" id="role">
                            <option value="">-- Chọn quyền --</option>
                            <option value="1">Admin</option>
                            <option value="2">Quản trị viên</option>
                        </select>
                        <?php echo form_error('role') ?>
                        <button type="submit" name="btn_add" id="btn_add">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>