<?php
get_header();
?>
<?php
$list_users = get_list_users_cat($_SESSION['user_login']);

$list_users['url'] = "?mod=users&act=change_password&id={$list_users['user_id']}";
$list_users['url_change_pass'] =  "?mod=users&act=change_password&id={$list_users['user_id']}";
?>
<style>
/* Sidebar styling */
#sidebar {
    float: left;
    width: 25%;
    margin-right: 5%;
    box-sizing: border-box;
    /* Fix box-sizing */
}

/* Content styling */
#contentt {
    float: left;
    width: 65%;
    box-sizing: border-box;
    /* Fix box-sizing */
}

/* Section styling */
.section-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
    /* Add margin for better spacing */
}

.section-detail {
    margin-top: 20px;
}

/* Form styling */
#form-profile {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    /* Fix box-sizing */
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="tel"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    /* Fix box-sizing */
}

/* Responsive adjustments */
@media only screen and (max-width: 768px) {

    #sidebar,
    #contentt {
        width: 100%;
        margin-right: 0;
    }

    #form-profile {
        max-width: 100%;
        /* Full width on smaller screens */
    }
}
</style>
<div id="main-content-wp" class="clearfix info-member-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Home</a>
                    </li>
                    <li>
                        <a href="?" title="">Personal information</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?mod=users&act=info_account" title="">Personal information</a>
                </li>

                <li>
                    <a href="<?php echo $list_users['url']; ?>">Change Password</a>
                </li>

                <li>
                    <a href="?mod=users&act=logout" onclick="return confirmAction_users()" title="">Sign out</a>
                </li>
                <li>
                    <a href="?mod=users&act=view" title="">Purchase order</a>
                </li>
            </ul>
        </div>
        <div id="contentt" class="fl-right">
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Personal information</h3>
                    </div>
                    <div class="section-detail">
                        <form action="" id="form-profile" method="post" accept-charset="utf-8">
                            <label for="display_name">First and last name</label>
                            <input type="text" value="<?php echo $list_users['fullname'] ?>" name="display_name"
                                id="display_name" disabled="true"><br>
                            <label for="user_login">Username</label>
                            <input type="text" value="<?php echo $list_users['username'] ?>" name="user_login"
                                id="display_name" disabled="true"><br>
                            <label for="phone">Phone number</label>
                            <input type="tel" name="user_tel" value="<?php echo $list_users['phone'] ?>" id="user_tel"
                                disabled="true"><br>
                            <label for="email">Email</label>
                            <input type="email" name="user_email" id="user_email"
                                value="<?php echo $list_users['email'] ?>" disabled="true"><br>
                            <label for="user_address">Address</label>
                            <input type="text" name="user_address" id="user_address" disabled="true"
                                value="<?php echo $list_users['address'] ?>"><br>
                            <label for="gender">Gender</label>
                            <input type="text" name="user_address" id="user_address" disabled="true"
                                value="<?php echo show_gender($list_users['gender']) ?>"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>