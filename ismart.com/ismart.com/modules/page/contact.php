<?php
get_header()
?>
<?php
//$sql = "SELECT * FROM `page`";
//$result = mysqli_query($conn, $sql);
//$row = array();
//$num_rows = mysqli_num_rows($result);
//if ($num_rows > 0) {
//    $row = $result->fetch_assoc();
//}

//show_array($row);
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?" title="">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php get_sidebar_product_page(); ?> 
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Liên hệ</h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">2019-06-09 11:33:00</span>
                    <div class="detail">
                        <p>Website thương mại điện tử Smart Gear</p>
                        <p>Địa chỉ: 391 Nam Kỳ Khởi Nghĩa Q.3 TP.HCM</p>
                        <p>Số điện thoại: 0362061339</p>
                        <p>Email: Team4FPTAptechHcm.com</p>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
