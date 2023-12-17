<?php
get_header();
?>
<?php
require_once __DIR__ . '/../../lib/users.php';
if ($_GET['id']) {
    $id = (int) $_GET['id'];
    $list_detail_bill = get_bill_detail_id($id);
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
<style>
    /* Style for the section title */
.section-title {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
    padding: 20px;
}

/* Style for the list items */
.list-item {
    list-style: none;
    padding: 0;
}

/* Style for each list item */
.list-item li {
    float: left;
    margin-right: 20px;
}

/* Style for the total-fee and total spans */
.total-fee,
.total {
    display: block;
    font-size: 18px;
    color: #555;
}
.detail_thumb{
    width: 70px !important;
}
/* Style for the total amount and total order values */
.total-fee {
    color: #e44d26; /* Adjust color based on your design */
}

.total {
    color: #337ab7; /* Adjust color based on your design */
}

/* Clear the float after each list item */
.list-item:after {
    content: "";
    display: table;
    clear: both;
}
.list-item clearfix{
    padding: 20px;
}
</style>
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Home</a>
                        </li>
                        <li>
                            <a href="" title="">Order information</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info">
                <ul class="list-item">
                    <li>
                        <h1 class="title">Order code: <span class="detail"><?php echo $row['bill_id']; ?></span></h1>
                    </li>
                    <li>
                        <h3 class="title">Customer name:  <span class="detail"><?php echo $row['fullname']; ?></span></h3>
                       
                    </li>
                    <li>
                        <h3 class="title">Delivery address:  <span class="detail"><?php echo $row['address']; ?> </span></h3>
                       
                    </li>
                    <li>
                        <h3 class="title">Phone number:   <span class="detail"><?php echo $row['phone']; ?></span></h3>
                      
                    </li>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                <h3 class="section-title">Order products</h3>
                </div>
                <?php
                if (!empty($list_detail_bill)) {
                    ?>
                    <div class="table-responsive">
                    <table class="table">
                                    <thead>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Product photo</span></td>
                                        <td><span class="thead-text">Product name</span></td>
                                        <td><span class="thead-text">Unit price</span></td>
                                        <td><span class="thead-text">Quantity</span></td>
                                        <td><span class="thead-text">Amount of money</span></td>                              
                             
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
                                                <img class="detail_thumb" src="admin/uploads/<?php echo $item['product_thumb']; ?>">
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
        </div>
    </div>

    <?php
get_footer();
?>