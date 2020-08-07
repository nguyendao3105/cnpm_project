<?php
session_start();
if(isset($_SESSION['username'])) {$username = $_SESSION['username'];}
else {$username = "daoowner";}
//include ('process_server.php');
$errors = array();
include('../signup_21/errors.php');
function connect_to_db21()
  		{
    		$db =  mysqli_connect('localhost', 'root', '', 'db');
    		if(!$db) {echo "Server is dead"; return NULL;}
    		return $db;  
  		}


//Phần đổi tên 

if (isset($_POST['change_name'])) {
	$db = connect_to_db21();
		//$vendorName = mysqli_real_escape_string($db, $_POST['vendorName']);
	if($db != NULL)
	{	
		$vendorName = $_POST['vendorName'];
		if($vendorName == "")
		{
			array_push($errors,"Vui lòng nhập tên");
		}
		else{	
		$query = "UPDATE `vendor` SET `vendor_name`='$vendorName' WHERE `owner_name`= '$username'";
		mysqli_query($db,$query);
		header('location: info-owner.php');
		}
	}
	else {array_push($errors,"Server is dead");}
}
//Phần thêm món
if (isset($_POST['add_food'])) {
	$db = connect_to_db21();
	if($db != NULL)
	{	
	$food_name = $_POST['foodName'];
	$price = intval($_POST['price']);
	$description_food = $_POST['foodDescription'];
	$source_image =$_POST['sourceImage'];
	//  lấy id của vendor để thêm vào bảng food
	if($food_name == "" || $source_image == "" || $description_food =="" || $price =="" || $price < 0)
	{
		array_push($errors,"Vui lòng nhập đúng thông tin");
	}
	else{
		$user_check_query = "SELECT * FROM food WHERE foodname='$food_name' LIMIT 1";
  		$result1 = mysqli_query($db, $user_check_query);
  		$user = mysqli_fetch_assoc($result1);
  
  		if ($user) { // if user exists
    	if ($user['foodname'] === $food_name) {
      		array_push($errors, "Tên món ăn này đã tồn tại");
    	}
    	}
		else{
		$query = "SELECT id_vendor FROM vendor WHERE owner_name='$username'";
		$result = mysqli_query($db, $query);
		$id_vendors = mysqli_fetch_assoc($result);
		$id_vendor 	= $id_vendors['id_vendor'];
		$query1 = "INSERT INTO food (available, foodname, price,
		id_food, id_vendor,descriptions_food, source_image) VALUES 
			( b'1' ,'$food_name','$price','',$id_vendor,'$description_food','$source_image')";
		mysqli_query($db,$query1);
		header('location: menu-owner.php');
		}
	}
	}else{array_push($errors,"Server is dead");}
}
if(isset($_POST['removefood']))
{
	$foodname = $_POST['food_name'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$db = connect_to_db21();
	if($db != NULL)
	{
		$query = "DELETE FROM `food` WHERE `foodname`='$foodname' AND descriptions_food = '$description'";
			$result = mysqli_query($db, $query);
				if($result)
				{
					echo "Success";		
				}
				else { echo "Cannot fetch data";}
	}
	else {echo "Server id dead";}
}
?>