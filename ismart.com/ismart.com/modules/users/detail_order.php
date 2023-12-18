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
body {
    font-family: 'Arial', sans-serif;
    color: #333;
}

#main-content-wp {
    background-color: #f4f4f4;
    padding: 20px;
}

.add-cat-page {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

#breadcrumb-wp {
    background-color: #ddd;
    padding: 10px;
    border-radius: 5px;
}

#breadcrumb-wp a {
    color: #3498db;
    text-decoration: none;
}

#breadcrumb-wp a:hover {
    text-decoration: underline;
}

.list-item {
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-item li {
    display: inline-block;
    margin-right: 10px;
    font-size: 14px;
}

#info {
    width: 100%;
    float: left;
    margin-bottom: 20px;
}

.title {
    color: #3498db;
    font-size: 20px;
    margin-bottom: 10px;
    font-weight: bold;
}

.detail {
    color: #333;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table thead td,
.table tbody td {
    padding: 15px;
    text-align: left;
    border: 1px solid #ddd;
}

.amount {
    color: #ff0000;
}

.table thead td {
    background-color: #f2f2f2;
    font-weight: bold;
}

.section {
    width: 100%;
    float: left;
    margin-bottom: 20px;
}

.section-title {
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    border-radius: 5px 5px 0 0;
    font-weight: bold;
}

.total {
    display: block;
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
    font-weight: bold;
}

.section-detail {
    padding: 20px;
    box-sizing: border-box;
}

.total-fee,
.total {
    display: block;
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
}

/* #wrapper>div {
    width: 70px !important;
} */

/* Style for the total amount and total order values */
.total-fee {
    color: #e44d26;
    /* Adjust color based on your design */
}

.total {
    color: #337ab7;
    /* Adjust color based on your design */
}

/* Clear the float after each list item */
.list-item:after {
    content: "";
    display: table;
    clear: both;
}
.detail_thumb{
    width: 70px !important;
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