<?php
get_header();
?>

<?php
$list_buy = get_list_by_cart();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Home</a>
                    </li>
                    <li>
                        <a href="" title="">Cart</a>
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
                                    <td>Product Code</td>
                                    <td>Product Image</td>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    <td>Quantity</td>
                                    <td colspan="2">Total Amount</td>
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
                                            <input type="number" min="1" max="<?php echo $item['qty_product'] ?>" id="num_order" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty']; ?>" class="num-order" data-id="<?php echo $item['id'] ?>" onchange="validateQuantity(this)">
                                        </td>
                                        <script>
                                            function validateQuantity(input) {
                                                var quantity = parseInt(input.value, 10);
                                                var maxQuantity = parseInt(input.getAttribute('max'), 10);

                                                if (isNaN(quantity) || quantity < 1 || quantity > maxQuantity) {
                                                    alert("Please enter a valid quantity between 1 and " + maxQuantity + ".");
                                                    input.value = input.defaultValue;
                                                }
                                            }
                                        </script>
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
                                            <p id="total-price" class="fl-right">Total: <span id="total-price-products"><?php echo currency_format($_SESSION['cart']['info']['total']); ?></span></p>
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
                                                    <a href="?mod=check_out&act=checkout" title=""
                                                     id="checkout-cart">
                                                     Check out</a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="?mod=users&act=login" title="" id="checkout-cart">Login to check out</a>
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
                    <a href="?" title="" id="buy-more">Buy more</a><br />
                    <a href="?mod=cart&act=delete_all" title="" onclick="return confirmAction_delete_all_cart()" id="delete-cart">Delete cart</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="section" id="cart_empty">
                <p>There are no products in the shopping cart, click <a href="?">here</a> to return to the homepage!</p>

            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
get_footer();
?>