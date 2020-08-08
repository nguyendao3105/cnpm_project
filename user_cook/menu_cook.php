<?php include('../php_server/server_Dao.php'); ?>
<?php
//session_start();
include('../php_header/cook_header.php');
//------------------------------------------------------------------------------------------------------------------- test
//process cho page
//list vendor-name
$vendor_name = get_list_vendor_name();
/*for($x = 0; $x < count($vendor_name); $x++)
                 {
                     echo $vendor_name[$x];
                 } */
//list vendor-id
$vendor_table = get_vendor_table();
if ($vendor_table != 0) {
  $id_array = array();
  //echo "\n       id:       ";
  for ($x = 0; $x < count($vendor_table); $x++) {
    array_push($id_array, $vendor_table[$x][0]);
  }
  /*for($x = 0; $x < count($vendor_table); $x++)
                    {
                     echo $id_array[$x];
                    }*/
} else {
  array_push($error, "Something went wrong");
}
//list vendor-food
$food_array = array();
$length_food_array = 0;
// mang chua nhieu mang nho; moi mang nho la danh sach do an cua tung vendor
$array_0 = array("404", "0", "0", "0"); // Dung de push NULL vao mang $food_array
// echo "count id_array"; echo count($id_array); echo ".............";
$gg = 0;
while ($gg < count($id_array)) {
  /*echo "Vendor ";
                echo $id_array[$gg];
                echo ":";*/
  $a = get_list_name_vendor_food($id_array[$gg]);
  if ($a != 0) {
    /*
                        array_push($food_array, $a);
                        $length_food_array++;
                        for($x = 0; $x < count($a); $x++)
                        {
                            echo $a[$x];
                        }*/
    $node = array();
    for ($x = 0; $x < count($a); $x++) {
      array_push($node, $a[$x]);
    }
    array_push($food_array, $node);
    $length_food_array++;
  } else {
    array_push($food_array, $array_0);
    $length_food_array++;
  }
  $gg++;
}
//push list vendor food vo mang lon cho js lay
//----------- test $food_array --->done
/*
                        echo "Test food_array: ..............";
                        if($length_food_array != 0)
                        {
                            for($x = 0;$x<$length_food_array; $x++)
                            {
                                echo "vendor"; echo $x + 1; echo ":";
                                if($food_array[$x][0] != "404")
                                {
                                    for($y = 0;$y < count($food_array[$x]);$y++)
                                    {
                                        echo $food_array[$x][$y];
                                    }
                                }
                            }
                        }*/
// toi day la xong food_array
//all food_table
//echo "<br>";
$food_info_array = array();
$length_food_info_array = array();
for ($x = 0; $x < count($id_array); $x++) {
  $node = array();
  $a = get_vendor_food_inform_from_id($id_array[$x], $node);
  array_push($length_food_info_array, $a);
  array_push($food_info_array, $node);
}
$name_array = array();
for ($x = 0; $x < count($food_info_array); $x++) {
  //echo "Vendor"; echo $x+1;echo":";
  for ($y = 0; $y < $length_food_info_array[$x]; $y++) {
    array_push($name_array, $food_info_array[$x][$y][1]);
    //echo $food_info_array[$x][$y][1];
    //echo "...";
  }
  //echo "<br>";
}
$des_array = array();
for ($x = 0; $x < count($food_info_array); $x++) {
  //echo "Info"; echo $x+1;echo":";
  for ($y = 0; $y < $length_food_info_array[$x]; $y++) {
    array_push($des_array, $food_info_array[$x][$y][4]);
  }
  // echo "<br>";
}
$price_array = array();
for ($x = 0; $x < count($food_info_array); $x++) {
  // echo "Price"; echo $x+1;echo":";
  for ($y = 0; $y < $length_food_info_array[$x]; $y++) {
    array_push($price_array, $food_info_array[$x][$y][2]);
  }
  //echo "<br>";
}
$avail_array = array();
for ($x = 0; $x < count($food_info_array); $x++) {
  // echo "Price"; echo $x+1;echo":";
  for ($y = 0; $y < $length_food_info_array[$x]; $y++) {
    array_push($avail_array, intval($food_info_array[$x][$y][0]));
  }
  //echo "<br>";
}
//echo json_encode($avail_array);
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  //$username = "";
  header("location: ../index.php");
}
?>

<!DOCTYPE html>
<htmllang="en">

  <head>
    <title>Menu</title>
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
                <a href="info_cook.php">Xin chào, <?php echo $username ?>!</a>
                <div class="solid_left"></div>
                <form id="logout" action="menu_cook.php" method="post">
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
                <a href="home_cook.php">TRANG CHỦ</a>
                <a href="order_cook.php">ĐƠN HÀNG</a>
                <a href="menu_cook.php">MENU</a>
                <a href="info_cook.php">THÔNG TIN TÀI KHOẢN</a>
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
      <div id="menu-cook">
        <div class="container">
          <div class="section-header">
            <div class="h2-heading">
              MENU
            </div>
          </div>
          <div class="row overlay-white">
            <!--Menu-->
            <div class="menu-result">
              <div class="col-md-12">
                <table class="table table-section table-hover">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên món</th>
                      <th>Giá tiền</th>
                      <th>Mô tả</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
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
  <!-- Viet script -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="../js/navbar.js"></script>
  <script src="../js/currency.js"></script>
  <script src="../js/menu.js"></script>
  <script type="text/javascript">
    var name_arr = <?php echo json_encode($name_array); ?>;
    var des_arr = <?php echo json_encode($des_array); ?>;
    var price_arr = <?php echo json_encode($price_array); ?>;
    var avail_array = <?php echo json_encode($avail_array); ?>;
    var menuArray = [avail_array, name_arr, price_arr, des_arr];
    extractMenuCook(menuArray);
  </script>

  </html>