<?php
include('server_owner.php');
//session_start();

if(isset($_SESSION['username'])) {$username = $_SESSION['username'];}
else {$username = "daoowner";}
$db =  mysqli_connect('localhost', 'root', '', 'db');
$query = "SELECT  vendor_name, owner_name FROM vendor WHERE owner_name='$username'";
$result = mysqli_query($db, $query);
$vendor = mysqli_fetch_assoc($result);
$vendor_name = $vendor['vendor_name'];

$query1 = "SELECT  email FROM user WHERE username='$username'";
$result1 = mysqli_query($db, $query1);
$user = mysqli_fetch_assoc($result1);
$user_email = $user['email'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Thông tin tài khoản</title>
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
                <a href="info-owner.html"><?php echo"Xin chào, $username";?></a>
                <div class="solid_left"></div>
                <a href="index.html">Đăng xuất</a>
              </div>
              <div class="logo_nav_con">
                SMART FOOD COURT SYSTEM
              </div>
              <div class="bottom_nav_con">
                <a href="home-owner.html">TRANG CHỦ</a>
                <a href="report-owner.html">XEM BÁO CÁO</a>
                <a href="menu-owner.html">MENU</a>
                <a href="info-owner.html">THÔNG TIN TÀI KHOẢN</a>
              </div>
            </div>
            <div class="burger">
              <div class="burger_line"></div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main class="ui-bg">
      <div id="user-info">
        <div class="container">
          <div class="section-header">
            <div class="h2-heading">
              THÔNG TIN TÀI KHOẢN
            </div>
          </div>
          <div class="row overlay-white">
            <div class="col-md-6 info-section">
              <div class="section-header-small">
                <div class="h3-heading">Tài khoản</div>
              </div>
              <div>
                <!--User name-->
                <p><?php echo"Tên tài khoản: $username";?></p>
                <p>Loại tài khoản: Chủ quầy hàng</p>
                <p><?php echo"Email: $user_email";?></p>
                <!--Vender name-->
                <p id="owner_vender"><?php echo"Tên gian hàng: $vendor_name";?></p>
              </div>
            </div>
            <div class="col-md-6 info-section">
              <div class="section-header-small">
                <div class="h3-heading">Quầy hàng</div>
              </div>
              <!-- !!! Action php Hereeeeeeeeeeeeeeee-->
              <form action="info-owner.php" method="post">
                <div class="color-red" style="font-size: 20px"><?php include('../signup_21/errors.php'); ?> </div>
                <label for="amount">Đổi tên quầy hàng</label>
                <input
                  type="text"
                  name="vendorName"
                  placeholder="Nhập tên mới..."
                ></input>
                <input type="submit" name="change_name" value="Đổi tên" ></input>
              </form>
            </div>
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
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/navbar.js"></script>
</html>
