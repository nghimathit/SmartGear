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
//if(empty($_POST['keyword'])){
//    $keyword = '!';
//}

$sql = "select *,product.created_at from product, category where product.cat_id = category.cat_id and category.status = 1 and product.status = 1 and product_name like N'%{$keyword}%' ORDER by product.created_at DESC";
$result = mysqli_query($conn, $sql);
$list_search = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0 && $keyword != "") {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_search[] = $row;
    }
}
?>
<?php
// phân trang
$number_rows = db_num_rows("select *,product.created_at from product, category where product.cat_id = category.cat_id and category.status = 1 and product.status = 1 and product_name like N'%{$keyword}%'");
$num_per_page = 12;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_search = get_search_product($start, $num_per_page, $keyword);
?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <?php get_sidebar_product(); ?>

        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Sản phẩm tìm được</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo count($list_search); ?> sản phẩm (<?php echo $number_rows; ?> sản phẩm)</p>
                        <div class="form-filter">
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_search)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_search as $item) {
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
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
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
                    } else {
                        ?>
                        <p>Không có sản phẩm nào được tìm thấy</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=search&act=search_product&keyword=$keyword");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>