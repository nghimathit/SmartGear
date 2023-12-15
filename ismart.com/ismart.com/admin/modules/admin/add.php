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
        $error['fullname'] ="Display Name cannot be blank";
    } else {
        $fullname = $_POST['fullname'];
    }

    // Kiểm tra username
    if (empty($_POST['username'])) { // nếu bằng rỗng =>
        $error['username'] = "Username cannot be left blank";
    } else { // Otherwise, the data has already been entered
        if (!is_username($_POST['username'])) { // check if username and $partten match
            $error['username'] = "Username is not in the correct format";
        } else { // khớp định dạng
            $username = $_POST['username']; // xuất ra username
        }
    }

    // Kiểm tra password
    if (empty($_POST['password'])) {
        $error['password'] = "Password cannot be left blank";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = "Password is not in the correct format";
        } else { // khớp định dạng
            $password = md5($_POST['password']); // xuất ra password
        }
    }

    // Kiểm tra email
    if (empty($_POST['email'])) {
        $error['email'] = "Email cannot be left blank";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Email is not in the correct format";
        } else { // match format
            $email = $_POST['email'];
        }
    }

    // Kiểm tra phone
    if (empty($_POST['phone'])) {
        $error['phone'] = "Phone number cannot be left blank";
    } else {
        if (!is_phone_number($_POST['phone'])) {
            $error['phone'] = "Phone number is not in the correct format";
        } else {
            $phone = $_POST['phone'];
        }
    }

    // Kiểm tra address
    if (empty($_POST['address'])) {
        $error['address'] ="Address cannot be left blank";
    } else {
        $address = $_POST['address'];
    }

    // Check gender
    if (empty($_POST['gender'])) {
        $error['gender'] = "You have not selected your Gender";
    } else {
        $gender = $_POST['gender'];
    }
    if (empty($_POST['role'])) {
        $error['role'] = "You have not selected Permissions";
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
            $error['file'] ="You have not uploaded an image";
        }
        $avatar = $_FILES['file']['name'];
    } else {
        $error['file'] = "You have not uploaded an image";
    }

// Bước 3: Kết luận 
    // Bước 3: Kết luận
    if (empty($error)) {
        if (!check_admin_exists($username,$email)) {
            $sql = "INSERT INTO `admin` (`fullname`,`avatar`,`username`,`password`,`email`,`phone`,`address`,`gender`,`role`)"
                    . "VALUES('{$fullname}','{$avatar}', '{$username}', '{$password}', '{$email}','{$phone}','{$address}', '{$gender}', '{$role}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Added successfully";
                redirect_to("?mod=admin&act=info_account");
            } else {
                $_SESSION['error'] = "New addition failed";
            }
        } else {
            $_SESSION['error'] = "Username or email already exists";
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
                    <h3 id="index" class="fl-left">Add new account</h3>
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

                        <label for="fullname">Display name</label>
                        <input type="text" name="fullname" id="fullname" >
                        <?php echo form_error('fullname') ?>

                        <div class="form_group clearfix" id="">
                            <label for="detail">Image</label>
                            <input type="file" name="file" id="file" data-uri="?mod=admin&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                            </div>
                            <?php echo form_error('file') ?>
                        </div>

                        <label for="username">Username</label>
                        <input type="text" name="username" id="usernam" >
                        <?php echo form_error('username') ?>

                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" >
                        <?php echo form_error('password') ?>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" >
                        <?php echo form_error('email') ?>

                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" >
                        <?php echo form_error('address') ?>

                        <label for="phone">Phone number</label>
                        <input type="text" name="phone" id="phone" >
                        <?php echo form_error('phone') ?>
                        <label>Gender</label>
                        <select name="gender" id="gender_admin">
                            <option value="">-- Select gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <?php echo form_error('gender') ?>
                        <label>Permissions</label>
                        <select name="role" id="role">
                            <option value="">-- Select permission --</option>
                            <option value="1">Admin</option>
                            <option value="2">Administrator</option>
                        </select>
                        <?php echo form_error('role') ?>
                        <button type="submit" name="btn_add" id="btn_add">Add new</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>