<?php
get_header();
?>
<?php
$keyword = '';
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
} else if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
$sql = "SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status !=2 and bill.fullname like N'%$keyword%' GROUP by bill.bill_id";
$result = mysqli_query($conn, $sql);
$list_bill = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0 && $keyword != "") {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_bill[] = $row;
    }
}
?>
<?php
$number_rows = db_num_rows("SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status !=2 and bill.fullname like N'%$keyword%' GROUP by bill.bill_id");
$num_per_page = 8;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_bill = get_search_bill($start, $num_per_page, $keyword);
//show_array($list_bill);
foreach ($list_bill as &$bill) {// &:tham tri
    $bill['url_update'] = "?mod=bill&act=update&id={$bill['bill_id']}";
    $bill['url_delete'] = "?mod=bill&act=delete&id={$bill['bill_id']}";
}
unset($bill);
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Order list</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form method="post" class="form-s fl-right" action="?mod=search&act=search_bill">
                            <input type="text" name="keyword" id="s">
                            <input type="submit" name="btn_search" value="search">
                        </form>
                    </div>
                    <?php
                    if (!empty($list_bill)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                    <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Order code</span></td>
                                        <td><span class="thead-text">Full name</span></td>
                                        <td><span class="thead-text">Email</span></td>
    <!-- <td><span class="thead-text">Address</span></td>
                                        <td><span class="thead-text">Phone number</span></td>-->
                                        <td><span class="thead-text">Notes</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                        <td><span class="thead-text">Purchase date</span></td>
                                        <td><span class="thead-text">Details</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = $start;
                                    foreach ($list_bill as $bill) {
                                        $bill['url'] = "?mod=bill&act=detail_order&id={$bill['bill_id']}";
                                        $temp++;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>

                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $bill['bill_id']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $bill['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    if ($bill['status'] == 1) {
                                                        ?>
                                                        <li><a href="<?php echo $bill['url_delete']; ?>" title="Xóa" onclick="return confirmAction_bill()" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a href="<?php echo $bill['url_delete_cancel']; ?>" title="Hủy" onclick="return confirmAction_bill_cancel()" class="delete"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $bill['fullname']; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $bill['email']; ?></span></td>
        <!--                                            <td><span class="tbody-text"><?php echo $bill['address']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $bill['phone']; ?></span></td>-->
                                            <td><span class="tbody-text"><?php echo $bill['note']; ?></span></td>
                                            <td>
                                                <span class="tbody-text">

                                                    <?php
                                                    if ($bill['status'] == 0) {
                                                        ?>
                                                        <a href="?mod=bill&act=error_action&id=<?php echo $bill['bill_id'] ?>" class="btn btn-xs btn-danger">Unprocessed</a>
                                                        <?php
                                                    } else if ($bill['status'] == 1) {
                                                        ?>
                                                        <a href="?mod=bill&act=error_action&id=<?php echo $bill['bill_id'] ?>" class="btn btn-xs btn-info">Processed</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $bill['created_at']; ?></span></td>
                                            <td><a href="<?php echo $bill['url']; ?>" title="" class="tbody-text btn btn-xs btn-detail">Details</a></ td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Order code</span></td>
                                        <td><span class="thead-text">Full name</span></td>
                                        <td><span class="thead-text">Email</span></td>
    <!-- <td><span class="thead-text">Address</span></td>
                                        <td><span class="thead-text">Phone number</span></td>-->
                                        <td><span class="thead-text">Notes</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                        <td><span class="thead-text">Purchase date</span></td>
                                        <td><span class="thead-text">Details</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }else{
                    ?>
                   <p>No data</p>
                    <?php
                    }
                    ?>
                </div>
                <p class="num_rows">Yes <?php echo $number_rows; ?> orders in the system</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=search&act=search_bill&keyword=$keyword");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>