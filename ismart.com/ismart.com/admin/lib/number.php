<?php
function currency_format($number, $unit = 'đ'){ // hàm sử dụng giá tiền thêm dấu . và đ
    return number_format($number). ' ' .$unit; // number_format: định dạng tiền tệ
}

?>

