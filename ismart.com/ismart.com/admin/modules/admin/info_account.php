<?php
get_header();
?>
<?php
$sql = "SELECT * FROM `admin` where status != 2";
$result = mysqli_query($conn, $sql);
$list_admin = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_admin[] = $row;
    }
}
foreach ($list_admin as &$admin) {// &:tham tri
    $admin['url_update'] = "?mod=admin&act=update&id={$admin['id']}";
    $admin['url_delete'] = "?mod=admin&act=delete&id={$admin['id']}";
    $admin['url_change_pass'] = "?mod=admin&act=change_pass&id={$admin['id']}";
}
unset($admin);
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Admin list</h3>
                    <?php
                    if ($_SESSION['role'] == 1) {
                        ?>
                        <a href="?mod=admin&act=add" title="" id="add-new" class="fl-left">Add new</a>
                        <?php
                    } else if ($_SESSION['role'] == 2) {
                        ?>
                        <a href="" title="" onclick="return confirmAction_role()" id="add-new" class="fl-left">Add new</a>
                        <?php
                    }
                    ?>

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
                    <?php
                    if (!empty($list_admin)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                       <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Display name</span></td>
                                        <td><span class="thead-text">Image</span></td>
                                        <td><span class="thead-text">Username</span></td>
                                        <td><span class="thead-text">Change password</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Address</span></td>
                                        <td><span class="thead-text">Phone number</span></td>
                                        <td><span class="thead-text">Gender</span></td>
    <!-- <td><span class="thead-text">Status</span></td>-->
                                        <td><span class="thead-text">Permissions</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = 0;
                                    foreach ($list_admin as $admin) {
                                        $admin['url'] = "?mod=admin&act=change_pass&id={$admin['id']}";
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $admin['fullname']; ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="uploads/<?php echo $admin['avatar']; ?>" alt="">
                                                </div>

                                            </td>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $admin['username']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <?php
                                                    if ($_SESSION['user_login_admin'] == $admin['username']) {
                                                        ?>
                                                        <li><a href="<?php echo $admin['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    }
                                                    if (  $_SESSION['role'] == 1) {
                                                        ?>
                                                        <li><a href="<?php echo $admin['url_delete']; ?>" onclick="return confirmAction_user_admin()" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </td>
                                            <td>
                                                <?php
                                                if ($_SESSION['user_login_admin'] == $admin['username']) {
                                                    ?>
                                                    <a href="<?php echo $admin['url']; ?>" title="" class="tbody-text">Change password</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="" title="" onclick="return confirmAction_change_password()" class="tbody-text">Change password</a>
                                                    <?php
                                                }
                                                ?>

                                            </td>
                                            <td><span class="tbody-text"><?php echo $admin['email']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $admin['address']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $admin['phone']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo show_gender($admin['gender']); ?></span></td>
                                            <td>
                                                <span class="tbody-text">
                                                    <a href="" class="btn btn-xs <?php echo $admin['role'] == 1 ? 'btn-info' : 'btn-admin' ?>">
                                                        <?php echo $admin['role'] == 1 ? 'Admin' : 'Quản trị viên' ?>
                                                    </a>
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
                                        <td><span class="thead-text">Display name</span></td>
                                        <td><span class="thead-text">Image</span></td>
                                        <td><span class="thead-text">Username</span></td>
                                        <td><span class="thead-text">Change password</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Address</span></td>
                                        <td><span class="thead-text">Phone number</span></td>
                                        <td><span class="thead-text">Gender</span></td>
    <!-- <td><span class="thead-text">Status</span></td>-->
                                        <td><span class="thead-text">Permissions</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <p class="num_rows">There are <?php echo $num_rows; ?> administrators in the system</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>