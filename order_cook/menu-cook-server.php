<?php
	function connect_to_db99()
	{
		$db =  mysqli_connect('localhost', 'root', '', 'db');
		if(!$db) {echo "Server is dead"; return NULL;}
		return $db;  
	}
	
	function changeAvailable($food_name){
		$db = connect_to_db99();
		if($db != NULL)
		{
			$query = "SELECT available FROM `food` WHERE `foodname`='$food_name'";
			$result = mysqli_query($db, $query);
				if($result)
				{
					$row = mysqli_fetch_assoc($result);
					$available = $row['available'];
					if($available === b'1'){
						$query1 = "UPDATE `food` SET `available`=b'0' WHERE `foodname`= '$food_name'";
					}else{
						$query1 = "UPDATE `food` SET `available`=b'1' WHERE `foodname`= '$food_name'";
					}	
					mysqli_query($db,$query1);
				return 99;					
				}
				else {return 0;}
		}
		return 1;
	}
	if(isset($_POST['send']))
	{
	$food = json_decode($_POST['send']);
	$food_name = $food[0];
	$a = changeAvailable($food_name);
	if($a == 0) echo $food_name;
	else {if($a == 1) echo "DB dead";
			else echo "Success";
	}
	}
	else {echo "Something went wrong!";}
?>