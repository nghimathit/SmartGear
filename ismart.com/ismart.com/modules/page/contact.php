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
<style>
    .bando{
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 500px;
  margin-bottom: 70px;
}
</style>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Home</a>
                    </li>
                    <li>
                        <a href="?" title="">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php get_sidebar_product_page(); ?> 
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Contact</h3>
                </div>
                <div class="section-detail">
                <span class="create-date">2019-06-09 11:33:00</span>
                    <div class="detail">
                        <p>Smart Gear e-commerce website</p>
                        <p>Address: 391 Nam Ky Khoi Nghia, District 3, Ho Chi Minh City</p>
                        <p>Phone number: 0362061339</p>
                        <p>Email: Team4FPTAptechHcm.com</p>
                    </div>
                </div>

            </div>
        
            <div class="bando">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4079740757047!2d106.67716187460415!3d10.856542357711723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528359b9e27e3%3A0x8bcba72c28148fc4!2zMTQyIEjDoCBIdXkgR2nDoXAsIFRo4bqhbmggTOG7mWMsIFF14bqtbiAxMiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1690853536993!5m2!1svi!2s" width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
