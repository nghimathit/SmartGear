<?php
get_header();
?>
<?php
if ($_GET['id']) {
    $id = (int) $_GET['id'];
    $list_detail_bill = get_list_bill_detail_id($id);
}
//show_array($list_detail_bill);
?>
<?php
if ($_GET['id']) {
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM `bill` where `bill_id` = $id";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>




<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $row['bill_id']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Tên khách hàng</h3>
                        <span class="detail"><?php echo $row['fullname']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo $row['address']; ?> </span>
                    </li>
                    <li>
                        <h3 class="title">Số điện thoại</h3>
                        <span class="detail"><?php echo $row['phone']; ?></span>
                    </li>

                    <!--                    <form method="POST" action="">
                                            <li>
                                                <h3 class="title">Tình trạng đơn hàng</h3>
                                                <select name="status">
                                                    <option <?php if (isset($row['status']) && $row['status'] == 0) echo "selected='selected'"; ?>  value='1'>Chưa xử lý</option>
                                                    <option <?php if (isset($row['status']) && $row['status'] == 1) echo "selected='selected'"; ?> value='2'>Đã xử lý</option>        
                                                    <option <?php if (isset($row['status']) && $row['status'] == 2) echo "selected='selected'"; ?> value='3'>Đã xóa</option>  
                                                </select>
                                                <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                                                <input placeholder="Đơn hàng" readonly="readonly" name="sm_status" style="width: 100%;text-align: center;margin-top: 15px;">
                                            </li>
                                        </form>-->
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <?php
                if (!empty($list_detail_bill)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table info-exhibition">
                            <thead>
                                <tr>
                                    <td class="thead-text">STT</td>
                                    <td class="thead-text">Ảnh sản phẩm</td>
                                    <td class="thead-text">Tên sản phẩm</td>
                                    <td class="thead-text">Đơn giá</td>
                                    <td class="thead-text">Số lượng</td>
                                    <td class="thead-text">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($list_detail_bill as $item) {
                                    $temp++;
                                    ?>
                                    <tr>
                                        <td class="thead-text"><?php echo $temp; ?></td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img src="uploads/<?php echo $item['product_thumb']; ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="thead-text"><?php echo $item['product_name']; ?></td>
                                        <td class="thead-text"><?php echo currency_format($item['price_new']); ?></td>
                                        <td class="thead-text"><?php echo $item['qty']; ?></td>
                                        <td class="thead-text"><?php echo currency_format($item['sub_total']); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee">
                                <?php
                                $sql = "SELECT SUM(qty) as tongsoluong FROM `bill_detail` WHERE bill_id = $id";
                                $result = mysqli_query($conn, $sql);
                                $num_rows = mysqli_num_rows($result);
                                if ($num_rows > 0) {
                                    while ($num = mysqli_fetch_assoc($result)) {
                                        echo $num['tongsoluong'];
                                    }
                                }
                                ?>
                            </span>
                            <span class="total">
                                <?php
                                $sql = "SELECT SUM(sub_total) as tongdonhang FROM `bill_detail` WHERE bill_id = $id";
                                $result = mysqli_query($conn, $sql);
                                $num_rows = mysqli_num_rows($result);
                                if ($num_rows > 0) {
                                    while ($num = mysqli_fetch_assoc($result)) {
                                        echo currency_format($num['tongdonhang']);
                                    }
                                }
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="?mod=bill&act=list_order"><i class="fa fa-backward" aria-hidden="true"></i> Quay lại</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>