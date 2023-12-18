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
if (isset($_POST['btn_update'])) {
    $error = array(); // Bước 1: Phất cờ
    if (empty($_POST['address'])) {
        $error['address'] = "Address cannot be left blank";
    } else {
        $address = $_POST['address'];
    }
    if (empty($_POST['phone'])) {
        $error['phone'] = "Phone number cannot be left blank";
    } else {
        if (!is_phone_number($_POST['phone'])) {
            $error['phone'] = "Phone number is not in the correct format";
        } else {
            $phone = $_POST['phone'];
        }
    }
    if (!empty($_POST['note'])) {
        $note = $_POST['note'];
    }
    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }


    // Bước 3: Kết luận
    if (empty($error)) {
        $sql = "update `bill` set `address`='{$address}',`phone`='{$phone}',`note`='{$note}' where `bill_id`='{$id}'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Update successful";
            redirect_to("?mod=users&act=view");
        } else {
            $_SESSION['error'] = "Update failed";
        }
    }
}
?>
<?php
$sql = "SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = $id and bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status !=2 GROUP by bill.bill_id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>
<style>
body {
    font-family: 'Arial', sans-serif;
    color: #333;
}

#main-content-wp {
    background-color: #f4f4f4;
    padding: 20px;
}

.add-cat-page {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.wrap {
    max-width: 1200px;
    margin: 0 auto;
    overflow: hidden;
}

#content {
    width: 100%;
    margin: 0 auto;
}

#title-page {
    background-color: #2980b9;
    color: #fff;
    padding: 10px;
    border-radius: 5px 5px 0 0;
}

#title-page h3 {
    margin: 0;
}

.section-detail {
    padding: 20px;
    box-sizing: border-box;
}

label {
    font-family: 'Your Font Here', sans-serif;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    font-size: 15px;
    color: #3498db;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: 'Your Font Here', sans-serif;
    font-size: 14px;
    color: #333;
}

.error {
    color: #ff0000;
    margin-top: -10px;
    margin-bottom: 15px;
}

#btn_update {
    background-color: #3498db;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: 20px auto;
    transition: background-color 0.3s ease;
    font-size: 20px;
}

#btn_update:hover {
    background-color: #2980b9;
}
</style>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
  
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Change orders</h3>
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
                        <input type="text" name="fullname" readonly="readonly" value="<?php if (!empty($item['fullname'])) echo $item['fullname']; ?>" id ="username" >

                        <label for="email">Email</label>
                        <input type="text" name="email" readonly="readonly" value="<?php if (!empty($item['email'])) echo $item['email']; ?>" id="username" >
                        <?php
                        if (!empty($error['email'])) {
                            ?>
                            <p class="error"><?php echo $error['email']; ?></p>
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
                        <label for="phone">Phone number</label>
                        <input type="text" name="phone" value="<?php if (!empty($item['phone'])) echo $item['phone']; ?>" id="phone" >
                        <?php
                        if (!empty($error['phone'])) {
                            ?>
                            <p class="error"><?php echo $error['phone']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="note">Notes</label>
                        <input type="text" name="note" value="<?php if (!empty($item['note'])) echo $item['note']; ?>" id="note" >

<!--                        <label for="status">Trạng thái</label>
                        <select name="status">
                            <option <?php if (isset($item['status']) && $item['status'] == '1') echo "selected='selected'"; ?> value="Đã xử lý">Đã xử lý</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '0') echo "selected='selected'"; ?> value="Chưa xử lý">Chưa xử lý</option>
                        </select>-->

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


