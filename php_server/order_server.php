<?php
include('../php_server/server_Dao.php');
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
} else {
	//$username = "";
	header("location: ../index.php");
}
function connect_to_db99()
{
	$db =  mysqli_connect('localhost', 'root', '', 'db');
	if (!$db) {
		echo "Server is dead";
		return NULL;
	}
	return $db;
}

function get_time()
{
	$db = connect_to_db99();
	$query = "SELECT CURDATE() ";
	$result = mysqli_query($db, $query);
	$time = mysqli_fetch_all($result);
	return $time[0][0];
}
function get_id()
{
	$db = connect_to_db99();
	if ($db != NULL) {
		$query = "SELECT id_order FROM orders ORDER BY id_order ASC";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_all($result);
			$num = intval(count($row));
			/*$max = $row[0];
			for($x = 1; $x < $num; $x++)
			{
				if($row[$x] > $max){$max = $row[$x];}
			}
			return intval($max) + 1;*/
			$out1 = $row[$num - 1][0];
			$out = intval($out1) + 1;
			return $out;
		} else {
			return 1;
		}
	} else {
		return 0;
	}
}
function insert_order($id, $total, $vendor_id, $username, $time)
{
	$db = connect_to_db99();
	if ($db != NULL) {
		$query = "INSERT INTO orders(id_order,cus_name,time,total_order,id_vendor) VALUES ($id,'$username','$time',$total,$vendor_id)";
		if (mysqli_query($db, $query)) {
			return 1;
		}
	}
	return 0;
}
function insert_order_detail($id, $number, $total, $foodname)
{
	$db = connect_to_db99();
	if ($db != NULL) {
		$detail_query =  "INSERT INTO orders_detail(id_order,food_name,quantity,total_food) VALUES ($id,'$foodname',$number,$total)";
		if (mysqli_query($db, $detail_query)) {
			return 1;
		}
	}
	return 0;
}

$error = array();
if (isset($_POST['food'])) {
	$food_array = json_decode($_POST['food']);
	$number_array1 = json_decode($_POST['number']);
	$number_array = array();
	for ($x = 0; $x < count($number_array1); $x++) {
		array_push($number_array, intval($number_array1[$x]));
	}
	$total = intval($_POST['total']);
	$vendor_id = intval($_POST['id_vendor']);
	$id = get_id();
	$time = date(get_time());

	$a = insert_order($id, $total, $vendor_id, $username, $time);
	if ($a == 1) {
		for ($x = 0; $x < count($number_array); $x++) {
			$b = insert_order_detail($id, $number_array[$x], $total, $food_array[$x]);
			if ($b == 0) {
				echo "cannot insert to orders_detail";
				return;
			}
		}
	} else {
		echo json_encode($number_array);
	}
}
