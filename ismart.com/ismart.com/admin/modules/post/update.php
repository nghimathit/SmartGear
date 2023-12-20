<?php
get_header();
?>
<?php
require 'db/connect.php';
$sql = "select * from post_cat";
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
$sql = "SELECT * FROM `post_cat` where status = 1";
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

    // Check title
    if (empty($_POST['post_title'])) {
        $error['post_title'] = "Please enter the post title";
    } else {
        $post_title = $_POST['post_title'];
    }

    // Check category
    if (empty($_POST['cat_id'])) {
        $error['cat_id'] = "Please choose a category";
    } else {
        $cat_id = $_POST['cat_id'];
    }

    // Check description
    if (empty($_POST['post_desc'])) {
        $error['post_desc'] = "Please enter the post description";
    } else {
        $post_desc = $_POST['post_desc'];
    }

    // Check content
    if (empty($_POST['post_content'])) {
        $error['post_content'] = "Please enter the post content";
    } else {
        $post_content = $_POST['post_content'];
    }

    // Check featured posts
    if (empty($_POST['featured_posts'])) {
        $error['featured_posts'] = "Please choose the featured status";
    } else {
        $featured_posts = $_POST['featured_posts'];
    }

    // Check image
    if (isset($_FILES['file'])) {
        $images = $_FILES['file']['name'];
    }

    // Check status
    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }

    if (empty($error)) {
        if (!empty($_FILES['file']['name'])) {
            $sql = "UPDATE `post` SET `post_title`='$post_title',`post_desc`='$post_desc',`post_content`='$post_content',`featured_posts`='$featured_posts',`cat_id`='$cat_id',`images`='$images',`status`='$status' WHERE `id`='$id'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Update successful";
                redirect_to("?mod=post&act=main");
            } else {
                $_SESSION['error'] = "Update failed";
            }
        } else {
            $sql = "UPDATE `post` SET `post_title`='$post_title',`post_desc`='$post_desc',`post_content`='$post_content',`featured_posts`='$featured_posts',`cat_id`='$cat_id',`status`='$status' WHERE `id`='$id'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Update successful";
                redirect_to("?mod=post&act=main");
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
                    <h3 id="index" class="fl-left">Update post</h3>
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
                        <label for="post_title">Title Post</label>
                        <input type="text" name="post_title" id="post_title" value="<?php if (!empty($item['post_title'])) echo $item['post_title']; ?>">
                        <?php
                        if (!empty($error['post_title'])) {
                            ?>
                            <p class="error"><?php echo $error['post_title']; ?></p>
                            <?php
                        }
                        ?>
                        <div class="form_group clearfix">
                            <label for="detail">Image</label>
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
                        <label for="post_desc">Description</label>
                        <textarea id="post_desc" name="post_desc" ><?php if (!empty($item['post_desc'])) echo $item['post_desc']; ?>
                        </textarea>

                        <?php
                        if (!empty($error['post_desc'])) {
                            ?>
                            <p class="error"><?php echo $error['post_desc']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="post_content">detail</label>
                        <textarea id="product_content" class="ckeditor" name="post_content"><?php if (!empty($item['post_content'])) echo $item['post_content']; ?></textarea>
                        <?php
                        if (!empty($error['post_content'])) {
                            ?>
                            <p class="error"><?php echo $error['post_content']; ?></p>
                            <?php
                        }
                        ?>

                        <label>Category Post</label>
                        <select name="cat_id">
                            <option value="0">-- Select Category --</option>
                            <?php foreach ($list_category as $category) { ?>
                                <option <?php if (isset($category['cat_id']) && $category['cat_id'] == $item["cat_id"])
                                    echo "selected='selected'"; ?> value="<?php echo $category['cat_id'] ?>">
                                    <?php echo $category['post_name'] ?>
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
                        </select>
                        <?php
                        if (!empty($error['cat_id'])) {
                            ?>
                            <p class="error"><?php echo $error['cat_id']; ?></p>
                            <?php
                        }
                        ?>
                        <label>Featured Posts</label>
                        <select name="featured_posts" id="featured_posts">
                            <option value="">-- Choose featured status --</option>
                            <option <?php if (isset($item['featured_posts']) && $item['featured_posts'] == 'Nổi bật') echo "selected='selected'"; ?> value="Nổi bật">Featured</option>
                            <option <?php if (isset($item['featured_posts']) && $item['featured_posts'] == 'Bình thường') echo "selected='selected'"; ?> value="Bình thường">Normal</option>
                        </select>
                        <?php
                        if (!empty($error['featured_posts'])) {
                            ?>
                            <p class="error"><?php echo $error['featured_posts']; ?></p>
                            <?php
                        }
                        ?>
                        <label>Status</label>
                        <select name="status" id="status">
                            <option value="">-- Select status --</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '0') echo "selected='selected'"; ?> value="0">No</option>
                            <option <?php if (isset($item['status']) && $item['status'] == '1') echo "selected='selected'"; ?> value="1">Display</option>
                        </select>

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