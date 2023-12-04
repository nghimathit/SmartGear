<?php

function add_cart($id, $item, $sl) {
    if (!empty($sl)) {
        $qty = $sl;
    } else {
        $qty = 1;
    }
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        //$qty = số lg bên trong giỏ hàng + 1
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
    }
    return $_SESSION['cart']['buy'][$id] = array(// lưu thông tin mua sản phẩm:buy
        'id' => $item['id'],
        'product_name' => $item['product_name'],
        'price_new' => $item['price_new'],
        'product_thumb' => $item['product_thumb'],
        'qty' => $qty,
        'qty_product'=> $item['qty_product'],
        'sub_total' => $item['price_new'] * $qty // tổng
    );
    // Cập nhật hóa đơn
    update_info_cart();
}

function update_info_cart() {
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }
        return $_SESSION['cart']['info'] = array(// lưu thông tin hóa đơn: info
            'num_order' => $num_order, // tổng số lg
            'total' => $total
        );
    }
}

function get_list_by_cart() {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) { // & là tham trị ; $ là tham chiếu
//            $item['url_delete_cart'] = "?mod=cart&act=delete&id={$item['id']}";
        }
        return $_SESSION['cart']['buy']; // chỉ xuất ra sản phẩm muốn mua
    }
    return FALSE;
}

function get_num_order_cart() { // lấy số lg
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return FALSE;
    // có thế ghi 1 dòng duy nhất => return $_SESSION['cart']['info']['num_order'];
}

function get_total_cart() { // lấy tổng tiền
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return FALSE;
}
function delete_all_cart(){
    unset($_SESSION['cart']); // xóa tất cả ( dùng để delete-all)
}
function delete_cart($id) {
    # xóa sản phẩm có $id trong giỏ hàng
    if (isset($_SESSION['cart'])) {
        if (!empty($id)) { // $id không rỗng
            unset($_SESSION['cart']['buy'][$id]); // chỉ xóa có $id
            update_info_cart(); // cập nhật lại nguyên cái giỏ cmn hàng
        }
    }
}

function update_cart($qty) {
    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $new_qty * $_SESSION['cart']['buy'][$id]['price_new'];
    }
    update_info_cart();
}
?>

