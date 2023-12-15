<!DOCTYPE html>
<html>
    <head>
        <title>Manager Smart Grear</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/sb-admin.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>


        <!-- Page level plugin CSS-->
        <link href="public/esset/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="public/esset/css/sb-admin.css" rel="stylesheet">

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="modules/product/js/customs.js" type="text/javascript"></script>
        <script src="modules/product/js/customs_1.js" type="text/javascript"></script>
        <script src="modules/product/js/customs_2.js" type="text/javascript"></script>
        <script src="modules/product/js/customs_3.js" type="text/javascript"></script>
        <script src="modules/product/js/customs_4.js" type="text/javascript"></script>
        <script src="modules/product/js/customs_5.js" type="text/javascript"></script>
        <script src="modules/product/js/customs_6.js" type="text/javascript"></script>
        <SCRIPT LANGUAGE="JavaScript">
          function confirmAction_product() {
    return confirm("Do you want to delete this product?");
}

function confirmAction_product_cat() {
    return confirm("Do you want to delete this product category?");
}

function confirmAction_post() {
    return confirm("Do you want to delete this post?");
}

function confirmAction_post_cat() {
    return confirm("Do you want to delete this post category?");
}

function confirmAction_page() {
    return confirm("Do you want to delete this page?");
}

function confirmAction_bill() {
    return confirm("Do you want to delete this order?");
}

function confirmAction_bill_cancel() {
    return confirm("Do you want to cancel this order?");
}

function confirmAction_users() {
    return confirm("Do you want to delete this user?");
}

function confirmAction_slider() {
    return confirm("Do you want to delete this slider?");
}

function confirmAction_user_admin() {
    return confirm("Are you sure you want to delete the account?");
}

function confirmAction_role() {
    return confirm("You do not have sufficient permissions to perform this function.");
}

function confirmAction_search() {
    return confirm("You have not entered a keyword?");
}

function confirmAction_users_logout() {
    return confirm("Do you want to log out?");
}

function confirmAction_delete_status_product() {
    return confirm("This product has been deleted?");
}

function confirmAction_delete_status_post() {
    return confirm("This post has been deleted?");
}

function confirmAction_delete_status_users() {
    return confirm("This member has been deleted?");
}

function confirmAction_update_login_admin() {
    return confirm("You do not have the right to edit this administrator?");
}

function confirmAction_delete_login_admin() {
    return confirm("You do not have the right to delete this administrator?");
}

function confirmAction_change_password() {
    return confirm("You do not have the right to change the password of this administrator?");
}

function confirmAction_users_logout_delete() {
    return confirm("Your account no longer exists. Please log in with another account?");
}

        </SCRIPT>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?page=list_post" title="" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="#" title="">Page</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=page&act=add" title="">Add new</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=page&act=main" title="">List page</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="">Post</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=post&act=add" title="">Add new</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post&act=main" title="">List post</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="">Product</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product&act=add" title="">Add new</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&act=main" title="">List product</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="">Category</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product_cat&act=main" title="">Category product</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post_cat&act=main" title="">Category post</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Order</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=bill&act=list_order" title="">List Order</a> 
                                    </li>
<!--                                    <li>
                                        <a href="?mod=bill&act=bill_status_1" title="">Danh sách đơn hàng đã xử lý</a> 
                                    </li>-->
                                    <li>
                                        <a href="?mod=users&act=main" title="">List Customer</a> 
                                    </li>
                                </ul>
                            </li>
                            <!--                            <li>
                                                            <a href="?page=menu" title="">Menu</a>
                                                        </li>-->
                        </ul>
                            <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                                <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <div style="border-radius: 50px;" id="thumb-circle" class="fl-left">
                                        <img style="border-radius: 50px;" src="uploads/<?php if (is_login_admin()) echo info_user('avatar'); ?>">
                                    </div>
                                    <h3 id="account" class="fl-right"><?php if (is_login_admin()) echo info_user('fullname'); ?></h3>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="?mod=admin&act=info_account" title="Thông tin cá nhân">info account</a></li>
                                    <li><a href="?mod=admin&act=logout"  onclick="return confirmAction_users_logout()" title="Thoát">Logout</a></li>
                                </ul>
                            </div>
                    </div>
                </div>