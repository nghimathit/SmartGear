<?php
get_header();
?>

<?php
$sql = "SELECT * FROM `post_cat` where status != 2";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_cat[] = $row;
    }
}
// phân trang
$number_rows = db_num_rows("SELECT * FROM `post_cat` where status != 2");
$num_per_page = 6;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_cat = get_post_cat($start, $num_per_page);

foreach ($list_cat as &$cat) {// &:tham tri
    $cat['url_update'] = "?mod=post_cat&act=update&id={$cat['cat_id']}";
    $cat['url_delete'] = "?mod=post_cat&act=delete&id={$cat['cat_id']}";
}
unset($cat);
//show_array($list_cat);
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Category post</h3>
                    <a href="?mod=post_cat&act=add" title="" id="add-new" class="fl-left">Add new</a>
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
                    <div class="filter-wp clearfix">
                        <form method="post" class="form-s fl-right" action="?mod=search&act=search_post_cat">
                            <input type="text" name="keyword" id="s">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_cat)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
    <td><span class="thead-text">No.</span></td>
    <td><span class="thead-text">Post Name</span></td>
    <td><span class="thead-text">Created Date</span></td>
    <td><span class="thead-text">Updated Date</span></td>   
    <td><span class="thead-text">Status</span></td>
</tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $temp = $start;
                                    foreach ($list_cat as $cat) {
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>

                                            <td class="clearfix">

                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $cat['post_name']; ?></a>
                                                </div> 
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $cat['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="<?php echo $cat['url_delete']; ?>" title="Xóa" onclick="return confirmAction_post_cat()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $cat['created_at']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $cat['updated_at']; ?></span></td>
                                            <td>
                                                <span class="tbody-text">
                                                    <?php
                                                    if ($cat['status'] == 1) {
                                                        ?>
                                                        <a href="?mod=post_cat&act=error_action&cat_id=<?php echo $cat['cat_id'] ?>" class="btn btn-xs btn-info">Display</a>
                                                        <?php
                                                    } else if ($cat['status'] == 0) {
                                                        ?>
                                                        <a href="?mod=post_cat&act=error_action&cat_id=<?php echo $cat['cat_id'] ?>" class="btn btn-xs btn-default">No</a>
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
    <td><span class="thead-text">No.</span></td>
    <td><span class="thead-text">Post Name</span></td>
    <td><span class="thead-text">Created Date</span></td>
    <td><span class="thead-text">Updated Date</span></td>   
    <td><span class="thead-text">Status</span></td>
</tr>

                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <p class="num_rows">there are <?php echo $num_rows; ?> List of articles in the system</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <?php
                        echo get_pagging($num_page, $page, "?mod=post_cat&act=main");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>