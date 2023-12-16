<?php
get_header();
?>

<?php
require_once __DIR__ . '/../../lib/users.php';

// Define $start and $num_per_page
$start = isset($_GET['start']) ? (int) $_GET['start'] : 0;
$num_per_page = 10; 
$list_bill = get_bill_user($start, $num_per_page);
foreach ($list_bill as &$bill) {// &:tham tri
  
}
unset($bill);
if (isset($start, $num_per_page)) {
   
    $list_bill = get_bill_user($start, $num_per_page);
    ?>

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
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Home</a>
                        </li>
                        <li>
                            <a href="" title="">Order detail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <?php
            if (isset($_SESSION['is_login'])) {
                if (!empty($list_bill)  ) {
                    ?>
                    <div class="section" id="info-cart-wp">
                        <div class="section-detail table-responsive">
                            <form method="post" action="?mod=cart&act=update">
                                <table class="table">
                                    <thead>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Order code</span></td>
                                        <td><span class="thead-text">Full name</span></td>
                                        <td><span class="thead-text">Notes</span></td>
                                         <td><span class="thead-text">Address</span></td>
                                        <td><span class="thead-text">Phone number</span></td>
                                        <td><span class="thead-text">Status</span></td>
                                        <td><span class="thead-text">Purchase date</span></td>
                                        <td><span class="thead-text">Details</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $temp = $start;
                                        foreach ($list_bill  as $bill) { 
                                            $bill['url_update'] = "?mod=users&act=update&id={$bill['bill_id']}";
                                            $bill['url_delete_cancel'] = "?mod=users&act=cancel&id={$bill['bill_id']}";
                                            $bill['url'] = "?mod=users&act=detail_order&id={$bill['bill_id']}";
                                            $temp++;
                                            ?>
                                            <tr>
                                                <td><span class="tbody-text">
                                                        <?php echo $temp; ?>
                                                        </h3>
                                                    </span>

                                                <td>

                                                    <span class="tbody-text">
                                                        <?php echo $bill['bill_id']; ?>
                                                    </span>
                                                    <ul class="list-operation fl-right">
                                                    
                                                    <?php
                                                    if ($bill['status'] == 1) {
                                                        ?>
                                                        <li><a href="<?php echo $bill['url_update']; ?>" title="edit" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><a href="<?php echo $bill['url_update']; ?>" title="edit" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="<?php echo $bill['url_delete_cancel']; ?>" title="cancel" onclick="return confirmAction_bill_cancel()" class="delete"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                </td>
                                                <td><span class="tbody-text">
                                                        <?php echo $bill['fullname']; ?>
                                                        </h3>
                                                    </span>
                                                <td><span class="tbody-text">
                                                        <?php if ($bill['note']) {
                                                            echo $bill['note']; ?>
                                                        <?php } else {

                                                            ?>
                                                            <p>No note</p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </span>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $bill['address']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $bill['phone']; ?></span></td>
                                                <td>
                                                    <span class="tbody-text">

                                                        <?php
                                                        if ($bill['status'] == 1) {
                                                            ?>
                                                            <p class="">Processed</p>
                                                            <?php
                                                        } else { ?>
                                                            <p class="">UnProcessed</p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </span>
                                                </td>
                                                <td><span class="tbody-text">
                                                        <?php echo $bill['created_at']; ?>
                                                    </span></td>
                                                <td><a href="<?php echo $bill['url']; ?>" title=""
                                                        class="tbody-text btn btn-xs btn-detail">Details</a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </form>
                        </div>
                       
                    </div>          
                <?php
                } else {
                    ?>
                    <div class="section" id="cart_empty">
                        <p>You don't have bill yet in shop, click <a href="?">here</a> to return to the homepage!</p>
                    </div>
        
                <?php }
            } else { ?>
                <h3 style="color:red; text-align:center;">You are not logged in. Please <a href="?mod=users&act=login">log in</a>
                    to view your bills.</h3>
            <?php } ?>
        </div>
    </div>

    <?php
} else {
    echo "Error: \$start and/or \$num_per_page are not defined.";
}
get_footer();
?>