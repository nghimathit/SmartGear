<?php
get_header();
?>

<?php
$id = (int) $_GET['id'];
?>

<?php
if (isset($_POST['btn_update'])) {
    $error = array();
    $alert = array();

//    if (empty($_POST['cat_id'])) {
//        $error['cat_id'] = "Bạn chưa nhập Mã danh mục";
//    } else {
//        $cat_id = $_POST['cat_id'];
//    }

    if (empty($_POST['cat_name'])) {
        $error['cat_name'] = "Bạn chưa nhập Tên danh mục";
    } else {
        $cat_name = $_POST['cat_name'];
    }


    // Bước 3: Kết luận
    if (empty($error)) {
        $sql = "update `category` set `cat_name`='{$cat_name}' where `cat_id`='{$id}'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Cập nhật thành công";
            redirect_to("?mod=product_cat&act=main");
        } else {
            $_SESSION['error'] = "Cập nhật thất bại";
        }
    }
}
$sql = "select *from `category` where `cat_id` = $id";
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
                    <h3 id="index" class="fl-left">Cập nhật danh mục sản phẩm</h3>
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
                    <form method="POST">
                        <!--                        <label for="cat_id">Mã danh mục</label>
                                                <input type="text" value="<?php if (!empty($item['cat_id'])) echo $item['cat_id']; ?>" name="cat_id" id="cat_id" >-->


                        <label for="cat_name">Tên danh mục</label>
                        <input type="text" value="<?php if (!empty($item['cat_name'])) echo $item['cat_name']; ?>" name="cat_name" id="cat_name" >
                        <?php
                        if (!empty($error['cat_name'])) {
                            ?>
                            <p class="error"><?php echo $error['cat_name']; ?></p>
                            <?php
                        }
                        ?>
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