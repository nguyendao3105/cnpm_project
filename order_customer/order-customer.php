<?php
  session_start();
  if(isset($_SESSION['username'])) {$username = $_SESSION['username'];}
  else{$username = "daopro";}
  function connect_to_db20()
      {
        $db =  mysqli_connect('localhost', 'root', '', 'db');
        if(!$db) {echo "Server is dead"; return NULL;}
        return $db;  
      }
  function get_order($username)
  {
      $db = connect_to_db20();
      if($db != NULL)
      {
          $query = "SELECT * FROM orders WHERE cus_name = '$username'";
          $result = mysqli_query($db,$query);
          if($result)
          {
            if(mysqli_num_rows($result) > 0)
            {
              $out = array();
              $row = mysqli_fetch_all($result);
                array_push($out,$row);
              
              return $out;
            }
          }
          else return 0;
      }
      else return 0;
  }
  function get_order_detail($id)
  {
    $db = connect_to_db20();
      if($db != NULL)
      {
          $query = "SELECT food_name,quantity FROM orders_detail WHERE id_order = $id";
          $result = mysqli_query($db,$query);
          if($result)
          {
            if(mysqli_num_rows($result) > 0)
            {
              $out = array();
              $row = mysqli_fetch_all($result);
                array_push($out,$row);
              
              return $out;
            }
          }
          else return 0;
      }
      else return 0;
  }
//-------------------------------------------------------------
  $order_array = get_order($username);
  //echo $order_array[0][0][0];
  //tim order_detail_array
  $order_detail_array = array();
  for($x = 0; $x < count($order_array[0]); $x++)
  {
    //$in = get_order_detail($order_array[0][$x][0]);
    //for($y = 0; $y < count($in); $y++)
    //{
    //array_push($order_detail_array, $in[0][$y]);
    //}
    $in = get_order_detail($order_array[0][$x][0]);
    array_push($order_detail_array, $in[0]);
  }
  // echo json_encode($order_detail_array);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Đơn hàng</title>
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
                <a href="info-customer.html">Xin chào, <?php echo $username ?>!</a>
                <div class="solid_left"></div>
                <a href="index.html">Đăng xuất</a>
              </div>
              <div class="logo_nav_con">
                SMART FOOD COURT SYSTEM
              </div>
              <div class="bottom_nav_con">
                <a href="home-customer.html">TRANG CHỦ</a>
                <a href="menu-customer.html">ĐẶT HÀNG</a>
                <a href="order-customer.html">ĐƠN HÀNG</a>
                <a href="info-customer.html">THÔNG TIN TÀI KHOẢN</a>
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
      <div id="order-customer">
        <div class="container">
          <div class="section-header">
            <div class="h2-heading">
              ĐƠN HÀNG
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 overlay-white">
              <!--Result-->
              <div class="order-result">
                <div class="col-md-12">
                  <table class="table table-section table-hover">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <!--<th>Tình trạng</th>-->
                        <th>ID đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Thời gian</th>
                        <th>Tổng tiền</th>
                        <th>Gian hàng số</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
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
  <script type="text/javascript">
    // Global variables
var orderArray = <?php echo json_encode($order_array[0]); ?>; 
//[
 // ["2020080300001", "Đoàn Ngọc Thịnh", "2020-08-03", "86000", "1"],
  //["2020080200001", "Nguyễn Khắc Đạo", "2020-08-02", "52000", "2"],
//];

var orderDetailArray = <?php echo json_encode($order_detail_array); ?>;
//[
  //[
  /*
    ["Canh khổ qua nhồi thịt", "2", "29000"],
    ["Trà sữa truyền thống", "2", "19000"],
    ["Canh khổ qua nhồi thịt", "2", "29000"],
    ["Trà sữa truyền thống", "2", "19000"],
    ["Canh khổ qua nhồi thịt", "2", "29000"],
    ["Trà sữa truyền thống", "2", "19000"],
    ["Canh khổ qua nhồi thịt", "2", "29000"],
    ["Trà sữa truyền thống", "2", "19000"],
    ["Canh khổ qua nhồi thịt", "2", "29000"],
    ["Trà sữa truyền thống", "2", "19000"],
  ],
  [["Cà phê đen đá", "3", "14000"]], */
//];
  </script>
</html>
