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
                    <h3 class="section-title">Order information</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Order code</h3>
                        <span class="detail"><?php echo $row['bill_id']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Customer name</h3>
                        <span class="detail"><?php echo $row['fullname']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Delivery address</h3>
                        <span class="detail"><?php echo $row['address']; ?> </span>
                    </li>
                    <li>
                        <h3 class="title">Phone Number</h3>
                        <span class="detail"><?php echo $row['phone']; ?> </span>
                    </li>
                    <?php
                                $temp = 0;
                                foreach ($list_detail_bill as $item) {
                                    $temp++;
                                    ?>
                    <li>
                        <h3 class="title">Payment method</h3>
                        <span class="detail"><?php echo $item['method']; ?></span>
                    </li>
                   
                    
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                <h3 class="section-title">Order products</h3>
                </div>
                
                    <div class="table-responsive">
                        <table class="table info-exhibition">
                            <thehead>
                                <tr>
                                    <td class="thead-text">STT</td>
                                    <td class="thead-text">Product photo</td>
                                    <td class="thead-text">Product name</td>
                                    <td class="thead-text">Unit price</td>
                                    <td class="thead-text">Quantity</td>
                                    <td class="thead-text">Amount of money</td>
                                </tr>
                            </thead>
                            <tbody>
                               
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
                  
            </div>
            <div class="section">
            <h3 class="section-title">Order value</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Total amount</span>
                            <span class="total">Total order</span>
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
                <a href="?mod=bill&act=list_order"><i class="fa fa-backward" aria-hidden="true"></i>Return</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>