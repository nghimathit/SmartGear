<?php
get_header();
//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    show_array($_POST);
//}
?>
<?php
$id = (int) $_GET['id'];
?>
<?php
$sql = "select * from `page` where `id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>
<?php
if (isset($_POST['btn_update'])) {
    $error = array();

    if (empty($_POST['page_title'])) {
        $error['page_title'] = "Bạn chưa nhập Tiêu đề trang";
    } else {
        $page_title = $_POST['page_title'];
    }

    if (empty($_POST['page_content'])) {
        $error['page_content'] = "Bạn chưa nhập Chi tiết trang";
    } else {
        $page_content = $_POST['page_content'];
    }

// Bước 3: Kết luận 
    if (empty($error)) {
        $sql = "update `page` set `page_title`='{$page_title}',`page_content`='{$page_content}' where `id`='{$id}'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Cập nhật thành công";
            redirect_to("?mod=page&act=main");
        } else {
            $_SESSION['error'] = "Cập nhật thất bại";
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
                    <h3 id="index" class="fl-left">Thêm trang</h3>
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
                    <form action="" method="post">
                        <label for="page_title">Tiêu đề</label>
                        <input type="text" name="page_title" id="page_title" value="<?php if (!empty($item['page_title'])) echo $item['page_title']; ?>" >
                        <?php echo form_error('page_title'); ?>

                        <label for="page_content">Chi tiết</label>
                        <textarea name="page_content" id="page_content" class="ckeditor"><?php if (!empty($item['page_content'])) echo $item['page_content']; ?></textarea>
                        <?php echo form_error('page_content'); ?>
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