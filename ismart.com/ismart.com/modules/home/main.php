<?php
get_header();
?>

<?php

$list_dell = get_list_product_by_cat_id(1); // lấy danh sách sp với cat_id =1
$list_asus = get_list_product_by_cat_id(2);
$list_hp = get_list_product_by_cat_id(3);
$list_macbook = get_list_product_by_cat_id(4);
$list_lenovo = get_list_product_by_cat_id(5);
$list_msi = get_list_product_by_cat_id(6);
$list_acer = get_list_product_by_cat_id(7);

$info_cat_dell = get_info_cat(1);
//show_array($info_cat_dell);
$info_cat_asus = get_info_cat(2);
$info_cat_hp = get_info_cat(3);
$info_cat_macbook = get_info_cat(4);
$info_cat_lenovo = get_info_cat(5);
$info_cat_msi = get_info_cat(6);
$info_cat_acer = get_info_cat(7);

$product_highlights = get_product_highlights();
$list_slider = get_list_slider();
$list_post = get_post();
//show_array($list_slider);
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <?php get_sidebar_product(); ?>
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    foreach ($list_slider as $item) {
                        ?>
                        <div class="item">
                            <img src="admin/uploads/<?php echo $item['images']; ?>" alt="">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="admin/uploads/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="admin/uploads/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="admin/uploads/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="admin/uploads/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="admin/uploads/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($product_highlights)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($product_highlights as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy thông tin ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
//                                    echo $currentDate;
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week");
//                                    echo $week;
                                    // chuyển định dạng date và created_at về dạng timestamp(số) + 7 ngày
//                                    echo date("Y-m-d")."<br>";
//                                    echo $item['created_at'];
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
//                                    echo $datediff;
//                                    echo (floor($datediff/ (60 * 60 * 24)));
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bài viết nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_post)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_post as $item) {
                                $item['url'] = "?mod=post&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['images']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['post_title']; ?></a>
                                    <!--                                    <div class="price">
                                                                            <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                                                            <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                                                        </div>-->
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=1" class="section-title"><?php echo $info_cat_dell['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_dell)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_dell as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy thông tin của ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
//                                    echo $currentDate;
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
//                                    echo date("Y-m-d");
//                                    echo $item['created_at'];
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
//                                    echo $datediff;
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=2" class="section-title"><?php echo $info_cat_asus['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_asus)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_asus as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    echo $week;
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=3" class="section-title"><?php echo $info_cat_hp['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_hp)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_hp as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=4" class="section-title"><?php echo $info_cat_macbook['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_macbook)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_macbook as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=5" class="section-title"><?php echo $info_cat_lenovo['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_lenovo)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_lenovo as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=6" class="section-title"><?php echo $info_cat_msi['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_msi)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_msi as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <a href="?mod=product&act=category_product&id=7" class="section-title"><?php echo $info_cat_acer['cat_name']; ?></a>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_acer)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_acer as $item) {
                                $item['url'] = "?mod=product&act=detail&cat_id={$item['cat_id']}&id={$item['id']}";
                                ?>
                                <li>
                                    <?php
                                    $date = getdate(); // lấy ngày
                                    $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]; // lấy ngày tháng năm hiện tai
                                    $week = strtotime(date("Y-m-d", strtotime($item['created_at'])) . " +1 week"); // chuyển định dạng giây về dạng số + 7 ngày
                                    $datediff = $week - (strtotime($currentDate)); // ngày trong khoảng là sp mới = 1 tuần - ngày hiện tại
                                    $labelnew = "";
                                    if (floor($datediff / (60 * 60 * 24)) > 0 && floor($datediff / (60 * 60 * 24)) <= 7) {
                                        $labelnew = "block2-labelnew";
                                    }
                                    ?>
                                    <p class="<?php echo $labelnew; ?>">
                                    </p>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="admin/uploads/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <?php
                                    if ($item['qty_product'] > 0) {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="cart(<?php echo $item['id'] ?>)" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="action clearfix">
                                            <a href="" onclick="return confirmAction_detail()" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>