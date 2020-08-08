<?php include('../php_server/server_Dao.php'); ?>
<?php
include('../php_header/info_header.php');
//session_start();
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  //$username = "";
  header("location: ../index.php");
}
$row = get_cus_info($username);
if ($row == 0) {
  $row = ["", "", "", ""];
} else {
  $row[0] = intval($row[0]);
  $row[3] = intval($row[3]);
}
$user_array = array();
array_push($user_array, $row[1]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Thông tin tài khoản</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.css" />

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
              <a href="info_customer.php">Xin chào, <?php echo $username ?>!</a>
              <div class="solid_left"></div>
              <form id="logout" action="info_customer.php" method="post">
                <a href="javascript:;" onclick="document.getElementById('logout').submit();">
                  Đăng xuất
                </a>
                <input type="hidden" name="logout" value="logout" />
              </form>
            </div>
            <div class="logo_nav_con">
              SMART FOOD COURT SYSTEM
            </div>
            <div class="bottom_nav_con">
              <a href="home_customer.php">TRANG CHỦ</a>
              <a href="menu_customer.php">ĐẶT HÀNG</a>
              <a href="order_customer.php">ĐƠN HÀNG</a>
              <a href="info_customer.php">THÔNG TIN TÀI KHOẢN</a>
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
              <p>Tên tài khoản: <?php echo $row[1]; ?> </p>
              <p>Loại tài khoản: Khách hàng</p>
              <p>Email: <?php echo $row[2]; ?> </p>
              <!--Balance-->
              <p id="balance"><?php echo $row[3]; ?></p>
            </div>
          </div>
          <div class="col-md-6 info-section">
            <div class="section-header-small">
              <div class="h3-heading">Nạp tiền</div>
            </div>
            <!-- !!! Action php Hereeeeeeeeeeeeeeee-->
            <form action="info_customer.php" onsubmit="update()">
              <label for="amount">Số tiền cần nạp</label>
              <input type="text" id="amount" name="amount" placeholder="Nhập số tiền..." />
              <label for="bank">Ngân hàng</label>
              <select id="bank" name="bank">
                <option disabled selected value>--</option>
                <option value="OCB">OCB</option>
                <option value="BIDV">BIDV</option>
                <option value="VietinBank">VietinBank</option>
                <option value="Agribank">Agribank</option>
                <option value="VietcomBank">VietcomBank</option>
              </select>
              <input type="submit" name="naptien" value="Nạp tiền" />
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
<script src="../js/currency.js"></script>
<script type="text/javascript">
  function update() {
    var array = <?php echo json_encode($user_array) ?>;
    var username = array[0];
    //alert(username);
    var amount = document.getElementById("amount").value;
    if (amount != "" && amount != "0") {
      var a = confirm("Bạn có chắc mình muốn nạp không?");
      if (a == true) {
        //alert(amount);

        $.ajax({
          url: "../php_server/info_customer_server.php",
          type: "POST",
          async: false,
          data: {
            username: username,
            amount: amount
          },
          // dataType: 'json',
          success: function(response) {
            alert(response);
            //alert("success");
          },
          error: function(data) {
            alert("failed");
          }
        });
      } else {};
    } else {
      alert("Vui lòng nhập số tiền, tối thiểu 1");
    }
  }
  var _balance = document.getElementById("balance");
  if (_balance) {
    _balance.innerHTML = `Số dư: ${formatMoney.format(
      getFloatMoneyComma(_balance.innerText)
    )}`;
  }
</script>

</html>