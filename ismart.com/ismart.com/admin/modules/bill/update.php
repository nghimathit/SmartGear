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
        $error['address'] = "Không được để trống Địa chỉ";
    } else {
        $address = $_POST['address'];
    }
    if (empty($_POST['phone'])) {
        $error['phone'] = "Không được để trống Số điện thoại";
    } else {
        if (!is_phone_number($_POST['phone'])) {
            $error['phone'] = "Số điện thoại không đúng định dạng";
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
            $_SESSION['success'] = "Cập nhật thành công";
            redirect_to("?mod=bill&act=list_order");
        } else {
            $_SESSION['error'] = "Cập nhật thất bại";
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

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật đơn hàng</h3>
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
                        <label for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" readonly="readonly" value="<?php if (!empty($item['fullname'])) echo $item['fullname']; ?>" id="username" >

                        <label for="email">Email</label>
                        <input type="text" name="email" readonly="readonly" value="<?php if (!empty($item['email'])) echo $item['email']; ?>" id="username" >
                        <?php
                        if (!empty($error['email'])) {
                            ?>
                            <p class="error"><?php echo $error['email']; ?></p>
                            <?php
                        }
                        ?>

                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" value="<?php if (!empty($item['address'])) echo $item['address']; ?>" id="address" >
                        <?php
                        if (!empty($error['address'])) {
                            ?>
                            <p class="error"><?php echo $error['address']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" value="<?php if (!empty($item['phone'])) echo $item['phone']; ?>" id="phone" >
                        <?php
                        if (!empty($error['phone'])) {
                            ?>
                            <p class="error"><?php echo $error['phone']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="note">Ghi chú</label>
                        <input type="text" name="note" value="<?php if (!empty($item['note'])) echo $item['note']; ?>" id="note" >

<!--                        <label for="status">Trạng thái</label>
                        <select name="status">
                            <option <?php if (isset($item['status']) && $item['status'] == '1') echo "selected='selected'"; ?> value="Đã xử lý">Đã xử lý</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '0') echo "selected='selected'"; ?> value="Chưa xử lý">Chưa xử lý</option>
                        </select>-->

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


