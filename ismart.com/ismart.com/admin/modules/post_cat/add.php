<?php
get_header();
?>

<?php
if (isset($_POST['btn_add'])) {
    $error = array();
//Ktra mã dm
//    if (empty($_POST['cat_id'])) {
//        $error['cat_id'] = "Bạn chưa nhập Danh mục";
//    } else {
//        $cat_id = $_POST['cat_id'];
//    }
//Ktra danh muc sp
    if (empty($_POST['post_name'])) {
        $error['post_name'] = "Bạn chưa nhập Tên danh mục";
    } else {
        $post_name = $_POST['post_name'];
    }
////Ktra trang thái
//    if (empty($_POST['status'])) {
//        $error['status'] = "Bạn chưa chọn Trạng thái";
//    } else {
//        $status = $_POST['status'];
//    }
// Bước 3: Kết luận
    if (empty($error)) {
        if (!check_post_cat_exists($post_name)) {
            $sql = "INSERT INTO `post_cat` (`post_name`)"
                    . "VALUES('{$post_name}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_to("?mod=post_cat&act=main");
            } else {
                $_SESSION['error'] = "Thêm mới thất bại";
            }
        } else {
            $_SESSION['error'] = "Tên danh mục bài viết đã tồn tại";
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
                    <h3 id="index" class="fl-left">Thêm mới danh mục bài viết</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <!--                        <label for="cat_id">Danh mục bài viết</label>
                                                <input type="text" name="cat_id" id="cat_id" >-->
                        <label for="post_name">Tên danh mục</label>
                        <input type="text" name="post_name" id="cat_name" >
                        <?php
                        if (!empty($error['post_name'])) {
                            ?>
                            <p class="error"><?php echo $error['post_name']; ?></p>
                            <?php
                        }
                        ?>

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