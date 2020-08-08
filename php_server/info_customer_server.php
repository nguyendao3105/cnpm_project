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
function naptien($username, $tien)
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
if (isset($_POST['amount'])) {
	$db = connect_to_db90();
	$amount = intval($_POST['amount']);
	$username = $_POST['username'];
	if ($db != NULL) {
		$current_balance = get_current_balance($username);
		$new_balance = $amount + $current_balance;
		$b = naptien($username, $new_balance);
		if ($b == 1) {
			echo "Nạp tiền thành công";
		} else {
			echo "Nạp tiền thất bại";
		}
	}
}
