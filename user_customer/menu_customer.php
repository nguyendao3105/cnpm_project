<?php include('../php_server/server_Dao.php'); ?>
<?php
//session_start();
include('../php_header/order_header.php');
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
/*
echo "count id_array";
echo count($id_array);
echo ".............";*/ // Comment
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
/*
for ($x = 0; $x < count($food_info_array); $x++) {
    
    echo "Vendor";
    echo $x + 1;
    echo ":";
    for ($y = 0; $y < $length_food_info_array[$x]; $y++) {
        echo $food_info_array[$x][$y][1];
    }
    echo "<br>";
}*/
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    //$username = "";
    header("location: ../index.php");
}
$thefuck = array();
array_push($thefuck, $username);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đặt món</title>
    <meta charset="utf-8" />
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
                            <form id="logout" action="menu_customer.php" method="post">
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
    <main class="food-bg">
        <div id="order-section">
            <div class="container">
                <div class="section-header">
                    <div class="h2-heading">
                        ĐẶT MÓN
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <!--Category-->
                        <div class="category-container">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <!--Menu-->
                        <div class="food-container">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--Cart-->
                        <div class="order-cart-container">
                            <div class="cart-items"></div>
                            <div class="cart-total">
                                <strong class="cart-total-title">Tổng cộng</strong>
                                <span class="cart-total-price"></span>
                            </div>
                            <button class="btn1 btn-purchase" type="button">THANH TOÁN</button>
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
<!--Navbar script must be placed after body-->
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/navbar.js"></script>
<script src="../js/currency.js"></script>
<script src="../js/modal.js"></script>
<script src="../js/foods.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--//fix here -->
<script type="text/javascript">
    var vendor_id_array = <?php echo json_encode($id_array); ?>;
    var vendor_name_array = <?php echo json_encode($vendor_name); ?>;
    //process category-container
    var category = document.getElementsByClassName("category-container")[0];
    for (i = 0; i < vendor_name_array.length; i++) {
        var vender_name = document.createElement("div");
        vender_name.setAttribute("class", "vender-header");
        vender_name.innerHTML = `<a href="#v${vendor_id_array[i]}">${vendor_name_array[i]}</a>`;
        category.append(vender_name);
    }
    // !!! Hidden
    var user_arrr = <?php echo json_encode($thefuck) ?>;
    var username = user_arrr[0];
    var dmm = document.createElement('div');
    dmm.setAttribute("class", "username");
    dmm.style.visibility = "hidden";
    dmm.innerHTML = username;
    category.append(dmm);
    // !!! End hidden
    //process section-header
    var food_table = <?php echo json_encode($food_info_array); ?>;
    var fcategory = document.getElementsByClassName("food-container")[0];
    for (i = 0; i < vendor_id_array.length; i++) {
        // Firstly, create a vender container
        var venderContainer = document.createElement('div');
        venderContainer.setAttribute('id', `v${vendor_id_array[i]}`);
        venderContainer.setAttribute('class', 'vender-container');
        //Header
        var vender_name = document.createElement('div');
        vender_name.setAttribute("class", "vender-header");
        vender_name.setAttribute("id", `v${vendor_id_array[i]}`);
        vender_name.innerHTML = vendor_name_array[i];
        venderContainer.append(vender_name);
        // !!! Hidden
        var in_vendor_class = document.createElement('div');
        in_vendor_class.setAttribute("class", "vendor_id");
        in_vendor_class.style.visibility = "hidden";
        in_vendor_class.innerHTML = vendor_id_array[i];
        vender_name.append(in_vendor_class);
        // !!! End hidden
        //Food Items
        var ex_fc_food_items = document.createElement("div");
        ex_fc_food_items.setAttribute("class", "food-items");
        for (j = 0; j < food_table[i].length; j++) {

            /*
            var ex_fc_food_item = `
                <div class="food-item">
                    <img
                    class="food-item-image"
                    src="${food_table[i][j][5]}"
                    alt="${food_table[i][j][1]}"
                    />
                    <div class="food-item-details">
                        <div class="food-item-title">${food_table[i][j][1]}</div>
                        <div class="food-item-descriptions">${food_table[i][j][4]}</div>
                        <div class="food-item-order">
                            <span class="food-item-price">${formatMoney.format(getFloatMoneyComma(food_table[i][j][2]))}</span>
                            <button class="btn1 food-item-button" type="button">THÊM</button>
                        </div>
                    </div>
                </div>`;*/
            var ex_fc_food_item = document.createElement("div");
            ex_fc_food_item.setAttribute("class", "food-item");

            var _food_img = document.createElement("img");
            _food_img.setAttribute("class", "food-item-image");
            _food_img.setAttribute("src", `${food_table[i][j][5]}`);
            _food_img.setAttribute("alt", `${food_table[i][j][1]}`);
            var _food_item_details = document.createElement("div");
            _food_item_details.setAttribute("class", "food-item-details");

            var __food_item_title = document.createElement("div");
            __food_item_title.setAttribute("class", "food-item-title");
            __food_item_title.innerHTML = `${food_table[i][j][1]}`;
            var __food_item_des = document.createElement("div");
            __food_item_des.setAttribute("class", "food-item-description");
            __food_item_des.innerHTML = `${food_table[i][j][4]}`;
            var __food_item_order = document.createElement("div");
            __food_item_order.setAttribute("class", "food-item-order");

            var ___food_item_price = document.createElement("div");
            ___food_item_price.setAttribute("class", "food-item-price");
            ___food_item_price.innerHTML = `${formatMoney.format(getFloatMoneyComma(food_table[i][j][2]))}`;

            // Append price
            __food_item_order.append(___food_item_price)

            // Append add button 
            // If not available 
            if (food_table[i][j][0] == 0) {
                ex_fc_food_item.setAttribute("disabled", "");
                var ___food_item_ooo = document.createElement("div")
                ___food_item_ooo.setAttribute("class", "color-red");
                ___food_item_ooo.setAttribute("style", "padding: 8px 16px;");
                ___food_item_ooo.innerHTML = `HẾT HÀNG`;
                __food_item_order.append(___food_item_ooo);
            } else {
                var ___food_item_btn_add = document.createElement("button");
                ___food_item_btn_add.setAttribute("class", "btn1 food-item-button");
                ___food_item_btn_add.setAttribute("type", "button");
                ___food_item_btn_add.innerHTML = "THÊM";
                __food_item_order.append(___food_item_btn_add);
            }
            // Append the rest
            _food_item_details.append(__food_item_title, __food_item_des, __food_item_order);
            ex_fc_food_item.append(_food_img, _food_item_details);
            ex_fc_food_items.append(ex_fc_food_item);
            venderContainer.append(ex_fc_food_items);
        }
        fcategory.append(venderContainer);
    }

    // Modalllllllllllllllllllllllllllll
    //!! Note: U must include "modal.js"
    // Confirm modal
    function confirmModal() {
        openModal(); // in "modal.js"
        var modalBody = document.getElementById("modal-body");
        alert("Hello");
    }
</script>

</html>