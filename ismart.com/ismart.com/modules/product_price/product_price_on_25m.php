<?php
get_header();
?>

<?php
$sql = "SELECT * FROM `category`";
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
$list_product = get_list_price_on_25m($id);

//show_array($list_product);
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <?php
            if ($list_cat) {
                ?>
                <ul class="list-item clearfix">
                    <?php
                    foreach ($list_cat as $cat) {
                        ?>
                        <li>
                            <a href="?" title="">Home</a>
                        </li>
                        <li>
                            <a href="" title=""><?php echo $cat['cat_name']; ?></a>
                        </li>
                        <li>
                            <a href="?" title="">Price over 25,000,000 VND</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Products priced over 25,000,000 VND</h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Display <?php echo count($list_product); ?> products</p>
                        </div>
                    </div>
                    <!--                    <h3 class="section-title fl-left">Laptop</h3>
                                        <div class="filter-wp fl-right">
                                            <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                                            <div class="form-filter">
                                                <form method="POST" action="">
                                                    <select name="select">
                                                        <option value="0">Sắp xếp</option>
                                                        <option value="1">Từ A-Z</option>
                                                        <option value="2">Từ Z-A</option>
                                                        <option value="3">Giá cao xuống thấp</option>
                                                        <option value="3">Giá thấp lên cao</option>
                                                    </select>
                                                    <button type="submit">Lọc</button>
                                                </form>
                                            </div>
                                        </div>-->
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_product)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_product as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate));// ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Add cart</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Add cart</a>
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
                    } else {
                        ?>
                       <p>No data</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--            <div class="section" id="paging-wp">
                            <div class="section-detail">
                                <ul class="list-item clearfix">
                                    <li>
                                        <a href="" title="">1</a>
                                    </li>
                                    <li>
                                        <a href="" title="">2</a>
                                    </li>
                                    <li>
                                        <a href="" title="">3</a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
        </div>

    </div>
</div>
<?php
get_footer();
?>