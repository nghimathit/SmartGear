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

$sql = "SELECT *,product.id,product.status FROM `product`,`category` where product.cat_id = category.cat_id and product.status != 2 and product_name like N'%$keyword%' ORDER by product.created_at DESC";
$result = mysqli_query($conn, $sql);
$list_product = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0 && $keyword != "") {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_product[] = $row;
    }
}
?>
<?php
//show_array($list_product);
// phân trang
$number_rows = db_num_rows("SELECT *,product.id,product.status FROM `product`,`category` where product.cat_id = category.cat_id and product.status != 2 and product_name like N'%$keyword%' ORDER by product.created_at DESC");
$num_per_page = 5;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_product = get_search_product($start, $num_per_page, $keyword);
//show_array(get_search_product(5, 5, $keyword));

foreach ($list_product as &$product) {// &:tham tri
    $product['url_update'] = "?mod=product&act=update&id={$product['id']}";
    $product['url_delete'] = "?mod=product&act=delete&id={$product['id']}";
}
unset($product);
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Product list</h3>
                    <a href="?mod=product&act=add" title="" id="add-new" class="fl-left">Add new</a>
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
                    <form method="POST" class="form-s fl-right" action="?mod=search&act=search_product">
                        <input type="text" name="keyword" id="s">
                        <input type="submit" name="btn_search" value="Tìm kiếm">
                    </form>
                </div>
                <?php
                if (!empty($list_product)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Product code</span></td>
                                    <td><span class="thead-text">Image</span></td>
                                    <td><span class="thead-text">Product name</span></td>
                                    <td><span class="thead-text">New price</span></td>
                                    <td><span class="thead-text">Thumb_1</span></td>
                                    <td><span class="thead-text">Thumb_2</span></td>
                                    <td><span class="thead-text">Thumb_3</span></td>
                                    <td><span class="thead-text">Thumb_4</span></td>
                                    <td><span class="thead-text">Thumb_5</span></td>
                                    <td><span class="thead-text">Thumb_6</span></td>
                                    <td><span class="thead-text">Category</span></td>
                                    <td><span class="thead-text">Status</span></td>
                                    <td><span class="thead-text">Amount in stock</span></td>
                                    <td><span class="thead-text">Top selling products</span></td>
                                    <td><span class="thead-text">Featured products</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = $start;
                                foreach ($list_product as $product) {
//                                    show_array($product);
                                    $temp++;
                                    ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $temp; ?></span>
                                        <td><span class="tbody-text"><?php echo $product['id']; ?></span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['product_thumb']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $product['product_name']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="<?php echo $product['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <?php
                                                if ($product['status'] == 1) {
                                                    ?>
                                                <li><a href="<?php echo $product['url_delete']; ?>" title="Xóa" onclick="return confirmAction_product()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                <?php
                                                }else{
                                                ?>
                                                <li><a href="" title="Xóa" onclick="return confirmAction_delete_status_product()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $product['price_new']; ?></span></td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['list_thumb_1']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['list_thumb_2']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['list_thumb_3']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['list_thumb_4']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['list_thumb_5']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="uploads/<?php echo $product['list_thumb_6']; ?>" alt="">
                                            </div>
                                        </td>

                                        <td><span class="tbody-text"><?php echo $product['cat_name']; ?></span></td>
                                        <td>
                                            <span class="tbody-text">
                                                <?php
                                                if ($product['status'] == 1) {
                                                    ?>
                                                  <a class="btn btn-xs btn-info">For sale</a>
                                                    <?php
                                                } else if ($product['status'] == 0) {
                                                    ?>
                                                    <a class="btn btn-xs btn-default">Stop selling</a>
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $product['qty_product']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $product['selling_products']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $product['featured_products']; ?></span></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Product code</span></td>
                                    <td><span class="thead-text">Image</span></td>
                                    <td><span class="thead-text">Product name</span></td>
                                    <td><span class="thead-text">New price</span></td>
                                    <td><span class="thead-text">Thumb_1</span></td>
                                    <td><span class="thead-text">Thumb_2</span></td>
                                    <td><span class="thead-text">Thumb_3</span></td>
                                    <td><span class="thead-text">Thumb_4</span></td>
                                    <td><span class="thead-text">Thumb_5</span></td>
                                    <td><span class="thead-text">Thumb_6</span></td>
                                    <td><span class="thead-text">Category</span></td>
                                    <td><span class="thead-text">Status</span></td>
                                    <td><span class="thead-text">Amount in stock</span></td>
                                    <td><span class="thead-text">Top selling products</span></td>
                                    <td><span class="thead-text">Featured products</span></td>
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