<?php
  include('../order_customer/order_header.php');
  include('report_header.php'); 
  session_start();
  if(isset($_SESSION['username'])) {$username = $_SESSION['username'];}
  else{$username = "daoowner";}
  //----------------------------------------test
 /* $aa = get_order_id_array();
  if($aa != 0)
  {
    for($x = 0; $x < count($aa); $x++)
    {
      echo $aa[$x];
    }
  }
  else echo "Cc";
  echo "<br>";
  $a = get_cusname_array();
  if($a != 0)
  {
    for($x = 0; $x < count($a); $x++)
    {
      echo $a[$x];
    }
  }
  else echo "Cc";
  echo "<br>";
  $b = get_cusname_by_id(1);
  echo $b;
  echo "<br>";
  $c = get_all_id_by_cusname("Dao");
  if($c != 444)
  {
    if($c != 0)
    {
      for($x = 0; $x < count($c); $x++)
        {
          echo "ID:";
          echo $c[$x];
        }
    }
  } else {echo "Some thing happen!";}
  echo "<br>";
  $ven_id = get_vendor_id_by_order_id(1);
  if($ven_id != 0)
  {
    for($x = 0; $x < count($ven_id); $x++)
    {
    echo $ven_id[$x];
    }
  }*/
  $vendor_name_arr = get_list_vendor_name();
   //list vendor-id
        $vendor_table = get_vendor_table();
        if($vendor_table != 0){
        $id_array = array();
                    //echo "\n       id:       ";
        for($x = 0; $x < count($vendor_table); $x++)
        {
            array_push($id_array, $vendor_table[$x][0]);
        }
                    /*for($x = 0; $x < count($vendor_table); $x++)
                    {
                     echo $id_array[$x];
                    }*/
        }
        else {array_push($error, "Something went wrong");}
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
                <a href="info-manager.html">Xin chào, <?php echo $username ?>!</a>
                <div class="solid_left"></div>
                <a href="index.html">Đăng xuất</a>
              </div>
              <div class="logo_nav_con">
                SMART FOOD COURT SYSTEM
              </div>
              <div class="bottom_nav_con">
                <a href="home-manager.html">TRANG CHỦ</a>
                <a href="report-manager.html">XEM BÁO CÁO</a>
                <a href="info-manager.html">THÔNG TIN TÀI KHOẢN</a>
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
      <div id="report-manager">
        <div class="container">
          <div class="section-header">
            <div class="h2-heading">
              XEM BÁO CÁO
            </div>
          </div>

          <div class="row overlay-white">
            <!--Filter-->
            <div class="report-filter">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-header-small">
                  <div class="h3-heading">
                    Tìm kiếm
                  </div>
                </div>
              </div>
              <form action ="report-manager.php">
                <div class="col-md-2 col-sm-3 col-xs-4">
                  <label for="vender">Báo cáo của</label>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-8">
                  <select id="select_vendor" name="vendor">
                    <option value="999">Tất cả các gian hàng</option>
                  </select>
                </div>
                <!--Starting date-->
                <div class="col-md-2 col-sm-3 col-xs-4">
                  <label for="startingDate">Ngày bắt đầu</label>
                </div>
                <div class="col-md-4 col-sm-9 col-xs-8">
                  <input type="date" name="start_day" id="start_day" />
                </div>
                <!--Ending date-->
                <div class="col-md-2 col-sm-3 col-xs-4">
                  <label for="endingDate">Ngày kết thúc</label>
                </div>
                <div class="col-md-4 col-sm-9 col-xs-8">
                  <input type="date" name="end_day" id="end_day" />
                </div>
                <!--Submiss button
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input id="submit-manager" type="submit" value="Tìm kiếm" name="search"/>
                </div>-->
              </form>
            </div>
            <!--Result-->
            <div class="report-result">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-header-small">
                  <div class="h3-heading">
                    Kết quả
                  </div>
                </div>
                <table class="table table-section table-hover">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Món ăn</th>
                      <th>Số lượng</th>
                      <th id="color-red">Tổng tiền</th>
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
  <script src="../js/report.js"></script>
    <script type="text/javascript">
    //Get JS variable
    var total = [];
          var      quantity = [];
             var   food = [];
    function update()
    {
      var ret = updateFunction();
                console.log(ret[0][1]);
                //alert(ret[0][1][0][2]);
                //alert("wait");
                for(i = 0; i < ret[0].length; i++)
                {
                  for(j = 0; j < ret[0][i].length; j++)
                  {
                    total.push(ret[0][i][j][3]);
                    quantity.push(ret[0][i][j][2]);
                    food.push(ret[0][i][j][1]);
                  }
                }
               // alert(total);   
      //addItemReport(total,quantity,food); 
     // window.setTimeout(update, 1000*10); 
    }
    update();
    addItemReport(total,quantity,food);  
  </script>
</html>

