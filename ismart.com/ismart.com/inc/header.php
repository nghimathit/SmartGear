<!DOCTYPE html>
<html>
    <head>
        <title>Smart Gear</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>
        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
        <script src="public/js/myscript.js" type="text/javascript"></script>
        <script src="modules/cart/js/app.js" type="text/javascript"></script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3"></script>
        <SCRIPT LANGUAGE="JavaScript">
            function confirmAction_delete_cart() {
                return confirm("Do you want to remove this product from your cart?")
            }
            function confirmAction_delete_all_cart() {
                return confirm("Do you want to remove all products from the cart?")
            }
            function confirmAction_users() {
                return confirm("Do you want to log out?")
            }
            function confirmAction_detail() {
                return confirm("This product is out of stock, please choose another product?")
            }
            function confirmAction_email() {
                return confirm("Please check your email to confirm?")
            }
        </SCRIPT>
        <script>
            function cart(id) {
                $.get("?mod=cart&act=add", {"id": id}, function (data) {

                });

            }
        </script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <div id="main-menu-wp" class="fl-left">
                                <ul id="main-menu" class="clearfix">
                                <li class="active">
                                        <a href="?page=home" title="">Home</a>
                                    </li>
                                    <li>
                                        <a href="?mod=post&act=blog" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="?mod=order_view&act=view" title="">Purchase order</a>
                                    </li>
                                    <?php
                                    require 'db/connect.php';
                                    $sql = "select * from page where status = 1";
                                    $result = mysqli_query($conn, $sql);
                                    $page = array();
                                    $num_rows = mysqli_num_rows($result);
                                    if ($num_rows > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $page[] = $row;
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($page as $item) {
                                        ?>
                                        <li>
                                            <a href="?mod=page&act=main" title=""><?php echo $item['page_title'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li>
                                        <a href="?mod=page&act=contact" title="">Contact</a>
                                    </li>
                                </ul>
                            </div>

                            <?php
                            if (isset($_SESSION['is_login'])) {
                                ?>
                                <div id="user-login" class="dropdown dropdown-extended fl-right">
                                    <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <h3 id="account" class="fl-right">Hello <strong><?php if (is_login()) echo info_user('fullname'); ?></strong></h3>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a href="?mod=users&act=info_account" title="Personal information">Personal information</a></li>
                                        <!-- <li><a href="?mod=users&act=change_password" title="Change password">Change password</a></li>-->
                                        <li><a class="logout" onclick="return confirmAction_users()" href="?mod=users&act=logout">Log out</a></li>
                                    </ul>
                                </div>
                                <?php
                            }else {
                                ?>
                                <div id="action-user" class="fl-right">
                                <div id="not-signed">
                                        <a href="?mod=users&act=login" title="" id="login">Login</a>
                                        <span id="icon">/</span>
                                        <a href="?mod=users&act=register" title="" id="reg">Register</a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="?page=home" title="" id="logo" class="fl-left"><img src="public/images/logo22.png"/></a>
                            <div id="search-wp" class="fl-left">
                            <form method="POST" action="?mod=search&act=search_product">
                                    <input type="text" name="keyword" id="search" placeholder="Enter search keyword here!">
                                    <button type="submit" name="btn_search" id="btn_search">Search</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                    <span class="title">Consulting</span>
                                    <span class="phone">0362061339</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?mod=cart&act=show" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                                    <?php
                                    if (isset($_SESSION['cart']['buy'])) {
                                        $num_order = count($_SESSION['cart']['buy']);
                                    } else {
                                        $num_order = 0;
                                    }
                                    ?>
                                    <span id="num"><?php echo $num_order; ?></span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                                        <?php
                                        if (isset($_SESSION['cart']['buy'])) {
                                            $num_order = count($_SESSION['cart']['buy']);
                                        } else {
                                            $num_order = 0;
                                        }
                                        ?>
                                        <span id="num"><?php echo $num_order; ?></span>
                                    </div>
                                    <div id="dropdown">
                                    <p class="desc">There are <span><?php echo $num_order ?> products</span> in the cart</p>
                                        <?php
                                        if (isset($_SESSION['cart']['buy'])) {
                                            $list_buy = get_list_by_cart();
                                            ?>
                                            <ul class="list-cart">
                                                <?php
                                                foreach ($list_buy as $buy) {
                                                    ?>
                                                    <li class="clearfix">
                                                        <a href="" title="" class="thumb fl-left">
                                                            <img src="admin/uploads/<?php echo $buy['product_thumb'] ?>" alt="">
                                                        </a>
                                                        <div class="info fl-right">
                                                            <a href="" title="" class="product-name"><?php echo $buy['product_name'] ?></a>
                                                            <p class="price"><?php echo currency_format($buy['price_new']) ?></p>
                                                            <p class="qty">Quantity: <span><?php echo $buy['qty'] ?></span></p>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                        <div class="total-price clearfix">
                                            <?php
                                            if (isset($_SESSION['cart']['info']['total'])) {
                                                $total = $_SESSION['cart']['info']['total'];
                                            } else {
                                                $total = 0;
                                            }
                                            ?>
                                           <p class="title fl-left">Total:</p>
                                            <p class="price fl-right"><?php echo currency_format($total); ?></p>

                                            </div>
                                        <dic class="action-cart clearfix">
                                            <a href="?mod=cart&act=show" title="Cart" class="view-cart fl-left">Cart</a>
                                            <?php
                                            if (isset($_SESSION['is_login'])) {
                                                ?>
                                                <a href="?mod=check_out&act=checkout" title="Checkout" class="checkout fl-right">Checkout</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="?mod=users&act=login" title="Login" class="checkout fl-right">Checkout</a>
                                                <?php
                                            }
                                            ?>
                                        </dic>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>