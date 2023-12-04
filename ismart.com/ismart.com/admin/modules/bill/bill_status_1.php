<?php
get_header();
?>
<?php
// phân trang
$number_rows = db_num_rows("SELECT bill.fullname,bill.note,bill.created_at,bill.email,bill.address ,bill.phone,bill_detail.bill_id,bill_detail.status,bill_detail.product_id FROM bill_detail,bill, product WHERE bill.bill_id = bill_detail.bill_id AND product.id = bill_detail.product_id and bill_detail.status = 1 GROUP by bill.bill_id");
$num_per_page = 8;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list_bill = get_bill_status($start, $num_per_page);
//show_array($list_bill);
foreach ($list_bill as &$bill) {// &:tham tri
    $bill['url_update'] = "?mod=bill&act=update&id={$bill['bill_id']}";
    $bill['url_delete'] = "?mod=bill&act=delete&id={$bill['bill_id']}";
    $bill['url_delete_cancel'] = "?mod=bill&act=cancel&id={$bill['bill_id']}";
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
                    <h3 id="index" class="fl-left">Thống kê đơn hàng đã được xử lý</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success'])
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                    ?>
                </div>
            <?php endif; ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php
                    if (!empty($list_bill)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã đơn hàng</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Email</span></td>
    <!--                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>-->
                                        <td><span class="thead-text">Ghi chú</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Ngày mua</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
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
                                            </td>
                                            <td><span class="tbody-text"><?php echo $bill['fullname']; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $bill['email']; ?></span></td>
        <!--                                            <td><span class="tbody-text"><?php echo $bill['address']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $bill['phone']; ?></span></td>-->
                                            <td><span class="tbody-text"><?php echo $bill['note']; ?></span></td>
                                            <td>
                                                <span class="tbody-text">

                                                    <?php
                                                     if ($bill['status'] == 1) {
                                                        ?>
                                                        <a class="">Đã xử lý</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $bill['created_at']; ?></span></td>
                                            <td><a href="<?php echo $bill['url']; ?>" title="" class="tbody-text btn btn-xs btn-detail">Chi tiết</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã đơn hàng</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Email</span></td>
    <!--                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>-->
                                        <td><span class="thead-text">Ghi chú</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Ngày mua</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <p class="num_rows">Có <?php echo $number_rows; ?> đơn hàng trong hệ thống</p>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=bill&act=list_order");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>