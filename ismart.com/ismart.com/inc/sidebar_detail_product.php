<?php
require 'db/connect.php';
$sql = "select * from category";
$result = mysqli_query($conn, $sql);
$list_cat = array();
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list_cat[] = $row;
    }
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
    
<!--    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>-->
</div>