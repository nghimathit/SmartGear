<?php
get_header();
?>
<?php
if (isset($_GET['id'])) {
    $cat_id = (int) $_GET['id'];
    $list_post = get_list_cat_post_by_cat_id($cat_id);
}
?>

<?php
$id = (int) $_GET['id'];
$sql = "SELECT * FROM `post_cat` WHERE `cat_id` = '{$id}' and status = 1";
$result = mysqli_query($conn, $sql);
$post_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $post_cat[] = $row;
}
//show_array($post_cat);
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $number_rows = db_num_rows("SELECT * FROM post,post_cat where post.cat_id = post_cat.cat_id and post.cat_id= $id and post.status = 1 and post_cat.status = 1");
//    echo $number_rows;
    $number_rows = count($list_post);
    $num_per_page = 2;
    $total_row = $number_rows;
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_post = get_post_cat($start, $num_per_page, $id);
}
?>

<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <?php
                if (isset($post_cat)) {
                    ?>
                    <ul class="list-item clearfix">
                        <?php
                        foreach ($post_cat as $cat) {
                            ?>
                            <li>
                                <a href="" title="">Home</a>
                            </li>
                            <li>
                                <a href="?mod=post&act=blog" title="">Blog</a>
                            </li>
                            <li>
                                <a href="?mod=post&act=main&id=<?php echo $cat['cat_id']; ?>" title=""><?php echo $cat['post_name']; ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                } else {
                    ?>
                   <p>No page data</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php get_sidebar_product_blog(); ?>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <?php
                if (isset($post_cat)) {
                    ?>
                    <div class="section-head clearfix">
                        <?php
                        foreach ($post_cat as $cat) {
                            ?>
                            <h3 class="section-title"><?php echo $cat['post_name']; ?></h3>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                  <p>The category does not exist</p>
                    <?php
                }
                ?>
                <div class="section-detail">
                    <?php
                    if (!empty($list_post)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_post as $item) {
                                $item['url'] = "?mod=post&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li class="clearfix">
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb fl-left">
                                        <img src="admin/uploads/<?php echo $item['images']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $item['url']; ?>" title="" class="title"><?php echo $item['post_title']; ?></a>
                                        <span class="create-date"><?php echo $item['created_at']; ?></span>
                                        <p class="desc"><?php echo $item['post_desc']; ?></p>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } else {
                        ?>
                     <p>There are no posts</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php
                    $id = (int) $_GET['id'];
//                    $id = $item['cat_id'];
                    echo get_pagging_category_product($num_page, $page, "?mod=post&act=main", $id);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>