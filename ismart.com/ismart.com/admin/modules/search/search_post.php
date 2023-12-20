
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

$sql = "SELECT *,post.id,post.status FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status != 2 and post_title like N'%$keyword%'";
$result = mysqli_query($conn, $sql);
$list_post = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0 && $keyword != "") {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_post[] = $row;
    }
}
// phân trang
$number_rows = db_num_rows("SELECT *,post.id,post.status FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status != 2 and post_title like N'%$keyword%'");
$num_per_page = 5;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_post = get_search_post($start, $num_per_page, $keyword);
//show_array($list_post);
foreach ($list_post as &$post) {// &:tham tri
    $post['url_update'] = "?mod=post&act=update&id={$post['id']}";
    $post['url_delete'] = "?mod=post&act=delete&id={$post['id']}";
}
unset($post);
?>


<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">List of articles</h3>
                    <a href="?mod=post&act=add" title="" id="add-new" class="fl-left">Add new</a>
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
                        <form method="post" class="form-s fl-right" action="?mod=search&act=search_post">
                            <input type="text" name="keyword" id="s">
                            <input type="submit" name="btn_search" value="search">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_post)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr><td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Image</span></td>
                                        <td><span class="thead-text">Title</span></td>
                                        <td><span class="thead-text">Category</span></td>
                                        <td><span class="thead-text">Description</span></td>
                                        <td><span class="thead-text">Date created</span></td>
                                        <td><span class="thead-text">Update date</span></td>
                                        <td><span class="thead-text">Featured articles</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = $start;
                                    foreach ($list_post as $post) {
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
<!--                                                    <img src="uploads/<?php echo $post['images']; ?>" alt="">-->
                                                    <img src="uploads/<?php  echo $post['images'] ?>" width="80px" height="80px" alt="">
			                	<img src="uploads/<?php  echo $post['images'] ?>" width="80px" height="80px" alt=""> 
                                                </div>

                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $post['post_title']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $post['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="<?php echo $post['url_delete']; ?>" title="Xóa" onclick="return confirmAction_post()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>

                                            <td><span class="tbody-text"><?php echo $post['post_name']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $post['post_desc']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $post['created_at']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $post['updated_at']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $post['featured_posts']; ?></span></td>
                                            <td>
                                                <span class="tbody-text">
                                                    <?php
                                                    if ($post['status'] == 1) {
                                                        ?>
                                                     <a class="btn btn-xs btn-info">Display</a>
                                                        <?php
                                                    } else if ($post['status'] == 0) {
                                                        ?>
                                                        <a class="btn btn-xs btn-default">No</a>
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
                                        <td><span class="thead-text">Image</span></td>
                                        <td><span class="thead-text">Title</span></td>
                                        <td><span class="thead-text">Category</span></td>
                                        <td><span class="thead-text">Description</span></td>
                                        <td><span class="thead-text">Date created</span></td>
                                        <td><span class="thead-text">Update date</span></td>
                                        <td><span class="thead-text">Featured articles</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    } else {
                        ?>
                      <p>No data found</p>
                        <?php
                    }
                    ?>
                </div>
                <p class="num_rows">Yes <?php echo $num_rows; ?> products in the system</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=search&act=search_post&keyword=$keyword");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>