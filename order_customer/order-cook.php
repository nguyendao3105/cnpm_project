<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Xử lí đơn hàng</title>
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
                <a href="info-cook.html">Xin chào, Đầu bếp!</a>
                <div class="solid_left"></div>
                <a href="index.html">Đăng xuất</a>
              </div>
              <div class="logo_nav_con">
                SMART FOOD COURT SYSTEM
              </div>
              <div class="bottom_nav_con">
                <a href="home-cook.html">TRANG CHỦ</a>
                <a href="order-cook.html">ĐƠN HÀNG</a>
                <a href="menu-cook.html">MENU</a>
                <a href="info-cook.html">THÔNG TIN TÀI KHOẢN</a>
              </div>
            </div>
            <div class="burger">
              <div class="burger_line"></div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main class="food-bg">
      <div id="order-cook">
        <div class="container">
          <div class="section-header">
            <div class="h2-heading">
              ĐƠN HÀNG
            </div>
          </div>
          <div class="row overlay-white">
            <div class="col-md-12">
              <div class="section-header">
                <div class="h3-heading">Đơn hàng</div>
              </div>
              <table class="table table-section table-hover">
                <thead>
                  <th>STT</th>
                  <!--<th>Tình trạng</th>-->
                  <th>Mã đơn hàng</th>
                  <th>Tên khách hàng</th>
                  <th>Thời gian</th>
                  <th>Tổng tiền</th>
                  <th>Gian hàng số</th>
                </thead>
                <tbody></tbody>
              </table>
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
  <script src="../js/order.js"></script>
</html>
