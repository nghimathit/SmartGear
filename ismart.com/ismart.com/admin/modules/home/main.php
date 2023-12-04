<?php
get_header();
?>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Xin chào người quản trị Admin</h3>
                </div>
            </div>
            <div class="container-fluid">

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-primary o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">Tổng bài viết</p>
                                    <h1 style="text-align: center; font-size: 50px;">
                                        <?php
                                        $sql = "select count(*) as tongbaiviet from post where 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['tongbaiviet'];
                                            }
                                        }
                                        ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="?mod=post&act=main">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-warning o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-laptop" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">Tổng sản phẩm</p>
                                    <h1 style="text-align: center; font-size: 50px;">
                                        <?php
                                        $sql = "select count(*) as tongsanpham from product where 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['tongsanpham'];
                                            }
                                        }
                                        ?>
                                    </h1>
                                </div>

                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="?mod=product&act=main">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">Tổng hóa đơn</p>
                                    <h1 style="text-align: center; font-size: 50px;">
                                        <?php
                                        $sql = "select count(*) as tongdonhang from bill where 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['tongdonhang'];
                                            }
                                        }
                                        ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="?mod=bill&act=list_order">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">Tổng tiền hóa đơn</p>
                                    <h1 style="text-align: center">
                                        <?php
                                        $sql = "SELECT SUM(sub_total) as tongdonhang FROM `bill_detail` WHERE 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo currency_format($row['tongdonhang']);
                                            }
                                        }
                                        ?>
                                    </h1>
                                </div>
                            </div>
<!--                            <a class="card-footer text-white clearfix small z-1" href="?mod=users&act=main">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>-->
                        </div>
                    </div>
<!--                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <?php
                                    $date = getdate();
                                    $day = $date['mday'];
                                    $sql = "SELECT SUM(qty*price_new)as tongtien FROM bill_detail WHERE DAY (created_at)=$day";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0)
                                        while ($rows = $result->fetch_assoc()) {
                                            if ($rows['tongtien'] == NULL) {
                                                echo '0';
                                            } else {
                                                echo $rows['tongtien'];
                                            }
                                        }
                                    ?>
                                    <div> Hóa Đơn Theo Ngày</div>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="?mod=bill&act=bill_days">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">Tổng tiền hóa đơn</p>
                                    <h1 style="text-align: center">
                                        <?php
                                        $sql = "SELECT SUM(sub_total) as tongdonhang FROM `bill_detail` WHERE 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo currency_format($row['tongdonhang']);
                                            }
                                        }
                                        ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="?mod=users&act=main">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">Tổng tiền hóa đơn</p>
                                    <h1 style="text-align: center">
                                        <?php
                                        $sql = "SELECT SUM(sub_total) as tongdonhang FROM `bill_detail` WHERE 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo currency_format($row['tongdonhang']);
                                            }
                                        }
                                        ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="?mod=users&act=main">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>-->
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
</div>
<?php
get_footer();
?>