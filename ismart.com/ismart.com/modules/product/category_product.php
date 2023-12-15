<?php
get_header();
?>
<?php
    $cat_id = (int) $_GET['id'];
    $list_product = get_list_cat_product_by_cat_id($cat_id);
?>

<?php
$id = (int) $_GET['id'];
$sql = "SELECT * FROM `category` WHERE `cat_id` = '{$id}' and status = 1";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$number_rows = mysqli_num_rows($result);
if ($number_rows > 0) {
    $row = $result->fetch_assoc();
    $list_cat[] = $row;
}
//show_array($list_product);
?>


<?php
// phân trang
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $number_rows = db_num_rows("SELECT * FROM product,category WHERE product.cat_id = category.cat_id and product.cat_id= $id and category.status=1 and product.status = 1 ORDER BY price_new DESC");
//    echo $number_rows;
    $num_per_page = 12;
    $total_row = $number_rows;
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
//    echo $page;
    $start = ($page - 1) * $num_per_page;
//    echo $start;
    $list_product = get_product_categoryes($start, $num_per_page, $id);
}



$default_sorting = get_default_sorting($id);
//show_array($default_sorting);
?>



<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
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
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <?php
                    foreach ($list_cat as $cat) {
                        ?>
                        <h3 class="section-title fl-left"><?php echo $cat['cat_name']; ?></h3>
                        <?php
                    }
                    ?>
                    <div class="filter-wp fl-right">
                        <p class="desc">Display<?php echo count($list_product); ?> product(<?php echo $number_rows; ?> product)</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="sorting" id="select" class="selection-2 city">
                                    <!--                                    <option value="0">Sắp xếp</option>
                                                                        <option value="1">Từ A-Z</option>
                                                                        <option value="2">Từ Z-A</option>
                                                                        <option value="3">Giá cao xuống thấp</option>
                                                                        <option value="3">Giá thấp lên cao</option>-->
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".city").change(function () {
                                                var id = $(".city").val();
                                                if (id == 1) {
                                                    location.replace('?mod=sort&act=A-Z&id=<?php echo $id; ?>');
                                                } else if (id == 2)
                                                {
                                                    location.replace('?mod=sort&act=Z-A&id=<?php echo $id; ?>');
                                                } else if (id == 3)
                                                {
                                                    location.replace('?mod=sort&act=high_low&id=<?php echo $id; ?>');
                                                } else if (id == 4)
                                                {
                                                    location.replace('?mod=sort&act=low_high&id=<?php echo $id; ?>');
                                                }
                                            });
                                        });
                                    </script>  
                                    <option>Arrange</option>
                                    <?php
                                    foreach ($default_sorting as $list) {
                                        ?>
                                    <option value="<?php echo $list['id'] ?>"><?php echo $list['sort_name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </form>
                        </div>
                    </div>
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
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
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
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Add to cart</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Add to cart</a>
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
                        <p>No products</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <?php
                if (!empty($list_product)) {
                    ?>
                    <div class="section-detail clearfix">
                        <?php
                        $id = $item['cat_id'];
                        echo get_pagging_category_product($num_page, $page, "?mod=product&act=category_product", $id);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>