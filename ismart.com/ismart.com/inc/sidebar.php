<?php
require 'db/connect.php';
$id = (int) $_GET['id'];
$sql = "SELECT * FROM `category` WHERE `cat_id` = '{$id}'";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $list_cat[] = $row;
}
//show_array($list_cat);
?>
<?php
$sql = "SELECT * FROM `category` where status = 1";
$result = mysqli_query($conn, $sql);
$list_category = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_category[] = $row;
    }
}

//show_array($list_category);
?>
<?php
//show_array($price);
?>


<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Product categories</h3>
        </div>
        <div class="secion-detail">
           <?php
            if(isset($list_category)){
            ?>
            <ul class="list-item">
                <?php
                foreach($list_category as $category){
                ?>
                <li>
                    <a href="?mod=product&act=category_product&id=<?php echo $category['cat_id'] ?>" title=""><?php echo $category['cat_name'] ?></a>
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
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Filter</h3>
        </div>
        <div class="section-detail">
            <form method="POST" action="">
                <?php
                if (isset($list_cat)) {
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <td colspan="2">Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_cat as $item) {
                                ?>
                                <tr><td><a href="?mod=product_price&act=product_price_under_10m&id=<?php echo $item['cat_id'] ?>">Under 10,000,000 VND</a></td>
                                </tr>
                                <tr>
                                    <td><a href="?mod=product_price&act=product_price_10m_to_15m&id=<?php echo $item['cat_id'] ?>">10,000,000 VND - 15,000,000 VND</a></td>
                                </tr>
                                <tr>
                                    <td><a href="?mod=product_price&act=product_price_15m_to_20m&id=<?php echo $item['cat_id'] ?>">15,000,000 VND - 20,000,000 VND</a></td>
                                </tr>
                                <tr>
                                    <td><a href="?mod=product_price&act=product_price_20m_to_25m&id=<?php echo $item['cat_id'] ?>">20,000,000 VND - 25,000,000 VND</a></td>
                                </tr>
                                <tr>
                                    <td><a href="?mod=product_price&act=product_price_on_25m&id=<?php echo $item['cat_id'] ?>">Over 25,000,000 VND</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </form>
        </div>
    </div>
<!--    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>-->
</div>