<?php
function connect_to_db99()
{
	$db =  mysqli_connect('localhost', 'root', '', 'db');
	if (!$db) {
		echo "Server is dead";
		return NULL;
	}
	return $db;
}

function changeAvailable($food_name)
{
	$db = connect_to_db99();
	if ($db != NULL) {
		$query = "SELECT available FROM `food` WHERE `foodname`='$food_name'";
		$result = mysqli_query($db, $query);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$available = $row['available'];
			if ($available === b'1') {
				$query1 = "UPDATE `food` SET `available`=b'0' WHERE `foodname`= '$food_name'";
			} else {
				$query1 = "UPDATE `food` SET `available`=b'1' WHERE `foodname`= '$food_name'";
			}
			mysqli_query($db, $query1);
			return 99;
		} else {
			return 0;
		}
	}
	return 1;
}


/// Hoàn tiền nếu đầu bếp từ chối
function refund($id_order)
{
	$db = connect_to_db99();
	if ($db != NULL) {
		$query_order = "SELECT cus_name, total_order FROM `orders` WHERE `id_order`='$id_order'";
		$result_order = mysqli_query($db, $query_order);
		if ($result_order) {
			$row_orders = mysqli_fetch_assoc($result_order);
			$cus_name = $row_orders['cus_name'];
			$total = $row_orders['total_order'];
			// Update balance
			$query_info = "SELECT id,username,email,balance FROM user WHERE username = '$cus_name'";
			$result_info = mysqli_query($db, $query_info);
			if (mysqli_num_rows($result_info) > 0) {
				$row_info = mysqli_fetch_assoc($result_info);
				$balance = $row_info['balance'];
				// Refund
				$new_balance = $balance + $total;
				$query_balance = "UPDATE `user` SET `balance`='$new_balance' WHERE `username`= '$cus_name'";
				mysqli_query($db, $query_balance);
			}
		}
	}
	return 0;
}

if (isset($_POST['send'])) {
	$food = json_decode($_POST['send']);
	$food_name = $food[0];
	$a = changeAvailable($food_name);
	if ($a == 0) echo $food_name;
	else {
		if ($a == 1) echo "DB dead";
		else echo "Success";
	}
}
//Phần xử lí 2 nút của đầu bếp
if (isset($_POST['request'])) {
	$db = connect_to_db99();
	if ($db != NULL) {
		//1. kiểm tra request
		if ($_POST['request'] == "sansang") {
			$id_order = intval($_POST['id_order']);
			$query = "UPDATE orders SET order_state = 1 WHERE id_order = $id_order";
			if (mysqli_query($db, $query)) {
				echo $id_order; //"Success sansang";
			} else echo "Update sansang failed";
		} else if ($_POST['request'] == "tuchoi") {
			$id_order = intval($_POST['id_order']);
			$query = "UPDATE orders SET order_state = 2 WHERE id_order = $id_order";
			if (mysqli_query($db, $query)) {
				echo "Success tuchoi";
				// Từ chối thành công sẽ hoàn tiền
				refund($id_order);
			} else echo "Update tu choi failed";
		} else {
			echo "Unknown request";
		}
	} else echo "Server is dead";
}
