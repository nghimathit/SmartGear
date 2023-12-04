<?php
require 'db/connect.php';
?>
<?php
$sql = "select * from category";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_cat[] = $row;
    }
}
//show_array($list_cat);
?>
<?php
$sql = "SELECT * FROM `post_cat` where post_cat.status = 1";
$result = mysqli_query($conn, $sql);
$list_post_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_post_cat[] = $row;
    }
}

//show_array($list_post_cat);
?>
<?php
// sản phẩm bán chạy
$selling_products = get_selling_products();

//show_array($selling_products);
?>

<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục bài viết</h3>
        </div>
        <div class="secion-detail">
            <?php
            if (isset($list_post_cat)) {
                ?>
                <ul class="list-item">
                    <?php
                    foreach ($list_post_cat as $post_cat) {
                        ?>
                        <li>
                            <a href="?mod=post&act=main&id=<?php echo $post_cat['cat_id'] ?>" title=""><?php echo $post_cat['post_name'] ?></a>
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
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section" id="selling-wp">
            <div class="section-detail">
                <?php
                if (!empty($selling_products)) {
                    ?>
                    <ul class="list-item">
                        <?php
                        foreach ($selling_products as $item) {
                            $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                            ?>
                            <li class="clearfix">
                                <a href="<?php echo $item['url']; ?>" title="" class="thumb fl-left">
                                    <img src="admin/uploads/<?php echo $item['product_thumb']; ?>" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>

                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <a href="?mod=cart&act=add&id=<?php echo $item['id']; ?>" title="" class="buy-now">Mua ngay</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="" onclick="return confirmAction_detail()" title="" class="buy-now">Mua ngay</a>
                                        <?php
                                    }
                                    ?>

                                </div>
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
    </div>
<!--    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_blog_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>-->
</div>