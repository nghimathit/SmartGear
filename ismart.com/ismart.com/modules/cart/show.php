<?php
get_header();
?>

<?php
$list_buy = get_list_by_cart();
// show_array($list_buy);
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php
        if (!empty($list_buy)) {
            ?>
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <form method="post" action="?mod=cart&act=update">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_buy as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td>
                                            <a href="" title="" class="thumb">
                                                <img src="admin/uploads/<?php echo $item['product_thumb']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <span href="" title="" class="name-product"><?php echo $item['product_name']; ?></span>
                                        </td>
                                        <td><span id="price_new"><?php echo currency_format($item['price_new']); ?></span></td>
                                        <td>
                                            <input type="number" min="1" max="<?php echo $item['qty_product']?>" id="num_order" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty']; ?>" class="num-order" data-id="<?php echo $item['id'] ?>">
                                        </td>
                                        <td><span id="sub-total-<?php echo $item['id'] ?>"><?php echo currency_format(($item['sub_total'])); ?></span></td>
                                        <td>
                                            <a href="?mod=cart&act=delete&id=<?php echo $item['id']; ?>" onclick="return confirmAction_delete_cart()" title="Xóa sản phẩm" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span id="total-price-products"><?php echo currency_format($_SESSION['cart']['info']['total']); ?></span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <!-- <input type="submit" id="update-cart" name="btn_update_cart" value="Cập nhật giỏ hàng"> -->
                                                <?php
                                                if (isset($_SESSION['is_login'])) {
                                                    ?>
                                                    <a href="?mod=check_out&act=checkout" title="" id="checkout-cart">Thanh toán</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="?mod=users&act=login" title="" id="checkout-cart">Đăng nhập để thanh toán</a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <!-- <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng.</p> -->
                    <a href="?" title="" id="buy-more">Mua tiếp</a><br/>
                    <a href="?mod=cart&act=delete_all" title="" onclick="return confirmAction_delete_all_cart()" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="section" id="cart_empty">
                <p>Không có sản phẩm nào trong giỏ hàng, click <a href="?">vào đây </a>để quay lại trang chủ !</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php
get_footer();
?>