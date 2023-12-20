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
if (isset($_POST['btn_add'])) {
    $error = array();

    // Check the post title
    if (empty($_POST['post_title'])) {
        $error['post_title'] = "You have not entered the post title";
    } else {
        $post_title = $_POST['post_title'];
    }

    // Check the category
    if (empty($_POST['cat_id'])) {
        $error['cat_id'] = "You have not selected the category";
    } else {
        $cat_id = $_POST['cat_id'];
    }

    // Check the post description
    if (empty($_POST['post_desc'])) {
        $error['post_desc'] = "You have not entered the post description";
    } else {
        $post_desc = $_POST['post_desc'];
    }

    // Check the post content
    if (empty($_POST['post_content'])) {
        $error['post_content'] = "You have not entered the post content";
    } else {
        $post_content = $_POST['post_content'];
    }

    // Check the featured posts
    if (empty($_POST['featured_posts'])) {
        $error['featured_posts'] = "You have not selected the featured posts";
    } else {
        $featured_posts = $_POST['featured_posts'];
    }

    // Check the image
    if (isset($_FILES['file'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        // Check if the file type is valid
        $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file'] = "You have not uploaded an image";
        }
        $images = $_FILES['file']['name'];
    } else {
        $error['file'] = "You have not uploaded an image";
    }

    // Step 3: Conclusion
    if (empty($error)) {
        if (!check_post_exists($post_title)) {
            $sql = "INSERT INTO `post` (`post_title`,`cat_id`,`images`,`post_desc`,`post_content`,`featured_posts`)"
                . "VALUES('{$post_title}','{$cat_id}','{$images}', '{$post_desc}', '{$post_content}', '{$featured_posts}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Successfully added new post";
                redirect_to("?mod=post&act=main");
            } else {
                $_SESSION['error'] = "Failed to add new post";
            }
        } else {
            $_SESSION['error'] = "Post title already exists";
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
                    <h3 id="index" class="fl-left">New Post</h3>
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
                        <label for="post_title">title </label>
                        <input type="text" name="post_title" id="post_title" >
                        <?php
                        if (!empty($error['post_title'])) {
                            ?>
                            <p class="error"><?php echo $error['post_title']; ?></p>
                            <?php
                        }
                        ?>
                        <div class="form_group clearfix" id="">
                            <label for="detail">image</label>
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
                        <label for="post_desc">description</label>
                        <textarea name="post_desc" id="post_desc"></textarea>
                        <?php
                        if (!empty($error['post_desc'])) {
                            ?>
                            <p class="error"><?php echo $error['post_desc']; ?></p>
                            <?php
                        }
                        ?>
                        <label for="post_content">detail</label>
                        <textarea name="post_content" id="post_content" class="ckeditor"></textarea>
                        <?php
                        if (!empty($error['post_content'])) {
                            ?>
                            <p class="error"><?php echo $error['post_content']; ?></p>
                            <?php
                        }
                        ?>
                       <label for="cat_id">Category</label>
                        <select id="cat_id" name="cat_id">
                            <option value="">-- Select category --</option>
                            <?php   foreach($list_category as $category){ ?>
                            <option value="<?php echo $category['cat_id'] ?>"> <?php echo $category['post_name'] ?></option>
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
                        <label>Featured Post</label>
                        <select name="featured_posts" id="featured_posts">
                            <option value="">--Select featured post --</option>
                            <option value="Nổi bật">Featured</option>
                            <option value="Bình thường">Normal</option>
                        </select>
                        <?php
                        if (!empty($error['featured_posts'])) {
                            ?>
                            <p class="error"><?php echo $error['featured_posts']; ?></p>
                            <?php
                        }
                        ?>
                        <button type="submit" name="btn_add" id="btn_add">Add New</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>