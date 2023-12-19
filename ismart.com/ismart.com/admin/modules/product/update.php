<?php
get_header();
?>

<?php
require 'db/connect.php';
$sql = "select * from category";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_cat[] = $row;
    }
}
//show_array($list_cat);
?>
<?php
$sql = "SELECT * FROM `category` where status = 1";
$result = mysqli_query($conn, $sql);
$list_category = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_category[] = $row;
    }
}
?>
<?php
$id = (int) $_GET['id'];
?>
<?php
$sql = "select *,product.status from `product`, `category` where product.cat_id = category.cat_id and `id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>
<?php
if (isset($_POST['btn_update'])) {
    $error = array();

    if (empty($_POST['product_name'])) {
        $error['product_name'] = "You have not entered a Product Name";
    } else {
        $product_name = $_POST['product_name'];
    }
    if (empty($_POST['price_new'])) {
        $error['price_new'] = "You have not entered a Product Price";
    } else {
        $price_new = $_POST['price_new'];
    }
    if (empty($_POST['price_old'])) {
        $error['price_old'] = "You have not entered a Product Price";
    } else {
        $price_old = $_POST['price_old'];
    }
    if (empty($_POST['product_desc'])) {
        $error['product_desc'] = "You have not entered a Product Description";
    } else {
        $product_desc = $_POST['product_desc'];
    }
    if (empty($_POST['product_content'])) {
        $error['product_content'] = "You have not entered Product Details";
    } else {
        $product_content = $_POST['product_content'];
    }
    if (empty($_POST['cat_id'])) {
        $error['cat_id'] = "You have not entered a Product Category";
    } else {
        $cat_id = $_POST['cat_id'];
    }

    //Ktra hình ảnh
    if (isset($_FILES['file'])) {
        $product_thumb = $_FILES['file']['name'];
    }
    // thumb1
    if (isset($_FILES['file_1'])) {
        $list_thumb_1 = $_FILES['file_1']['name'];
    }
    // thumb2
    if (isset($_FILES['file_2'])) {

        $list_thumb_2 = $_FILES['file_2']['name'];
    }
    // thumb3
    if (isset($_FILES['file_3'])) {
        $list_thumb_3 = $_FILES['file_3']['name'];
    }
    // thumb4
    if (isset($_FILES['file_4'])) {
        $list_thumb_4 = $_FILES['file_4']['name'];
    }
    // thumb5
    if (isset($_FILES['file_5'])) {
        $list_thumb_5 = $_FILES['file_5']['name'];
    }
    // thumb6
    if (isset($_FILES['file_6'])) {
        $list_thumb_6 = $_FILES['file_6']['name'];
    }
    //Ktra sp bán chạy
    if (empty($_POST['selling_products'])) {
        $error['selling_products'] = "You have not selected a Best Selling Product";
    } else {
        $selling_products = $_POST['selling_products'];
    }
    if (empty($_POST['qty_product'])) {
        $error['qty_product'] = "You have not selected Inventory Quantity";
    } else {
        $qty_product = $_POST['qty_product'];
    }
    if (empty($_POST['featured_products'])) {
        $error['featured_products'] = "You have not selected Featured Products";
    } else {
        $featured_products = $_POST['featured_products'];
    }
    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }

    if (empty($error)) {
        if (!empty($_FILES['file']['name']) && !empty($_FILES['file1']['name']) && !empty($_FILES['file2']['name']) && !empty($_FILES['file3']['name']) && !empty($_FILES['file4']['name']) && !empty($_FILES['file5']['name ']) && !empty($_FILES['file6']['name'])) {
            $sql = "update `product` set `product_name`='{$product_name}',`price_new`='{$price_new}',`price_old`='{$price_old}',`product_desc`='{$product_desc}',`product_thumb`='{$product_thumb}',`list_thumb_1`='{$list_thumb_1}',`list_thumb_2`='{$list_thumb_2}',`list_thumb_3`='{$list_thumb_3}',`list_thumb_4` ='{$list_thumb_4}',`list_thumb_5`='{$list_thumb_5}',`list_thumb_6`='{$list_thumb_6}',`product_content`='{$product_content}',`cat_id`='{$cat_id} ',`selling_products`='{$selling_products}',`qty_product`='{$qty_product}',`featured_products`='{$featured_products}',`status`='{$status}' where `id`= '{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Update successful";
                redirect_to("?mod=product&act=main");
            } else {
                $_SESSION['error'] = "Update failed";
            }
        } else {
            $sql = "update `product` set `product_name`='{$product_name}',`price_new`='{$price_new}',`price_old`='{$price_old}',`product_desc`='{$product_desc}',`product_content`='{$product_content}',`cat_id`='{$cat_id}',`selling_products`='{$selling_products}',`qty_product`='{$qty_product}',`featured_products` ='{$featured_products}',`status`='{$status}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Update successful";
                redirect_to("?mod=product&act=main");
            } else {
                $_SESSION['error'] = "Update failed";
            }
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
                    <h3 id="index" class="fl-left">Product Update</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php if (isset($_SESSION['error'])): ?>
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
                        <label for="product_name">Product name</label>
                        <input type="text" name="product_name" id="product_name"
                            value="<?php if (!empty($item['product_name']))
                                echo $item['product_name']; ?>">
                        <?php
                        if (!empty($error['product_name'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['product_name']; ?>
                            </p>
                            <?php
                        }
                        ?>

                        <label for="price_new">New price</label>
                        <input type="text" name="price_new" id="price_new"
                            value="<?php if (!empty($item['price_new']))
                                echo $item['price_new']; ?>">
                        <?php
                        if (!empty($error['price_new'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['price_new']; ?>
                            </p>
                            <?php
                        }
                        ?>

                        <label for="price_old">Old price</label>
                        <input type="text" name="price_old" id="price_new"
                            value="<?php if (!empty($item['price_old']))
                                echo $item['price_old']; ?>">
                        <?php
                        if (!empty($error['price_old'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['price_old']; ?>
                            </p>
                            <?php
                        }
                        ?>

                        <label for="product_desc">Product description</label>
                        <textarea id="post_desc" name="product_desc"><?php if (!empty($item['product_desc']))
                            echo $item['product_desc']; ?>
                        </textarea>

                        <?php
                        if (!empty($error['product_desc'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['product_desc']; ?>
                            </p>
                            <?php
                        }
                        ?>

                        <label for="product_content">Product details</label>
                        <textarea id="product_content" class="ckeditor"
                            name="product_content"><?php if (!empty($item['product_content']))
                                echo $item['product_content']; ?></textarea>
                        <?php
                        if (!empty($error['product_content'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['product_content']; ?>
                            </p>
                            <?php
                        }
                        ?>

                        <div class="form_group clearfix">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=post&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file">
                                <img src="uploads/<?php echo $item['product_thumb'] ?> ">
                            </div>
                            <?php
                            if (!empty($error['file'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_1</label>
                            <input type="file" name="file_1" id="file_1" data-uri="?mod=product&act=upload_single_1">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_1">
                            <div id="show_list_file_1">
                                <img src="uploads/<?php echo $item['list_thumb_1']; ?>">
                            </div>
                            <?php
                            if (!empty($error['file_1'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file_1']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_2</label>
                            <input type="file" name="file_2" id="file_2" data-uri="?mod=product&act=upload_single_2">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_2">
                            <div id="show_list_file_2">
                                <img src="uploads/<?php echo $item['list_thumb_2']; ?>">
                            </div>
                            <?php
                            if (!empty($error['file_2'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file_2']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_3</label>
                            <input type="file" name="file_3" id="file_3" data-uri="?mod=product&act=upload_single_3">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_3">
                            <div id="show_list_file_3">
                                <img src="uploads/<?php echo $item['list_thumb_3']; ?>">
                            </div>
                            <?php
                            if (!empty($error['file_3'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file_3']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_4</label>
                            <input type="file" name="file_4" id="file_4" data-uri="?mod=product&act=upload_single_4">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_4">
                            <div id="show_list_file_4">
                                <img src="uploads/<?php echo $item['list_thumb_4']; ?>">
                            </div>
                            <?php
                            if (!empty($error['file_4'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file_4']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_5</label>
                            <input type="file" name="file_5" id="file_5" data-uri="?mod=product&act=upload_single_5">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_5">
                            <div id="show_list_file_5">
                                <img src="uploads/<?php echo $item['list_thumb_5']; ?>">
                            </div>
                            <?php
                            if (!empty($error['file_5'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file_5']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Thumb_6</label>
                            <input type="file" name="file_6" id="file_6" data-uri="?mod=product&act=upload_single_6">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt_6">
                            <div id="show_list_file_6">
                                <img src="uploads/<?php echo $item['list_thumb_6']; ?>">
                            </div>
                            <?php
                            if (!empty($error['file_6'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['file_6']; ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>

                        <label>Article category</label>
                        <select name="cat_id">
                            <?php foreach ($list_category as $category) { ?>
                                <option <?php if (isset($category['cat_id']) && $category['cat_id'] == $item["cat_id"])
                                    echo "selected='selected'"; ?> value="<?php echo $category['cat_id'] ?>">
                                    <?php echo $category['cat_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php
                        if (!empty($error['cat_id'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['cat_id']; ?>
                            </p>
                            <?php
                        }
                        ?>
                        <label>Best-selling products</label>
                        <select name="selling_products" id="selling_products">
                            <option value="">-- Choose best selling products --</option>
                            <option <?php if (isset($item['selling_products']) && $item['selling_products'] == 'Bán chạy')
                                echo "selected='selected'"; ?> value="Bán chạy">Best seller</option>
                            <option <?php if (isset($item['selling_products']) && $item['selling_products'] == 'Bình thường')
                                echo "selected='selected'"; ?> value="Bình thường">Normal</option>
                        </select>
                        <?php echo form_error('featured_products'); ?>
                        <label>Featured products</label>
                        <select name="featured_products" id="featured_products">
                            <option value="">-- Select featured product --</option>
                            <option <?php if (isset($item['featured_products']) && $item['featured_products'] == 'Nổi bật')
                                echo "selected='selected'"; ?> value="Nổi bật">Featured</option>
                            <option <?php if (isset($item['featured_products']) && $item['featured_products'] == 'Bình thường')
                                echo "selected='selected'"; ?> value="Bình thường">Normal</option>
                        </select>
                        <?php echo form_error('featured_products'); ?>
                        <label>Status</label>
                        <select name="status" id="status">
                            <option value="">-- Select status --</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '0')
                                echo "selected='selected'"; ?> value="0">Stop selling</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '1')
                                echo "selected='selected'"; ?> value="1">For sale</option>
                        </select>

                        <label for="qty_product">Quantity in stock</label>
                        <input type="text" name="qty_product" id="qty_product"
                            value="<?php if (!empty($item['qty_product']))
                                echo $item['qty_product']; ?>">
                        <?php
                        if (!empty($error['qty_product'])) {
                            ?>
                            <p class="error">
                                <?php echo $error['qty_product']; ?>
                            </p>
                            <?php
                        }
                        ?>

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