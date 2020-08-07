<?php
  include('report_server.php');
  session_start();
  if(isset($_SESSION['username'])) {$username = $_SESSION['username'];}
  else{$username = "";}
  //----------------------------------------test
  $a = get_order_id_array();
  if($a != 0)
  {
    for($x = 0; $x < count($a); $x++)
    {
      echo $a[$x];
    }
  }
  else echo "Cc";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Báo cáo - Quản lí</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../fonts/font-awesome/css/font-awesome.css"
    />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <header>
      <div class="container">
        <div class="row">
          <div class="nav_bar">
            <div class="background_hider"></div>
            <div class="logo logo_nav_con">
              SMART FOOD COURT SYSTEM
            </div>
            <div class="nav_links">
              <div class="top_nav_con">
                <a href="user_info.html">Xin chào, <?php echo $username ?>!</a>
                <div class="solid_left"></div>
                <a href="index.html">Đăng xuất</a>
              </div>
              <div class="logo_nav_con">
                SMART FOOD COURT SYSTEM
              </div>
              <div class="bottom_nav_con">
                <a href="home-manager.html">TRANG CHỦ</a>
                <a href="#">QUẦY HÀNG</a>
                <a href="#">NHÂN SỰ</a>
                <a href="#">THÔNG TIN</a>
              </div>
            </div>
            <div class="burger">
              <div class="burger_line"></div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main>
      <div class="report-manager-section">
        <div class="container">
          <div class="section-header">
            <div class="h2-heading">
              BÁO CÁO
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <!-- Bao cao -->
              <p style="margin-bottom: 25px; font-size: 150%;">
                Báo cáo của
                <select style="font-size: 100%;">
                  <option>Tất cả các gian hàng</option>
                  <option>Gian hàng 1</option>
                  <option>Gian hàng 2</option>
                  <option>Gian hàng 3</option>
                </select>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p style="font-size: 150%;">
                Ngày bắt đầu:
                <input
                  type="date"
                  name="cothethaydoi1"
                  style="font-size: 100%;"
                />
              </p>
            </div>
            <div class="col-md-6">
              <p style="font-size: 150%;">
                Ngày kết thúc:
                <input
                  type="date"
                  name="cothethaydoi2"
                  style="font-size: 100%;"
                />
              </p>
            </div>
          </div>
        </div>
        <div class="container report-manager-details">
          <div class="col-md-12">
            <table style="font-size: 150%; text-align: left;">
              <th width="25%">STT</th>
              <th width="65%">Món ăn</th>
              <th width="45%">Số lượng</th>
            </table>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <div class="container text-center">
        <div class="col-md-6">
          <p>© 2020 Smart Food Court System. All rights reserved</p>
        </div>
        <div class="col-md-6">
          <div class="social">
            <ul>
              <li>
                <a href="#"><i class="fa fa-facebook"></i></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-twitter"></i></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-youtube"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>
  <!-- Stylesheet -->
  <!--Navbar script must be placed after body-->
  <script src="../js/navbar.js"></script>
  <script src="../js/slider.js"></script>
</html>
