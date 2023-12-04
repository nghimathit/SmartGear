<?php
get_header();
?>

<?php
if (isset($_POST['btn_add'])) {
    $error = array();

    //Ktra tiêu đề file add.php dey bac
    if (empty($_POST['post_title'])) {
        $error['post_title'] = "Bạn chưa nhập Tiêu đề bài viết";
    } else {
        $post_title = $_POST['post_title'];
    }
    //Ktra danh muc
    if (empty($_POST['cat_id'])) {
        $error['cat_id'] = "Bạn chưa chon Danh mục";
    } else {
        $cat_id = $_POST['cat_id'];
    }
    //Ktra hình ảnh

    if (empty($_POST['post_desc'])) {
        $error['post_desc'] = "Bạn chưa nhập Mô tả bài viết";
    } else {
        $post_desc = $_POST['post_desc'];
    }
    if (empty($_POST['post_content'])) {
        $error['post_content'] = "Bạn chưa nhập Chi tiết bài viết";
    } else {
        $post_content = $_POST['post_content'];
    }
    if (empty($_POST['featured_posts'])) {
        $error['featured_posts'] = "Bạn chưa chọn Bài viết nổi bật";
    } else {
        $featured_posts = $_POST['featured_posts'];
    }

    //Ktra hình ảnh
    if (isset($_FILES['file'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file'] = "Bạn chưa upload hình ảnh";
        }
        $images = $_FILES['file']['name'];
    } else {
        $error['file'] = "Bạn chưa upload hình ảnh";
    }

// Bước 3: Kết luận 
    if (empty($error)) {
        if (!check_post_exists($post_title)) {
            $sql = "INSERT INTO `post` (`post_title`,`cat_id`,`images`,`post_desc`,`post_content`,`featured_posts`)"
                    . "VALUES('{$post_title}','{$cat_id}','{$images}', '{$post_desc}', '{$post_content}', '{$featured_posts}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Thêm mới thành công";
                redirect_to("?mod=post&act=main");
            } else {
                $_SESSION['error'] = "Thêm mới thất bại";
            }
        } else {
            $_SESSION['error'] = "Tiêu đề bài viết đã tồn tại";
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
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
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
                    <form id="form-upload-single"  action="" enctype="multipart/form-data" method="post">
                        <label for="post_title">Tiêu đề</label>
                        <input type="text" name="post_title" id="post_title" >
                        <?php
                        if (!empty($error['post_title'])) {
                            ?>
                            <p class="error"><?php echo $error['post_title']; ?></p>
                            <?php
                        }
                        ?>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=post&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                            </div>
                            <?php
                            if (!empty($error['file'])) {
                                ?>
                                <p class="error"><?php echo $error['file']; ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <label for="post_desc">Mô tả</label>
                        <textarea name="post_desc" id="post_desc"></textarea>
                        <?php
                        if (!empty($error['post_desc'])) {
                            ?>
                            <p class="error"><?php echo $error['post_desc']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="post_content">Chi tiết</label>
                        <textarea name="post_content" id="post_content" class="ckeditor"></textarea>
                        <?php
                        if (!empty($error['post_content'])) {
                            ?>
                            <p class="error"><?php echo $error['post_content']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="cat_id">Danh mục</label>
                        <select id="cat_id" name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="1">Đánh giá</option>
                            <option value="2">Cẩm nang</option>
                            <option value="3">Tin tức</option>
                            <option value="4">So sánh</option>
                        </select>
                        <?php
                        if (!empty($error['cat_id'])) {
                            ?>
                            <p class="error"><?php echo $error['cat_id']; ?></p>
                            <?php
                        }
                        ?>
                        <label>Bài viết nổi bật</label>
                        <select name="featured_posts" id="featured_posts">
                            <option value="">-- Chọn bài viết nổi bật --</option>
                            <option value="Nổi bật">Nổi bật</option>
                            <option value="Bình thường">Bình thường</option>
                        </select>
                        <?php
                        if (!empty($error['featured_posts'])) {
                            ?>
                            <p class="error"><?php echo $error['featured_posts']; ?></p>
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