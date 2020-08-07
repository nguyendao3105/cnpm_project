<?php
	$db =  mysqli_connect('localhost', 'root', '', 'db');
	if (isset($_POST['cd_hoatdong'])) {
	//$vendorName = mysqli_real_escape_string($db, $_POST['vendorName']);
		$query = "UPDATE `state_sys` SET `value`= b'0' WHERE `state`= 'maintaining'";
		mysqli_query($db,$query);
		header('location: maintain.php');
	}
	if (isset($_POST['cd_baotri'])) {
	//$vendorName = mysqli_real_escape_string($db, $_POST['vendorName']);
		$query = "UPDATE `state_sys` SET `value`= b'1' WHERE `state`= 'maintaining'";
		mysqli_query($db,$query);
		header('location: maintain.php');
	}
?>