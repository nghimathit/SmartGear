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
    //Ktra ten sp
    if (empty($_POST['product_name'])) {
        $error['product_name'] = "Bạn chưa nhập Tên sản phẩm";
    } else {
        $product_name = $_POST['product_name'];
    }

    //Ktra giá
    if (empty($_POST['price_new'])) {
        $error['price_new'] = "Bạn chưa nhập Giá sản phẩm";
    } else {
        $price_new = $_POST['price_new'];
    }
    //Ktra giá cũ
    if (empty($_POST['price_old'])) {
        $error['price_old'] = "Bạn chưa nhập Giá sản phẩm";
    } else {
        $price_old = $_POST['price_old'];
    }
    //Ktra ten mô tả
    if (empty($_POST['product_desc'])) {
        $error['product_desc'] = "Bạn chưa nhập Mô tả";
    } else {
        $product_desc = $_POST['product_desc'];
    }

    //Ktra ndung
    if (empty($_POST['product_content'])) {
        $error['product_content'] = "Bạn chưa nhập Chi tiết";
    } else {
        $product_content = $_POST['product_content'];
    }

    //Ktra danh muc sp
    if (empty($_POST['cat_id'])) {
        $error['cat_id'] = "Bạn chưa chọn Danh mục sản phẩm";
    } else {
        $cat_id = $_POST['cat_id'];
    }
    //Ktra hình ảnh
    if (isset($_FILES['file'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif', 'webp');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file'] = "Bạn chưa upload hình ảnh";
        }
        $product_thumb = $_FILES['file']['name'];
    } else {
        $error['file'] = "Bạn chưa upload hình ảnh";
    }
    // thumb1
    if (isset($_FILES['file_1'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_1']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file_1']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif', 'webp');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file_1'] = "Bạn chưa upload hình ảnh";
        }
        $list_thumb_1 = $_FILES['file_1']['name'];
    } else {
        $error['file_1'] = "Bạn chưa upload thumb 1";
    }
    // thumb2
    if (isset($_FILES['file_2'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_2']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file_2']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif', 'webp');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file_2'] = "Bạn chưa upload hình ảnh";
        }
        $list_thumb_2 = $_FILES['file_2']['name'];
    } else {
        $error['file_2'] = "Bạn chưa upload thumb 2";
    }
    // thumb3
    if (isset($_FILES['file_3'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_3']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file_3']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif', 'webp');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file_3'] = "Bạn chưa upload hình ảnh";
        }
        $list_thumb_3 = $_FILES['file_3']['name'];
    } else {
        $error['file_3'] = "Bạn chưa upload thumb 3";
    }
    // thumb4
    if (isset($_FILES['file_4'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_4']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file_4']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif', 'webp');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file_4'] = "Bạn chưa upload hình ảnh";
        }
        $list_thumb_4 = $_FILES['file_4']['name'];
    } else {
        $error['file_4'] = "Bạn chưa upload thumb 4";
    }
    // thumb5
    if (isset($_FILES['file_5'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_5']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file_5']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file_5'] = "Bạn chưa upload hình ảnh";
        }
        $list_thumb_5 = $_FILES['file_5']['name'];
    } else {
        $error['file_5'] = "Bạn chưa upload thumb 5";
    }
    // thumb6
    if (isset($_FILES['file_6'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file_6']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file_6']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file_6'] = "Bạn chưa upload hình ảnh";
        }
        $list_thumb_6 = $_FILES['file_6']['name'];
    } else {
        $error['file_6'] = "Bạn chưa upload thumb 6";
    }

    //Ktra sp bán chạy
    if (empty($_POST['selling_products'])) {
        $error['selling_products'] = "Bạn chưa chọn Sản phẩm bán chạy";
    } else {
        $selling_products = $_POST['selling_products'];
    }

    // Bước 3: Kết luận
    if (empty($error)) {
        if (!check_product_exists($product_name)) {
            $sql = "INSERT INTO `product` (`product_name`,`price_new`,`price_old`,`product_desc`,`product_content`,`product_thumb`,`list_thumb_1`,`list_thumb_2`,`list_thumb_3`,`list_thumb_4`,`list_thumb_5`,`list_thumb_6`,`cat_id`,`selling_products`)"
                . "VALUES('{$product_name}', '{$price_new}', '{$price_old}', '{$product_desc}','{$product_content}','{$product_thumb}','{$list_thumb_1}','{$list_thumb_2}','{$list_thumb_3}','{$list_thumb_4}','{$list_thumb_5}','{$list_thumb_6}','{$cat_id}','{$selling_products}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_to("?mod=product&act=main");
            } else {
                $_SESSION['error'] = "Thêm mới thất bại";
            }
        } else {
            $_SESSION['error'] = "Tên sản phẩm đã tồn tại";
        }
    }
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
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
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
                    <form id="form-upload-single" action="" enctype="multipart/form-data" method="post">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name">
                        <?php echo form_error('product_name'); ?>
                        <label for="price_new">Giá mới</label>
                        <input type="text" name="price_new" id="price_new">
                        <?php echo form_error('price_new'); ?>
                        <label for="price_old">Giá cũ</label>
                        <input type="text" name="price_old" id="price_new">
                        <?php echo form_error('price_old'); ?>
                        <label for="product_desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="product_desc"></textarea>
                        <?php echo form_error('product_desc'); ?>
                        <label for="product_content">Chi tiết</label>
                        <textarea name="product_content" id="product_content" class="ckeditor"></textarea>
                        <?php echo form_error('product_content'); ?>

                        <div class="form_group clearfix" id="">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=product&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file">
                            </div>
                            <?php echo form_error('file'); ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_1</label>
                            <input type="file" name="file_1" id="file_1" data-uri="?mod=product&act=upload_single_1">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_1">
                            <div id="show_list_file_1">
                            </div>
                            <?php echo form_error('file_1'); ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_2</label>
                            <input type="file" name="file_2" id="file_2" data-uri="?mod=product&act=upload_single_2">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_2">
                            <div id="show_list_file_2">
                            </div>
                            <?php echo form_error('file_2'); ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_3</label>
                            <input type="file" name="file_3" id="file_3" data-uri="?mod=product&act=upload_single_3">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_3">
                            <div id="show_list_file_3">
                            </div>
                            <?php echo form_error('file_3'); ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_4</label>
                            <input type="file" name="file_4" id="file_4" data-uri="?mod=product&act=upload_single_4">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_4">
                            <div id="show_list_file_4">
                            </div>
                            <?php echo form_error('file_4'); ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_5</label>
                            <input type="file" name="file_5" id="file_5" data-uri="?mod=product&act=upload_single_5">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_5">
                            <div id="show_list_file_5">
                            </div>
                            <?php echo form_error('file_5'); ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_6</label>
                            <input type="file" name="file_6" id="file_6" data-uri="?mod=product&act=upload_single_6">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_6">
                            <div id="show_list_file_6">
                            </div>
                            <?php echo form_error('file_6'); ?>
                        </div>

                        <label>Danh mục sản phẩm</label>
                        <select name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="1">Điện Thoại</option>
                            <option value="2">Lap Top</option>
                            <option value="3">TabLet</option>
                            <option value="4">Phụ Kiện</option>
                            <option value="5">SmartWatch </option>
                        </select>
                        <?php echo form_error('cat_id'); ?>

                        <label>Sản phẩm bán chạy</label>
                        <select name="selling_products" id="selling_products">
                            <option value="">-- Chọn sản phẩm bán chạy --</option>
                            <option value="Bán chạy">Bán chạy</option>
                            <option value="Bình thường">Bình thường</option>
                        </select>
                        <?php echo form_error('selling_products'); ?>
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