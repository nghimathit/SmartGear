<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý Smart Grea</title>
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
                return confirm("Bạn muốn xóa sản phẩm này?")
            }
            function confirmAction_product_cat() {
                return confirm("Bạn muốn xóa danh mục sản phẩm này?")
            }
            function confirmAction_post() {
                return confirm("Bạn muốn xóa bài viết này?")
            }
            function confirmAction_post_cat() {
                return confirm("Bạn muốn xóa danh mục bài viết này?")
            }
            function confirmAction_page() {
                return confirm("Bạn muốn xóa trang này?")
            }
            function confirmAction_bill() {
                return confirm("Bạn muốn xóa đơn hàng này?")
            }
            function confirmAction_bill_cancel() {
                return confirm("Bạn muốn hủy đơn hàng này?")
            }
            function confirmAction_users() {
                return confirm("Bạn muốn xóa người dùng này?")
            }
            function confirmAction_slider() {
                return confirm("Bạn muốn xóa slider này?")
            }
            function confirmAction_user_admin() {
                return confirm("Bạn có chắc chắn muốn xóa tài khoản?")
            }
            function confirmAction_role() {
                return confirm("Bạn không có đủ quyền hạn để thực hiện chức năng này?")
            }
            function confirmAction_search() {
                return confirm("Bạn chưa nhập từ khóa?")
            }
            function confirmAction_users_logout() {
                return confirm("Bạn muốn đăng xuất?")
            }
            function confirmAction_delete_status_product() {
                return confirm("Sản phẩm này đã được xóa?")
            }
            function confirmAction_delete_status_post() {
                return confirm("Bài viết này đã được xóa?")
            }
            function confirmAction_delete_status_users() {
                return confirm("Thành viên này đã được xóa?")
            }
            function confirmAction_update_login_admin() {
                return confirm("Bạn không có quyền sửa người quản trị này?")
            }
            function confirmAction_delete_login_admin() {
                return confirm("Bạn không có quyền xóa người quản trị này?")
            }
            function confirmAction_change_password() {
                return confirm("Bạn không có quyền đổi mật khẩu người quản trị này?")
            }
            function confirmAction_users_logout_delete() {
                return confirm("Tài khoản của bạn không còn tồn tại bạn vui lòng đăng nhập tài khoản khác?")
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
                                <a href="#" title="">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=page&act=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=page&act=main" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=post&act=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post&act=main" title="">Danh sách bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product&act=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&act=main" title="">Danh sách sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="">Danh mục</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product_cat&act=main" title="">Danh mục sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post_cat&act=main" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=bill&act=list_order" title="">Danh sách đơn hàng</a> 
                                    </li>
<!--                                    <li>
                                        <a href="?mod=bill&act=bill_status_1" title="">Danh sách đơn hàng đã xử lý</a> 
                                    </li>-->
                                    <li>
                                        <a href="?mod=users&act=main" title="">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <!--                            <li>
                                                            <a href="?page=menu" title="">Menu</a>
                                                        </li>-->
                        </ul>
                            <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                                <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <div id="thumb-circle" class="fl-left">
                                        <img src="uploads/<?php if (is_login_admin()) echo info_user('avatar'); ?>">
                                    </div>
                                    <h3 id="account" class="fl-right"><?php if (is_login_admin()) echo info_user('fullname'); ?></h3>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="?mod=admin&act=info_account" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                    <li><a href="?mod=admin&act=logout"  onclick="return confirmAction_users_logout()" title="Thoát">Đăng xuất</a></li>
                                </ul>
                            </div>
                    </div>
                </div>