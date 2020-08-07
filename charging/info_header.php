<?php
function connect_to_db90()
  {
    $db =  mysqli_connect('localhost', 'root', '', 'db');
    if(!$db) {echo "Server is dead"; return NULL;}
    return $db;  
  }
function get_cus_info($username)
{
	$db = connect_to_db90();
	if($db != NULL)
	{
		$out = array();
		$query = "SELECT id,username,email,balance FROM user WHERE username = '$username' LIMIT 1";
		$result = mysqli_query($db,$query);
		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);
			array_push($out, $row['id']);
			array_push($out, $row['username']);
			array_push($out, $row['email']);
			array_push($out, $row['balance']);
			return $out;
		}
	}
	return 0;
}
?>