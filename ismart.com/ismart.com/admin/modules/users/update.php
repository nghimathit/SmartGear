<?php
get_header();
?>
<?php
$id = (int) $_GET['id'];
?>
<?php
if (isset($_POST['btn_update'])) {
    $error = array(); // Bước 1: Phất cờ
    $alert = array(); // mảng dùng để thông báo
    // Kiểm tra fullname
    if (empty($_POST['fullname'])) {
        $error['fullname']= "Fullname cannot be left blank";
    } else {
        $fullname = $_POST['fullname'];
    }

    // Kiểm tra giới tính
    if (empty($_POST['gender'])) {
        $error['gender'] = "You need to choose gender";
    } else {
        $gender = $_POST['gender'];
    }
    // Kiểm tra email
    if (empty($_POST['email'])) {
        $error['email'] = "Email cannot be left blank";
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
    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }

    // Bước 3: Kết luận
    if (empty($error)) {
        $sql = "update `users` set `fullname`='{$fullname}',`gender`='{$gender}',`email`='{$email}',`phone`='{$phone}',`address`='{$address}',`status`='{$status}' where `user_id`='{$id}'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Update successful";
            redirect_to("?mod=users&act=main");
        } else {
            $_SESSION['error'] = "Update failed";
        }
    }
}
?>
<?php
$sql = "select *from `users` where `user_id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>

<?php
if (!empty($alert['success'])) {
    ?>
    <p class="success"><?php echo $alert['success']; ?></p>
    <?php
}
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Product updates</h3>
                </div>
            </div>
            <div class="clearfix"></div>
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
                        <label for="fullname">Full name</label>
                        <input type="text" name="fullname" value="<?php if (!empty($item['fullname'])) echo $item['fullname']; ?>" id="username" >
                        <?php
                        if (!empty($error['fullname'])) {
                            ?>
                            <p class="error"><?php echo $error['fullname']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php if (!empty($item['email'])) echo $item['email']; ?>" id="email" >
                        <?php
                        if (!empty($error['email'])) {
                            ?>
                            <p class="error"><?php echo $error['email']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="phone">Phone number</label>
                        <input type="text" name="phone" value="<?php if (!empty($item['phone'])) echo $item['phone']; ?>" id="phone" >
                        <?php
                        if (!empty($error['phone'])) {
                            ?>
                            <p class="error"><?php echo $error['phone']; ?></p>
                            <?php
                        }
                        ?>


                        <label for="address">Address</label>
                        <input type="text" name="address" value="<?php if (!empty($item['address'])) echo $item['address']; ?>" id="address" >
                        <?php
                        if (!empty($error['address'])) {
                            ?>
                            <p class="error"><?php echo $error['address']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="gender">Gender</label>
                        <select name="gender">
                            <option value="">--Select gender--</option>
                            <option <?php if (isset($item['gender']) && $item['gender'] == 'male') echo "selected='selected'"; ?> value="male">male</option>
                            <option <?php if (isset($item['gender']) && $item['gender'] == 'female') echo "selected='selected'"; ?> value="female">female</option>
                        </select>
                        <?php
                        if (!empty($error['gender'])) {
                            ?>
                            <p class="error"><?php echo $error['gender']; ?></p>
                            <?php
                        }
                        ?>
                        <label>Status</label>
                        <select name="status" id="status">
                            <option value="">-- Select status --</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '0') echo "selected='selected'"; ?> value="0">No</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '1') echo "selected='selected'"; ?> value="1">Display</option>
                        </select>
                        <button type="submit" name="btn_update" id="btn_update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>


