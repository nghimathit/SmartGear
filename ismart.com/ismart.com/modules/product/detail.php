<?php
get_header();
?>
<?php
$cat_id = (int) $_GET['id'];
$id = (int) $_GET['id'];
?>
<?php
$sql = "SELECT * FROM `category`,`product` where category.cat_id = product.cat_id and id={$id}";
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
# Lấy sản phẩm theo id
$item = get_product_by_id($id);
//show_array($item)
?>

<?php
$cat_id = (int) $_GET['cat_id'];
$id = (int) $_GET['id'];
// Lấy danh sách sản phẩm cùng loại
$sql = "SELECT *,product.created_at FROM `product` WHERE cat_id = '$cat_id' and product.id<>$id and status = 1";
$result = mysqli_query($conn, $sql);
$product_same_category = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $product_same_category[] = $row;
    }
}
//show_array($product_same_category);
?>

<div id="main-content-wp" class="clearfix detail-product-page">
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
                                <a href="?" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="?mod=product&act=category_product&id=<?php echo $cat['cat_id']; ?>" title=""><?php echo $cat['cat_name']; ?></a>
                            </li>
                            <li>
                                <a href="" title=""><?php echo $cat['product_name']; ?></a>
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
        <?php get_sidebar_product(); ?>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="admin/uploads/<?php echo $item['product_thumb'] ?>"/>
                        </a>
                        <div id="list-thumb">
                            <a href="" data-image="admin/uploads/<?php echo $item['list_thumb_1'] ?>" data-zoom-image="admin/uploads/<?php echo $item['list_thumb_1'] ?>">
                                <img id="zoom-img" src="admin/uploads/<?php echo $item['list_thumb_1'] ?>" />
                            </a>
                            <a href="" data-image="admin/uploads/<?php echo $item['list_thumb_2'] ?>" data-zoom-image="admin/uploads/<?php echo $item['list_thumb_2'] ?>">
                                <img id="zoom-img" src="admin/uploads/<?php echo $item['list_thumb_2'] ?>" />
                            </a>
                            <a href="" data-image="admin/uploads/<?php echo $item['list_thumb_3'] ?>" data-zoom-image="admin/uploads/<?php echo $item['list_thumb_3'] ?>">
                                <img id="zoom-img" src="admin/uploads/<?php echo $item['list_thumb_3'] ?>" />
                            </a>
                            <a href="" data-image="admin/uploads/<?php echo $item['list_thumb_4'] ?>" data-zoom-image="admin/uploads/<?php echo $item['list_thumb_4'] ?>">
                                <img id="zoom-img" src="admin/uploads/<?php echo $item['list_thumb_4'] ?>" />
                            </a>
                            <a href="" data-image="admin/uploads/<?php echo $item['list_thumb_5'] ?>" data-zoom-image="admin/uploads/<?php echo $item['list_thumb_5'] ?>">
                                <img id="zoom-img" src="admin/uploads/<?php echo $item['list_thumb_5'] ?>" />
                            </a>
                            <a href="" data-image="admin/uploads/<?php echo $item['list_thumb_6'] ?>" data-zoom-image="admin/uploads/<?php echo $item['list_thumb_6'] ?>">
                                <img id="zoom-img" src="admin/uploads/<?php echo $item['list_thumb_6'] ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="admin/uploads/<?php echo $item['product_thumb'] ?>" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $item['product_name']; ?></h3>
                        <div class="desc">
                            <p class="product_content"><?php echo $item['product_desc']; ?></p>

                        </div>
                        <?php
                        if ($item['qty_product'] > 0) {
                            ?>
                            <div class="num-product">
                                <span class="title">Còn hàng: </span>
                                <span class="status"><?php echo $item['qty_product']; ?> sản phẩm</span>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="num-product">
                                <span class="title">Hết hàng </span>
                                <span class="status"><?php echo $item['qty_product']; ?> sản phẩm</span>
                            </div>
                            <?php
                        }
                        ?>

                        <p class="price"><?php echo currency_format($item['price_new']); ?> <span class="price_old"><?php echo currency_format($item['price_old']); ?></span></p>

                        <div id="num-order-wp">
                            <button type="submit" title="" id="minus" onclick="updateItem1(<?php echo $item['id'] ?>)"><i class="fa fa-minus"></i></button>
                            <input type="text" name="num-order"  value="1"  id="num-order" class="sl_<?php echo $item['id']; ?>">
                            <button type="submit" title="" id="plus" onclick="updateItem(<?php echo $item['id'] ?>)"><i class="fa fa-plus"></i></button>
                        </div>
                        <script>
                            function updateItem(id)
                            {
                                sl = $(".sl_" + id).val();
                                sl++;
                            }
                            function updateItem1(id)
                            {
                                sl = $(".sl_" + id).val();
                                sl--;
                            }
                            function updateItem2(id)
                            {
                                sl = $(".sl_" + id).val();
                                $.get("?mod=cart&act=add&cat_id=<?php echo $item['cat_id']; ?>&id=<?php echo $item['id']; ?>", {'sl': sl})
                            }
                        </script>
                        <!--                        </div>-->
                        <?php
                        if ($item['qty_product'] > 0) {
                            ?>
                            <a href="?mod=cart&act=show" onclick="updateItem2(<?php echo $item['id'] ?>)"  title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                            <?php
                        } else {
                            ?>
                            <a href="" onclick="return confirmAction_detail()" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p class="product_content"><?php echo $item['product_content']; ?></p>
                </div>
            </div>
            <div id="like-fb" class="cleafix">
                <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Flocalhost%3A9000%2Fismart.com%2Fismart.com%2F%3Fpage%3Dhome&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
            <div class="fb-comments" data-href="http://localhost:9000/ismart.com/ismart.com/?page=home" data-width="100%" data-numposts="5"></div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm cùng loại</h3>
                </div>

                <div class="section-detail">
                    <?php
                    if (!empty($product_same_category)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($product_same_category as $same) {
                                $same['url'] = "?mod=product&act=detail&cat_id={$same['cat_id']}&id={$same['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($same['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate));// ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $same['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $same['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $same['url']; ?>" title="" class="product-name"><?php echo $same['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($same['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($same['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($same['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $same['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
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
    </div>
</div>

<?php
get_footer();
?>