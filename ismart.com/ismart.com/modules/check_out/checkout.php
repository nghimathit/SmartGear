<?php
get_header();

?>
<?php
$list_buy = get_list_by_cart();
//show_array($list_order);
$list_users = get_list_users_cat($_SESSION['user_login']);
//show_array($list_users);
?>
<?php
//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    show_array($_POST);
//}
?>


<?php
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

$total = 0;
if(isset($_POST['total'])){
    $total = $_POST['total'];
}
$user_id = "";
$fullname = "";
$email = "";
$address = "";
$phone = "";
$note = "";
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$payUrl = "";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";
$amount = $total;
$orderId = time() . "";
$extraData = "";

$requestId = time() . "";
$requestType = "payWithATM";
if(isset($_POST['payUrl'])){
    // Thực hiện các thao tác liên quan đến 'payUrl' ở đây
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];
    $redirectUrl = "http://localhost/SmartGear/ismart.com/ismart.com/?mod=check_out&act=care_customer" . "&user_id=" . $user_id . "&fullname=" . $fullname. "&email=" . $email. "&address=" . $address . "&phone=" . $phone. "&note=" . $note;
    $ipnUrl = "http://localhost/SmartGear/ismart.com/ismart.com/?mod=check_out&act=care_customer" . "&user_id=" . $user_id . "&fullname=" . $fullname. "&email=" . $email. "&address=" . $address . "&phone=" . $phone. "&note=" . $note;

    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl="  . $redirectUrl  . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature,
        'user_id' => $user_id,
        'fullname' => $fullname,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'note' => $note,
    );
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true); // decode json
    echo 'API Response: ' . $result;

    header('Location: ' . $jsonResult['payUrl']);
} else {
  

                    
}                

                    
                
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" >
        <div id="wrapper" class="wp-inner clearfix">
            <?php
            if (!empty($list_buy)) {
                ?>
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>
                    <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="user_id">Mã khách hàng</label>
                                <input type="text" value="<?php echo $list_users['user_id']; ?>" name="user_id" id="username" readonly="true">
                                <?php
                                if (!empty($error['user_id'])) {
                                    ?>
                                    <p class="error"><?php echo $error['user_id']; ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-col fl-right">
                                <label for="fullname">Họ tên</label>
                                <input type="text" value="<?php echo $list_users['fullname']; ?>" name="fullname" id="fullname">
                                <?php
                                if (!empty($error['fullname'])) {
                                    ?>
                                    <p class="error"><?php echo $error['fullname']; ?></p>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $list_users['email']; ?>" name="email" id="email">
                                <?php
                                if (!empty($error['email'])) {
                                    ?>
                                    <p class="error"><?php echo $error['email']; ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" value="<?php echo $list_users['phone']; ?>" name="phone" id="phone">
                                <?php
                                if (!empty($error['phone'])) {
                                    ?>
                                    <p class="error"><?php echo $error['phone']; ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <input type="text" value="<?php echo $list_users['address']; ?>" name="address" id="address">
                                <?php
                                if (!empty($error['address'])) {
                                    ?>
                                    <p class="error"><?php echo $error['address']; ?></p>
                                    <?php
                                }
                                ?>
                            </div>
<!--                            <div class="form-col fl-right">
                                <label for="gender">Giới tính</label>
                                <select name="gender" id="gender">
                                    <option <?php if (isset($list_users['gender']) && $list_users['gender'] == 'male') echo "selected='selected'"; ?> value="male">Nam</option>
                                    <option <?php if (isset($list_users['gender']) && $list_users['gender'] == 'female') echo "selected='selected'"; ?> value="female">Nữ</option>
                                </select>
                            </div>-->
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note" style="height: 150px;width: 555px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>

                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_buy as $item) {
                                    ?>
                                    <tr class="cart-item">

                                        <td class="product-name"><?php echo $item['product_name']; ?><strong class="product-quantity">x <?php echo $item['qty']; ?></strong></td>
                                        <td class="product-total"><?php echo currency_format($item['sub_total']); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price"><?php echo currency_format(get_total_cart()); ?></strong></td>
                                    <input type="hidden" name="total" value="<?php echo get_total_cart() ?>">
                                </tr>
                            </tfoot>
                        </table>
                        <!--                        <div id="payment-checkout-wp">
                                                    <ul id="payment_methods">
                                                        <li>
                                                            <input type="radio" id="direct-payment" checked="checked" name="payment" value="online">
                                                            <label for="direct-payment">Thanh toán online</label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" id="payment-home" name="payment" value="cod">
                                                            <label for="payment-home">Thanh toán tại nhà</label>
                                                        </li>
                                                    </ul>
                                                </div>-->
                        <div class="place-order-wp clearfix">
                            <input type="submit" id="btn_order_now" name="btn_order_now" value="Đặt hàng">
                            <input type="submit" name="payUrl" value="Momo" >
                        </div>
                    </div>
                </div>
                
                <?php
            }
            ?>
        </div>
    </form>
</div>
<?php
get_footer();
?>