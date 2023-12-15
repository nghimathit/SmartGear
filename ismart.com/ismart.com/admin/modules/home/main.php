<?php
get_header();
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Hello <?php echo info_user('fullname') ?></h3>
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
                                    <p style="text-align: center;">Post Total</p>
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
                                <canvas id="myChart" style="background-color: transparnet;"></canvas>
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
                                    <p style="text-align: center;">Product Total</p>
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
                                <canvas id="prochart" style="background-color: transparnet;"></canvas>
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
                                    <p style="text-align: center;">Order bill</p>
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
                                <canvas id="billchart" style="background-color: transparnet;"></canvas>
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
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="mr-5">
                                    <p style="text-align: center;">User</p>
                                    <h1 style="text-align: center; font-size: 50px;">
                                        <?php
                                        $sql = "select count(*) as user from users where 1";
                                        $result = mysqli_query($conn, $sql);
                                        $num_rows = mysqli_num_rows($result);
                                        if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['user'];
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
                </div>

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header text-center" >
                        Total Price 
                    </div>
                        <div class="card-body">
                            <div style="width:100% ; height: 600px">
                            <canvas id="totalchart" ></canvas>
                            </div>
                       
                        </div>
                </div>            
            </div>


        </div>
    </div>
</div>
<script>//post
    <?php
    $sql = "SELECT DATE(created_at) as date, COUNT(*) as tongbaiviet FROM post GROUP BY DATE(created_at)";
    $result = mysqli_query($conn, $sql);
    $aggregatedData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        $postCount = $row['tongbaiviet'];

        // Check if the date already exists in the aggregated data
        if (array_key_exists($date, $aggregatedData)) {
            // If it exists, add the post count to the existing count
            $aggregatedData[$date] += $postCount;
        } else {
            // If it doesn't exist, create a new entry in the aggregated data
            $aggregatedData[$date] = $postCount;
        }
    }

    // Format the dates without the time component
    $formattedDates = array_map(function ($date) {
        return date("Y-m-d", strtotime($date));
    }, array_keys($aggregatedData));

    // Convert the aggregated data to separate arrays for labels and counts
    $dates = array_values($formattedDates);
    $postCounts = array_values($aggregatedData);
    ?>



    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                data: <?php echo json_encode($postCounts); ?>,
                borderWidth: 1,
                borderColor: "white",
                borderRadius: 2
            }]
        },
        options: {

            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 20,
                    bottom: 10
                },
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                },
                x: {

                    display: false, // Hide x-axis
                }
            }
        }
    });
</script>
<script>//pro
    <?php
    $sql = "SELECT DATE(created_at) as date, COUNT(*) as tongsanpham FROM product GROUP BY DATE(created_at)";
    $result = mysqli_query($conn, $sql);
    $aggregatedData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        $productCount = $row['tongsanpham'];

        // Check if the date already exists in the aggregated data
        if (array_key_exists($date, $aggregatedData)) {
            // If it exists, add the post count to the existing count
            $aggregatedData[$date] += $productCount;
        } else {
            // If it doesn't exist, create a new entry in the aggregated data
            $aggregatedData[$date] = $productCount;
        }
    }

    // Format the dates without the time component
    $formattedDates = array_map(function ($date) {
        return date("Y-m-d", strtotime($date));
    }, array_keys($aggregatedData));

    // Convert the aggregated data to separate arrays for labels and counts
    $dates = array_values($formattedDates);
    $productCount = array_values($aggregatedData);
    ?>
    const proctx = document.getElementById('prochart');
    new Chart(proctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                data: <?php echo json_encode($productCount); ?>,
                pointBackgroundColor: 'white',
                pointBorderColor: 'white',
                pointRadius: 0,
                borderWidth: 1,
                borderColor: "white",
                fill: {
                    target: 'origin',
                    above: 'rgba(255, 255, 255, 0.2)' // White color with 60% opacity
                }
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 20,
                    bottom: 10
                },
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                },
                x: {
                    display: false,
                }
            },
            elements: {
            line: {
                tension: 0.4 // Adjust the tension to control the curve of the line
            }
        }
        }
    });
</script>
<script>//bill
    <?php
    $sql = "SELECT DATE(created_at) as date, COUNT(*) as tongbill FROM bill GROUP BY DATE(created_at)";
    $result = mysqli_query($conn, $sql);
    $aggregatedData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        $billCount = $row['tongbill'];

        // Check if the date already exists in the aggregated data
        if (array_key_exists($date, $aggregatedData)) {
            // If it exists, add the post count to the existing count
            $aggregatedData[$date] += $billCount;
        } else {
            // If it doesn't exist, create a new entry in the aggregated data
            $aggregatedData[$date] = $billCount;
        }
    }

    // Format the dates without the time component
    $formattedDates = array_map(function ($date) {
        return date("Y-m-d", strtotime($date));
    }, array_keys($aggregatedData));

    // Convert the aggregated data to separate arrays for labels and counts
    $dates = array_values($formattedDates);
    $billCount = array_values($aggregatedData);
    ?>



    const billctx = document.getElementById('billchart');
    new Chart(billctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                data: <?php echo json_encode($billCount); ?>,
                borderWidth: 0,
                borderColor: "white",
                backgroundColor: 'rgba(255, 255, 255, 0.2)',
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 20,
                    bottom: 10
                },
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    display: false,
                },
                x: {

                    display: false, // Hide x-axis
                }
            }
        }
    });
</script>
<script>
      <?php
    $sql = "SELECT DATE(created_at) as date, SUM(sub_total) as total FROM bill_detail GROUP BY DATE(created_at)";
    $result = mysqli_query($conn, $sql);
    $aggregatedData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        $totalCount = $row['total'];
        if (array_key_exists($date, $aggregatedData)) {
            $aggregatedData[$date] += $totalCount;
        } else {
            $aggregatedData[$date] = $totalCount;
        }
    }

    $formattedDates = array_map(function ($date) {
        return date("Y-m-d", strtotime($date));
    }, array_keys($aggregatedData));

    $dates = array_values($formattedDates);
    $totalCount = array_values($aggregatedData);
    ?>



    const pricectx = document.getElementById('totalchart');
    new Chart(pricectx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                data: <?php echo json_encode($totalCount); ?>,
                borderWidth: 1,
                borderColor: "black",
                backgroundColor: 'rgba(255, 255, 255, 0.7)',
                pointRadius: 0,
                fill: true,
                borderWidth: 1,
                
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 20,
                    bottom: 10
                },
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            elements: {
            line: {
                tension: 0.4 // Adjust the tension to control the curve of the line
            }
        }
        }
    });
</script>

<?php
get_footer();
?>