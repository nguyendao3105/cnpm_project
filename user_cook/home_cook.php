<?php include('../php_server/server_Dao.php') ?>
<?php if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    //$username = "";
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang chủ - Đầu bếp</title>
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
                            <form id="logout" action="home_cook.php" method="post">
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
    <main class="home-slide-bg">
        <div id="welcome">
            <div class="container">
                <div class="row overlay-white">
                    <div class="col-md-12">
                        <div class="section-header">
                            <div class="h2-heading">
                                Welcome to BK Food Court!
                            </div>
                        </div>
                        <p>
                            Địa chỉ: 268 Lý Thường Kiệt, phường 14, quận 10, thành phố Hồ
                            Chí Minh
                        </p>
                        <p>
                            Thời gian hoạt động:
                            <br />
                            - Thứ hai - thứ sáu : 7:00 - 22:00
                            <br />
                            - Thứ bảy, Chủ nhật : 7:00 - 23:00
                        </p>
                        <p>
                            Mô tả: Gian hàng ĐĐNHT cung cấp dịch vụ đồ ăn bao gồm cả bữa
                            sáng, bữa trưa và cả buổi tối. Với nguồn nguyên liệu chọn lọc
                            được lựa chọn kĩ lưỡng từ các chuyên gia thực phẩm hàng đầu thế
                            giới. ĐĐNHT đảm bảo sẽ mang đến cho quý khách sự hài lòng về cả
                            không gian, chất lượng thực phẩm, thái độ phục vụ, ... để quý
                            khách có trải nghiệm tốt nhất.
                        </p>
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