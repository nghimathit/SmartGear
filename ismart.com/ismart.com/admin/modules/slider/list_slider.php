<?php
get_header();
?>
<?php
$list_slider = get_list_slider();
//show_array($list_slider);
// phân trang
$number_rows = db_num_rows("SELECT * FROM `slider` where status != 2");
$num_per_page = 8;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_slider = get_slider($start, $num_per_page);

//show_array($list_post);
foreach ($list_slider as &$item) {// &:tham tri
    $item['url_update'] = "?mod=slider&act=update&id={$item['id']}";
    $item['url_delete'] = "?mod=slider&act=delete&id={$item['id']}";
}
unset($item);
?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Dbook slider</h3>
                    <a href="?mod=slider&act=add_slider" title="" id="add-new" class="fl-left">Add new</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success'])
                    ?>
                </div>
            <?php endif; ?>

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
                    <!--                    <div class="filter-wp clearfix">
                                            <ul class="post-status fl-left">
                                                <li class="all"><a href="">Tất cả <span class="count">(69)</span></a> |</li>
                                                <li class="publish"><a href="">Đã đăng <span class="count">(51)</span></a> |</li>
                                                <li class="pending"><a href="">Chờ xét duyệt<span class="count">(0)</span></a></li>
                                                <li class="pending"><a href="">Thùng rác<span class="count">(0)</span></a></li>
                                            </ul>
                                            <form method="GET" class="form-s fl-right">
                                                <input type="text" name="s" id="s">
                                                <input type="submit" name="sm_s" value="Tìm kiếm">
                                            </form>
                                        </div>-->
                    <?php
                    if (isset($list_slider)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                    <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Slider name</span></td>
                                        <td><span class="thead-text">Image</span></td>
                                        <td><span class="thead-text">Creator</span></td>
                                        <td><span class="thead-text">Date created</span></td>
                                        <td><span class="thead-text">Updated date</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = 0;
                                    foreach ($list_slider as $item) {
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['slider_name']; ?></span></td>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="uploads/<?php echo $item['images']; ?>" alt="">
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['creator']; ?></span></td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['created_at']; ?></a>
                                                    <a href="" title=""><?php echo $item['updated_at']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $item['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="<?php echo $item['url_delete']; ?>" title="Xóa" onclick="return confirmAction_slider()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['updated_at']; ?></span></td>
                                            <td>
                                                <span class="tbody-text">
                                                    <?php
                                                    if ($item['status'] == 1) {
                                                        ?>
                                                        <a href="?mod=slider&act=error_action&id=<?php echo $item['id'] ?>" class="btn btn-xs btn-info">Show</a>
                                                        <?php
                                                    } else if ($item['status'] == 0) {
                                                        ?>
                                                        <a href="?mod=slider&act=error_action&id=<?php echo $item['id'] ?>" class="btn btn-xs btn-default">No</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </span>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Slider name</span></td>
                                        <td><span class="thead-text">Image</span></td>
                                        <td><span class="thead-text">Creator</span></td>
                                        <td><span class="thead-text">Date created</span></td>
                                        <td><span class="thead-text">Updated date</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <p class="num_rows">Yes <?php echo $number_rows; ?> slider in system</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=slider&act=list_slider");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>