<?php

$id = $_POST['id'];
$price = $_SESSION['cart']['buy'][$id]['price_new'];
$qty = $_POST['qty'];
$sub_total = $price * $qty;

$_SESSION['cart']['buy'][$id]['qty'] = $qty;
$_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;
update_info_cart();

$result = array(
    'price' => currency_format($price),
    'sub_total' => currency_format($sub_total),
    'num_order' => $_SESSION['cart']['info']['num_order'],
    'total' => currency_format($_SESSION['cart']['info']['total']),
);

echo json_encode($result);


?>

