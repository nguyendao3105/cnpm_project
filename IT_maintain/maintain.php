<?php
include('maintain-server.php');
if(isset($_SESSION['username'])) {$username = $_SESSION['username'];}
else {$username = "Hoang";}
?>
<!DOCTYPE html>
<html>
<html lang="en">
  <head>
    <title>Bảo trì</title>
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
                <a href="index.html">TRANG CHỦ</a>
				<a href="maintain.php">BẢO TRÌ</a>
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
          <div class="row overlay-white">
            <div class="col-md-6 info-section">
				<form action="maintain-server.php" method="post">
				<input type="submit" name="cd_hoatdong" value="Chế độ hoạt động" ></input>
				<input type="submit" name="cd_baotri" value="Chế độ bảo trì" ></input>
				</form>
            </div>
          </div>
        </div>
      </div>
    </main>
</body>
</html>

