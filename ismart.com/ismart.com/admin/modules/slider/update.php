<?php
get_header();
$id = (int) $_GET['id'];
?>
<?php
$sql = "select * from `slider` where`id` = $id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_array($result);
//show_array($item);
?>
<?php
if (isset($_POST['btn_update'])) {
    $error = array();
    if (empty($_POST['slider_name'])) {
        $error['slider_name'] = "Bạn chưa nhập Tên slider";
    } else {
        $slider_name = $_POST['slider_name'];
    }
    if (empty($_POST['creator'])) {
        $error['creator'] = "Bạn chưa nhập Người tạo";
    } else {
        $creator = $_POST['creator'];
    }
    // ktra images
    if (isset($_FILES['file'])) {
        $images = $_FILES['file']['name'];
    }
// Bước 3: Kết luận 
    if (empty($error)) {
        if (!empty($_FILES['file']['name'])) {
            $sql = "update `slider` set `slider_name`='{$slider_name}',`images`='{$images}',`creator`='{$creator}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_to("?mod=slider&act=list_slider");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại";
            }
        } else {
            $sql = "update `slider` set `slider_name`='{$slider_name}',`creator`='{$creator}' where `id`='{$id}'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success'] = "Cập nhật thành công";
                redirect_to("?mod=slider&act=list_slider");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại";
            }
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
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
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
                        <label for="slider_name">Tên slider</label>
                        <input type="text" name="slider_name" id="slider_name" value="<?php if (!empty($item['slider_name'])) echo $item['slider_name']; ?>">
                        <?php echo form_error('slider_name') ?>
                        <div class="form_group clearfix" id="">
                            <label for="detail">Hình ảnh</label>
                            <input type="file" name="file" id="file" data-uri="?mod=slider&act=upload_single">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <div id="show_list_file" >
                                <img src="uploads/<?php echo $item['images'] ?> ">
                            </div>
                            <?php echo form_error('file') ?>
                        </div>
                        <label for="creator">Người tạo</label>
                        <input type="text" name="creator" id="creator" value="<?php if (!empty($item['creator'])) echo $item['creator']; ?>">
                        <?php echo form_error('creator') ?>
                        <button type="submit" name="btn_update" id="btn_update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>