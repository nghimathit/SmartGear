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
        $error['fullname'] = "Display Name cannot be blank";
    } else {
        $fullname = $_POST['fullname'];
    }

    // Check email
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
    //Ktra hình ảnh
    if (isset($_FILES['file'])) {
        $avatar = $_FILES['file']['name'];
    }


    if (empty($error)) {
        if (!empty($_FILES['file']['name'])) {
            $sql = "update `admin` set `fullname`='{$fullname}',`avatar`='{$avatar}',`gender`='{$gender}',`email`='{$email}',`phone`='{$phone}',`address`='{$address}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Update successful";
                redirect_to("?mod=admin&act=info_account");
            } else {
                $_SESSION['error'] = "Update failed";
            }
        } else {
            $sql = "update `admin` set `fullname`='{$fullname}',`gender`='{$gender}',`email`='{$email}',`phone`='{$phone }',`address`='{$address}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Update successful";
                redirect_to("?mod=admin&act=info_account");
            } else {
                $_SESSION['error'] = "Update failed";
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
                <h3 id="index" class="fl-left">Update account</h3>
                <a href="?mod=admin&act=add" title="" id="add-new" class="fl-left">Add new</a>

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
                        <input type="text" name="fullname" id="fullname" value="<?php echo $item['fullname']; ?>">
                        <?php echo form_error('fullname') ?>

                        <div class="form_group clearfix">
                            <label for="detail">Image</label>
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
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" value="<?php echo $item['address']; ?>">
                        <?php echo form_error('address') ?>
                        <label for="phone">Phone number</label>
                        <input type="text" name="phone" id="phone" value="<?php echo $item['phone']; ?>">
                        <?php echo form_error('phone') ?>
                        <label>Gender</label>
                        <select name="gender" id="gender_admin">
                            <option value="">--Select gender--</option>
                            <option <?php if (isset($item['gender']) && $item['gender'] == 'male') echo "selected='selected'"; ?> value="male">Male</option>
                            <option <?php if (isset($item['gender']) && $item['gender'] == 'female') echo "selected='selected'"; ?> value="female">Female</option>
                        </select>
                        <?php echo form_error('gender') ?>
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