<?php
get_header();
?>
<?php
if (isset($_GET['id'])) {
    $cat_id = (int) $_GET['id'];
    $list_post = get_list_cat_post_by_cat_id($cat_id);
}

//show_array($list_post);
?>

<?php
// phân trang
$number_rows = db_num_rows("SELECT * FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and post.status = 1 and post_cat.status = 1");
$num_per_page = 8;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_post = get_page($start, $num_per_page);
?>

<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php get_sidebar_product_blog(); ?>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
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
                    }else{
                    ?>
                    <p>Không có bài viết</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=post&act=blog");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>