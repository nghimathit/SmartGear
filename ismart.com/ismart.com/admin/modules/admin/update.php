<?php
get_header();
?>
<?php
$id = (int) $_GET['id'];
//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    show_array($_POST);
//}
?>
<?php
$sql = "select * from `admin` where `id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>
<?php
if (isset($_POST['btn_update'])) {
    $error = array();

    // Kiểm tra fullname
    if (empty($_POST['fullname'])) {
        $error['fullname'] = "Không được để trống Tên hiển thị";
    } else {
        $fullname = $_POST['fullname'];
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
    //Ktra hình ảnh
    if (isset($_FILES['file'])) {
        $avatar = $_FILES['file']['name'];
    }


    if (empty($error)) {
        if (!empty($_FILES['file']['name'])) {
            $sql = "update `admin` set `fullname`='{$fullname}',`avatar`='{$avatar}',`gender`='{$gender}',`email`='{$email}',`phone`='{$phone}',`address`='{$address}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_to("?mod=admin&act=info_account");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại";
            }
        } else {
            $sql = "update `admin` set `fullname`='{$fullname}',`gender`='{$gender}',`email`='{$email}',`phone`='{$phone}',`address`='{$address}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_to("?mod=admin&act=info_account");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại";
            }
        }
    }
}
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">     
            <div class="clearfix">
                <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
                <a href="?mod=admin&act=add" title="" id="add-new" class="fl-left">Thêm mới</a>

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
                        <input type="text" name="fullname" id="fullname" value="<?php echo $item['fullname']; ?>">
                        <?php echo form_error('fullname') ?>

                        <div class="form_group clearfix">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=post&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                                <img src="uploads/<?php echo $item['avatar'] ?> ">
                            </div>
                            <?php echo form_error('file') ?>
                        </div>


                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $item['email']; ?>">
                        <?php echo form_error('email') ?>
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" value="<?php echo $item['address']; ?>">
                        <?php echo form_error('address') ?>
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="<?php echo $item['phone']; ?>">
                        <?php echo form_error('phone') ?>
                        <label>Giới tính</label>
                        <select name="gender" id="gender_admin">
                            <option value="">--Chọn giới tính--</option>
                            <option <?php if (isset($item['gender']) && $item['gender'] == 'male') echo "selected='selected'"; ?> value="male">Nam</option>
                            <option <?php if (isset($item['gender']) && $item['gender'] == 'female') echo "selected='selected'"; ?> value="female">Nữ</option>
                        </select>
                        <?php echo form_error('gender') ?>
                        <button type="submit" name="btn_update" id="btn_update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>