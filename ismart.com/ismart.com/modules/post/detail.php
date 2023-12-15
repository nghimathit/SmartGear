<?php
get_header();
?>
<?php
$id = (int) $_GET['id'];
//$post_cat_id = get_list_post_cat($id);
////show_array($post_cat);

$sql = "SELECT * FROM `post`,`post_cat` where post.cat_id = post_cat.cat_id and id={$id}";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_cat[] = $row;
}
//show_array($list_cat);
?>

<?php
$id = (int) $_GET['id'];
$sql = "SELECT * FROM `post`, `post_cat` WHERE `id` = '{$id}' and post.cat_id = post_cat.cat_id";
$result = mysqli_query($conn, $sql);
//$info_cat_mobile = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
}
//show_array($row);
?>  

<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <?php
                if (isset($list_cat)) {
                    ?>
                    <ul class="list-item clearfix">
                        <?php
                        foreach ($list_cat as $cat) {
                            ?>
                            <li>
                                <a href="" title="">Home</a>
                            </li>
                            <li>
                                <a href="" title="">Blog</a>
                            </li>
                            <li>
                                <a href="?mod=post&act=main&id=<?php echo $cat['cat_id']; ?>" title=""><?php echo $cat['post_name']; ?></a>
                            </li>
                            <li>
                                <a href="" title=""><?php echo $cat['post_title']; ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php get_sidebar_product_blog(); ?> 
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $row['post_title']; ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo $row['created_at']; ?></span>
                    <div class="detail">
                        <p><strong><?php echo $row['post_desc']; ?></strong></p>


                        <p><?php echo $row['post_content']; ?></p>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    <div class="fb-comments" data-href="http://localhost:9000/laravel_it_viec/ismart/" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>