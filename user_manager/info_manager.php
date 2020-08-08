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
                            <a href="info_manager.php">Xin chào, <?php echo $username ?>!</a>
                            <div class="solid_left"></div>
                            <form id="logout" action="info_manager.php" method="post">
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
                            <a href="home_manager.php">TRANG CHỦ</a>
                            <a href="report_manager.php">XEM BÁO CÁO</a>
                            <a href="info_manager.php">THÔNG TIN TÀI KHOẢN</a>
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
                    <div class="col-md-12 info-section">
                        <div class="section-header-small">
                            <div class="h3-heading">Tài khoản</div>
                        </div>
                        <div>
                            <!--User name-->
                            <p>Tên tài khoản: <?php echo $row[1]; ?> </p>
                            <p>Loại tài khoản: Quản lí</p>
                            <p>Email: <?php echo $row[2]; ?> </p>
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

</html>