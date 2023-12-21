<?php
get_header();
?>
<?php
// $list_buy = get_list_by_cart();
// show_array($list_buy);

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
$user_id = "";
$fullname = "";
$email = "";
$address = "";
$phone = "";
$note = "";

if (isset($_GET['partnerCode'])) {

    $user_id = $_GET['user_id'];
    $fullname = $_GET['fullname'];
    $email = $_GET['email'];
    $address = $_GET['address'];
    $phone = $_GET['phone'];
    $note = $_GET['note'];
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
            $method = "Momo";
            $sql = "INSERT INTO `bill_detail` (`bill_id`,`product_id`,`product_name`,`product_thumb`,`qty`,`price_new`,`sub_total`,`method`)"
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
    <p>Invoice code #
        <?= $bill_id ?>
    </p>
    <?php
    $content = '
                        <h1 style="color:red;">Thông báo đơn hàng hoàn tất</h1>
                        <p>Chào <b>' . $fullname . '</b></p>'
        . '<p>Đơn hàng <b> #APTECH100' . $bill_id . '</b> của bạn đã hoàn tất.</p>'
        . 'Cảm ơn bạn đã mua hàng tại Smart Grea.<br> Thông tin đơn hàng của bạn: <b> ' . displayResultsAsTable($list_buy) . '</b>
                        <p>Rất mong được phục vụ bạn trong những lần mua tiếp theo.</p>
                        ';
    echo send_mail("$email", "$fullname", 'Thông báo đơn hàng', "$content");
    redirect_to("?mod=check_out&act=care_customer");
}




?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Home</a>
                    </li>
                    <li>
                        <a href="" title="">Customer care</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
    <p class="cart">Your order has been successfully placed</p>
        <p class="cart">We will contact you within 24 hours to check your order</p>
        <p class="cart">Thank you</p>
        <p class="cart">Wish you a nice day</p>
    </div>
</div>

<?php
get_footer();
?>