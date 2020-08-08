<?php
function connect_to_db90()
{
	$db =  mysqli_connect('localhost', 'root', '', 'db');
	if (!$db) {
		echo "Server is dead";
		return NULL;
	}
	return $db;
}
function get_current_balance($username)
{
	$db = connect_to_db90();
	if ($db != NULL) {
		$out = 0;
		$query = "SELECT balance FROM user WHERE username = '$username' LIMIT 1";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$out = intval($row['balance']);
			return $out;
		}
	}
	return 0;
}
function trutien($username, $tien)
{
	$db = connect_to_db90();
	if ($db != NULL) {
		$out = 0;
		$query = "UPDATE user
		SET balance = $tien
		WHERE username = '$username'";
		if (mysqli_query($db, $query)) {
			return 1;
		}
	}
	return 0;
}
if (isset($_POST['userr'])) {
	$db = connect_to_db90();
	$username = $_POST['userr'];
	$amount1 = intval($_POST['total']);
	if ($db != NULL) {
		$current_balance = get_current_balance($username);
		$new_balance = $current_balance - $amount1;
		if ($new_balance > 0) {
			$b = trutien($username, $new_balance);
			if ($b == 1) {
				echo "Thanh toán thành công";
			} else {
				echo "Thanh toán thất bại";
			}
		} else {
			echo "Số dư không đủ";
		}
	}
}
