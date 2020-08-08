<?php
include('../php_server/server_Dao.php');
include('../php_server/server_owner.php');
// include('../order_cook/cook_header.php');
//echo json_encode($avail_array);

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  //$username = "";
  header("location: ../index.php");
}


function get_vendor_food_inform_from_id($vendor_id, &$arr) //Lay thong tin ve cac mon an cua 1 quay bang id
{
  $db = connect_to_db21();
  if ($db != NULL) {
    $query = "SELECT available,foodname,price,id_food,descriptions_food,source_image,id_vendor FROM food WHERE id_vendor = $vendor_id ORDER BY id_food ASC";  //ASC or DESC
    $num = 0;
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
      $num = mysqli_num_rows($result);
      $arr = array();
      $row = mysqli_fetch_all($result);
      for ($x = 0; $x < $num; $x++) {
        array_push($arr, $row[$x]);
      }
      return $num;
    } else {
      return $num;
    }
  }
}
function get_id($name)
{
  $db = connect_to_db21();
  if ($db != NULL) {
    $query = "SELECT id_vendor FROM vendor WHERE owner_name ='$name'";  //ASC or DESC
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['id_vendor'];
    } else {
      return 0;
    }
  } else return 0;
}
//------------------------------------------------------------------------------------------------------------------- test
$name_array = array();
$des_array = array();
$price_array = array();
$avail_array = array();
$id = get_id($username);
if ($id != 0) {
  $food_info_array = array();
  get_vendor_food_inform_from_id($id, $food_info_array);
  // echo $food_info_array[1][2];
  for ($x = 0; $x < count($food_info_array); $x++) {
    //echo "Vendor"; echo $x+1;echo":";
    array_push($name_array, $food_info_array[$x][1]);
  }
  for ($x = 0; $x < count($food_info_array); $x++) {
    //echo "Info"; echo $x+1;echo":";
    array_push($price_array, $food_info_array[$x][2]);
  }
  for ($x = 0; $x < count($food_info_array); $x++) {
    array_push($des_array, $food_info_array[$x][4]);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

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
              <a href="info_owner.php">Xin chào, <?php echo $username ?>!</a>
              <div class="solid_left"></div>
              <form id="logout" action="menu_owner.php" method="post">
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
              <a href="home_owner.php">TRANG CHỦ</a>
              <a href="report_owner.php">XEM BÁO CÁO</a>
              <a href="menu_owner.php">MENU</a>
              <a href="info_owner.php">THÔNG TIN TÀI KHOẢN</a>
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
    <div id="menu-owner">
      <div class="container">
        <div class="section-header">
          <div class="h2-heading">
            MENU
          </div>
        </div>
        <div class="row overlay-white">
          <!--Add food-->
          <div class="add-food">
            <div class="col-md-12">
              <div class="section-header-small">
                <div class="h3-heading">
                  Thêm món ăn
                </div>
              </div>
            </div>
            <form action="menu_owner.php" method="post">
              <div class="color-red" style="font-size: 20px"><?php include('../errors.php'); ?> </div>
              <!--Food name-->
              <div class="col-md-2 col-sm-3 col-xs-5">
                <label for="foodName">Food name</label>
              </div>
              <div class="col-md-4 col-sm-9 col-xs-7">
                <input type="text" name="foodName" placeholder="Food name"></input>
              </div>
              <!--Price-->
              <div class="col-md-2 col-sm-3 col-xs-5">
                <label for="price">Price</label>
              </div>
              <div class="col-md-4 col-sm-9 col-xs-7">
                <input type="text" name="price" placeholder="Price"></input>
              </div>
              <!--Description-->
              <div class="col-md-2 col-sm-3 col-xs-5">
                <label for="foodDescription">Food description</label>
              </div>
              <div class="col-md-4 col-sm-9 col-xs-7">
                <input type="text" name="foodDescription" placeholder="Food description"></input>
              </div>
              <!--Source image-->
              <div class="col-md-2 col-sm-3 col-xs-5">
                <label for="sourceImage">Source image</label>
              </div>
              <div class="col-md-4 col-sm-9 col-xs-7">
                <input type="text" name="sourceImage" placeholder="Images/Menu/"></input>
              </div>
              <!--Submiss button-->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="submit" name="add_food" value="Thêm món ăn" />
              </div>
            </form>
          </div>
          <!--Menu-->
          <div class="menu-result">
            <div class="col-md-12">
              <div class="section-header-small">
                <div class="h3-heading">
                  Menu
                </div>
              </div>
              <table class="table table-section table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên món</th>
                    <th>Giá tiền</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
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
<!-- Stylesheet -->
<!--Navbar script must be placed after body-->
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/navbar.js"></script>
<script src="../js/currency.js"></script>
<script src="../js/menu.js"></script>
<script type="text/javascript">
  var name_arr = <?php echo json_encode($name_array); ?>;
  var des_arr = <?php echo json_encode($des_array); ?>;
  var price_arr = <?php echo json_encode($price_array); ?>;
  //alert(price_arr);
  //var avail_array = <?php echo json_encode($avail_array); ?>;
  if (name_arr != [] && des_arr != [] && price_arr != []) {
    var menuArray = [name_arr, price_arr, des_arr];
    extractMenuOwner(menuArray);
  }
</script>

</html>