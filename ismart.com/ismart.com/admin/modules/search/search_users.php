<?php
get_header();
?>

<?php
$keyword = '';
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
} else if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
$sql = "SELECT * FROM `users` where status != 2 and fullname like N'%$keyword%' or email like N'%$keyword%' or address like N'%$keyword%'";
$result = mysqli_query($conn, $sql);
$list_users = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0 && $keyword != "") {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_users[] = $row;
    }
}
?>
<?php
// phân trang
$number_rows = db_num_rows("SELECT * FROM `users` where status != 2 and fullname like N'%$keyword%' or email like N'%$keyword%' or address like N'%$keyword%'");
$num_per_page = 9;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_users = get_search_users($start, $num_per_page, $keyword);

foreach ($list_users as &$user) {// &:tham tri
    $user['url_update'] = "?mod=users&act=update&id={$user['user_id']}";
    $user['url_delete'] = "?mod=users&act=delete&id={$user['user_id']}";
}
unset($user);
//show_array($list_users);
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
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
                    <form method="POST" class="form-s fl-right" action="?mod=search&act=search_users">
                        <input type="text" name="keyword" id="s">
                        <input type="submit" name="btn_search" value="Tìm kiếm">
                    </form>
                    <?php
                    if (!empty($list_users)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Giới tính</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = $start;
                                    foreach ($list_users as $user) {
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $user['fullname']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $user['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    if ($user['status'] == 1) {
                                                        ?>
                                                    <li><a href="<?php echo $user['url_delete']; ?>" title="Xóa" onclick="return confirmAction_users()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a href="" title="Xóa" onclick="return confirmAction_delete_status_users()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    }
                                                    ?>
                            
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $user['phone']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $user['email']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $user['address']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo show_gender($user['gender']); ?></span></td>
                                            <td>
                                                <span class="tbody-text">
                                                    <?php
                                                    if ($user['status'] == 1) {
                                                        ?>
                                                        <a class="btn btn-xs btn-info">Hiển thị</a>
                                                        <?php
                                                    } else if ($user['status'] == 0) {
                                                        ?>
                                                        <a class="btn btn-xs btn-default">Không</a>
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
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Giới tính</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <p class="num_rows">Có <?php echo $num_rows; ?> thành viên trong hệ thống</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=search&act=search_users&keyword=$keyword");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>