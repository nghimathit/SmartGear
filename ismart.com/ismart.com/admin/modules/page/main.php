<?php
get_header();
?>
<?php
$sql = "SELECT * FROM `page` where status != 2";
$result = mysqli_query($conn, $sql);
$list_page = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_page[] = $row;
    }
}

foreach ($list_page as &$page) {// &:tham tri
    $page['url_update'] = "?mod=page&act=update&id={$page['id']}";
    $page['url_delete'] = "?mod=page&act=delete&id={$page['id']}";
}
unset($page);
?>


<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">List page</h3>
                    <a href="?mod=page&act=add" title="" id="add-new" class="fl-left">Add new</a>
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
                    <form method="POST" class="form-s fl-right" action="?mod=search&act=search_page">
                        <input type="text" name="keyword" id="s">
                        <input type="submit" name="btn_search" value="Search">
                    </form>
                    <?php
                    if (!empty($list_page)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">title</span></td>
                                        <td><span class="thead-text">create day</span></td>
                                        <td><span class="thead-text">update day</span></td>   
                                        <td><span class="thead-text">Status</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = 0;
                                    foreach ($list_page as $page) {
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
        <!--                                            <td><span class="tbody-text"><php echo $page['page_title']; ?></span></td>-->
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $page['page_title']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $page['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="<?php echo $page['url_delete']; ?>" title="Xóa" onclick="return confirmAction_page()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $page['created_at']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $page['updated_at']; ?></span></td>
                                            <td>
                                                <span class="tbody-text">
                                                    <?php
                                                    if ($page['status'] == 1) {
                                                        ?>
                                                        <a href="?mod=page&act=error_action&id=<?php echo $page['id'] ?>" class="btn btn-xs btn-info">display</a>
                                                        <?php
                                                    } else if ($page['status'] == 0) {
                                                        ?>
                                                        <a href="?mod=page&act=error_action&id=<?php echo $page['id'] ?>" class="btn btn-xs btn-default">No</a>
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
                                        <td><span class="thead-text">title</span></td>
                                        <td><span class="thead-text">create day</span></td>
                                        <td><span class="thead-text">update day</span></td>   
                                        <td><span class="thead-text">Status</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <p class="num_rows">have <?php echo $num_rows; ?> page in system</p>
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