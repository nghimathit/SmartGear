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
         

                
                

function displayResultsAsTable($resultsArray) {
// argument must be an array
    $val = '<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#ffcccc" style="text-align:center;">
  <tr>
  <th>Id</th>
  <th>Product Name</th>
  <th>Unit Price</th>
  <th>Image</th>
  <th>Quantity</th>
  <th>Available Quantity</th>
  <th>Total Amount</th>
   
  </tr>';
    if (is_array($resultsArray)) {
        foreach ($resultsArray as $key => $value) {
            $val .= '<tr>';
            foreach ($value as $f_key => $f_val) {
                $val .= '<td>' . $f_val . '</td>';
            }
            $val .= '</tr>';
        }
        $val .= '</table>';
        return $val;
    }
}
?>
<?php

?>
<?php
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
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
$endpoint = "https://payment.momo.vn/v2/gateway/api/create";
$payUrl = "";
$partnerCode = 'MOMOXS5X20221127';
$accessKey = 'CbSgKhEZZJ2ZsI8k';
$secretKey = 'RdjfNeuJmuRo2RRmm9SsetctD7NdaiQI';
$orderInfo = "Thanh toán qua mã QR MoMo Cho Smart Grear";
$amount = $total;
$orderId = time() . "";
$extraData = "";

$requestId = time() . "";
$requestType = "captureWallet";
if(isset($_POST['payUrl'])){
    // Thực hiện các thao tác liên quan đến 'payUrl' ở đây
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];
    $redirectUrl = "http://localhost/SmartGear/SmartGear/ismart.com/ismart.com/?mod=check_out&act=care_customer" . "&user_id=" . $user_id . "&fullname=" . $fullname. "&email=" . $email. "&address=" . $address . "&phone=" . $phone. "&note=" . $note;
    $ipnUrl = "http://localhost/SmartGear/SmartGear/ismart.com/ismart.com/?mod=check_out&act=care_customer" . "&user_id=" . $user_id . "&fullname=" . $fullname. "&email=" . $email. "&address=" . $address . "&phone=" . $phone. "&note=" . $note;

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
} elseif(isset($_POST['btn_order_now'])){
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];
    // show_array($list_buy);
    // Bước 3: Kết luận
    $sql = "INSERT INTO `bill` (`user_id`,`fullname`,`email`,`phone`,`address`, `note`)"
        . "VALUES('{$user_id}','{$fullname}', '{$email}','{$phone}','{$address}', '{$note}')";

    if ($conn->query($sql)) {
        $bill_id = $conn->insert_id;
        //Lưu chi tiết hóa đơn
        $list_buy = get_list_by_cart();
        if (is_array($list_buy)) {
        foreach ($list_buy as $cart) {
            $product_id = $cart['id'];
            $product_name = $cart['product_name'];
            $product_thumb = $cart['product_thumb'];
            $qty = $cart['qty'];
            $price_new = $cart['price_new'];
            $sub_total = $cart['sub_total'];
            $method = "Cash on Delivery";
            $sql = "INSERT INTO `bill_detail` (`bill_id`,`product_id`,`product_name`,`product_thumb`,`qty`,`price_new`,`sub_total` ,`method`)"
                . "VALUES('{$bill_id}','{$product_id}', '{$product_name}', '{$product_thumb}','{$qty}','{$price_new}','{$sub_total}','{$method}')";
            $conn->query($sql);
        }
    }
        unset($_SESSION["cart"]);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }
    ?>



<p>Congratulations on your successful payment.</p>
    <p>Invoice code#
        <?= $bill_id ?>
    </p>
    <?php
    $content = '
    <h1 style="color:red;">Notification of order completion</h1>
    <p> Hello <b>' . $fullname . '</b></p>'
. '<p>Order <b> #APTECH100' . $bill_id . '</b> yours is complete.</p>'
. 'Thank you for purchasing at Smart Grea.<br> Your order information: <b> ' . displayResultsAsTable($list_buy) . '</b>
    <p>We look forward to serving you in your next purchases.</p>
    ';
echo send_mail("$email", "$fullname", 'Order notification', "$content");
    redirect_to("?mod=check_out&act=care_customer");

                    
}                

                    
                
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Home</a>
                    </li>
                    <li>
                        <a href="" title="">Check out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" >
    <form method="POST" >
        <div id="wrapper" class="wp-inner clearfix">
            <?php
            if (!empty($list_buy)) {
                ?>
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Customer information</h1>
                    </div>
                    <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="user_id">Customer's code</label>
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
                                <label for="fullname">Full name</label>
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
                                <label for="phone">Phone number</label>
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
                                <label for="address">Address</label>
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
                                <label for="notes">Note</label>
                                <textarea name="note" style="height: 150px;width: 555px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Information line</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>

                                <td>Product</td>
                                    <td>Total</td>
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
                                <td>Total orders:</td>
                                    <td><strong class="total-price"><?php echo currency_format(get_total_cart()); ?></strong></td>
                                    <input type="hidden" name="total" value="<?php echo get_total_cart() ?>">
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
                            <input type="submit" id="btn_order_now" name="btn_order_now" value="Cash on delivery">
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