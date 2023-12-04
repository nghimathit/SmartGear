<?php
get_header();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    show_array($_POST);
}
?>
<?php
$id = (int) $_GET['id'];
?>
<?php
$sql = "select *,post.status from `post`, `post_cat` where post.cat_id = post_cat.cat_id and `id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>
<?php
if (isset($_POST['btn_update'])) {
    $error = array();

    //Ktra tiêu đề
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
        $images = $_FILES['file']['name'];
    }
    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }
// ủa rồi cập nhật ảnh đâu
    if (empty($error)) {
        if (!empty($_FILES['file']['name'])) {
            $sql = "update `post` set `post_title`='{$post_title}',`post_desc`='{$post_desc}',`post_content`='{$post_content}',`featured_posts`='{$featured_posts}',`cat_id`='{$cat_id}',`images`='$images',`status`='$status' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_to("?mod=post&act=main");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại";
            }
        } else {
            $sql = "update `post` set `post_title`='{$post_title}',`post_desc`='{$post_desc}',`post_content`='{$post_content}',`featured_posts`='{$featured_posts}',`cat_id`='{$cat_id}',`status`='$status' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_to("?mod=post&act=main");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại";
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
                    <h3 id="index" class="fl-left">Cập nhật bài viết</h3>
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
                        <label for="post_title">Tiêu đề bài viết</label>
                        <input type="text" name="post_title" id="post_title" value="<?php if (!empty($item['post_title'])) echo $item['post_title']; ?>">
                        <?php
                        if (!empty($error['post_title'])) {
                            ?>
                            <p class="error"><?php echo $error['post_title']; ?></p>
                            <?php
                        }
                        ?>
                        <div class="form_group clearfix">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=post&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                                <img src="uploads/<?php echo $item['images'] ?> ">
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
                        <textarea id="post_desc" name="post_desc" ><?php if (!empty($item['post_desc'])) echo $item['post_desc']; ?>
                        </textarea>

                        <?php
                        if (!empty($error['post_desc'])) {
                            ?>
                            <p class="error"><?php echo $error['post_desc']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="post_content">Chi tiết bài viết</label>
                        <textarea id="product_content" class="ckeditor" name="post_content"><?php if (!empty($item['post_content'])) echo $item['post_content']; ?></textarea>
                        <?php
                        if (!empty($error['post_content'])) {
                            ?>
                            <p class="error"><?php echo $error['post_content']; ?></p>
                            <?php
                        }
                        ?>

                        <label>Danh mục bài viết</label>
                        <select name="cat_id">
                            <option value="0">-- Chọn danh mục --</option>
                            <option <?php if (isset($item['cat_id']) && $item['cat_id'] == '1') echo "selected='selected'"; ?> value="1">1</option>
                            <option <?php if (isset($item['cat_id']) && $item['cat_id'] == '2') echo "selected='selected'"; ?> value="2">2</option>
                            <option <?php if (isset($item['cat_id']) && $item['cat_id'] == '3') echo "selected='selected'"; ?> value="3">3</option>
                            <option <?php if (isset($item['cat_id']) && $item['cat_id'] == '4') echo "selected='selected'"; ?> value="4">4</option>
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
                            <option <?php if (isset($item['featured_posts']) && $item['featured_posts'] == 'Nổi bật') echo "selected='selected'"; ?> value="Nổi bật">Nổi bật</option>
                            <option <?php if (isset($item['featured_posts']) && $item['featured_posts'] == 'Bình thường') echo "selected='selected'"; ?> value="Bình thường">Bình thường</option>
                        </select>
                        <?php
                        if (!empty($error['featured_posts'])) {
                            ?>
                            <p class="error"><?php echo $error['featured_posts']; ?></p>
                            <?php
                        }
                        ?>
                        <label>Trạng thái</label>
                        <select name="status" id="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '0') echo "selected='selected'"; ?> value="0">Không</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '1') echo "selected='selected'"; ?> value="1">Hiển thị</option>
                        </select>

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