<?php
get_header();
?>
<?php
$list_buy = get_list_by_cart();
//show_array($list_buy);
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chăm sóc khách hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <p class="cart">Quý khách đã đặt hàng thành công</p>
        <p class="cart">Chúng tôi sẽ liên lạc lại với quý khách trong 24h để kiểm tra đơn hàng</p>
        <p class="cart">Cảm ơn quý khách</p>
        <p class="cart">Chúc quý khách một ngày vui vẻ</p>
    </div>
</div>

<?php
get_footer();
?>
