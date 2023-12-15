<?php get_header(); ?>
<?php
if (isset($_POST['btn_add'])) {
    $error = array();
    if (empty($_POST['slider_name'])) {
        $error['slider_name'] = "You have not entered a slider name";
    } else {
        $slider_name = $_POST['slider_name'];
    }
    if (empty($_POST['creator'])) {
        $error['creator'] = "You have not entered a Creator";
    } else {
        $creator = $_POST['creator'];
    }
    // ktra images
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
        if (!check_slider_exists($slider_name)) {
            $sql = "INSERT INTO `slider` (`slider_name`,`images`,`creator`)"
                    . "VALUES('{$slider_name}','{$images}', '{$creator}')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "New addition successful";
                redirect_to("?mod=slider&act=list_slider");
            } else {
                $_SESSION['error'] = "New addition failed";
            }
        } else {
            $_SESSION['error'] = "Slider name already exists";
        }
    }
}
?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                <h3 id="index" class="fl-left">Add Slider</h3>
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
                        <label for="slider_name">Tslider</label>
                        <input type="text" name="slider_name" id="slider_name">
                        <?php echo form_error('slider_name') ?>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Image</label>
                            <input type="file" name="file" id="file" data-uri="?mod=slider&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                            </div>
                            <?php echo form_error('file') ?>
                        </div>
                        <label for="creator">Creator</label>
                        <input type="text" name="creator" id="creator">
                        <?php echo form_error('creator') ?>
                        <button type="submit" name="btn_add" id="btn_add">Add new</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>