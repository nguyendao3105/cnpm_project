<?php 
	include('report_header.php');
	function connect_to_db2()
  		{
    		$db =  mysqli_connect('localhost', 'root', '', 'db');
    		if(!$db) {echo "Server is dead"; return NULL;}
    		return $db;  
  		}
	function get_id_array($selected_vendor,$start_day,$end_day)
	{
		$selected_vendor = intval($selected_vendor);
		$db = connect_to_db2();
		if($db != NULL)
		{
			$out = array();
			$query = "SELECT id_order FROM orders WHERE id_vendor = $selected_vendor AND time >= '$start_day' AND time <= '$end_day'";
			$result = mysqli_query($db,$query);
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_all($result);
				for($x = 0; $x < count($row); $x++)
				{
					array_push($out,$row[$x][0]);
				}
				return $out;
			}
		}
		return 0;
	}
	function get_order_detail($id_order)
	{
		$db = connect_to_db2();
		if($db != NULL)
		{
			$out = array();
			$query = "SELECT * FROM orders_detail WHERE id_order = $id_order";
			$result = mysqli_query($db,$query);
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_all($result);
				for($x = 0; $x < count($row); $x++)
				{
					array_push($out,$row[$x]);
				}
				return $out;
			}
		}
		return 0;
	}
	function get_all_id($start_day,$end_day)
	{
		$db = connect_to_db2();
		if($db != NULL)
		{
			$out = array();
			$query = "SELECT id_order FROM orders WHERE time >= '$start_day' AND time <= '$end_day'";
			$result = mysqli_query($db,$query);
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_all($result);
				for($x = 0; $x < count($row); $x++)
				{
					array_push($out,$row[$x][0]);
				}
				return $out;
			}
		}
		return 0;
	}
	if(isset($_POST['selected_vendor']))
	{
		$selected_vendor = intval($_POST['selected_vendor']);
		$start_day = $_POST['start_day'];
		$end_day = $_POST['end_day'];
		if($start_day == ""){$start_day = date("0000-00-00");} else {$start_day = date($start_day);}
		if($end_day == ""){$end_day = date("9999-12-31");} else {$end_day = date($end_day);}
		//get id array
		$result = array();
		if($selected_vendor != 999)
		{
			$id_array = get_id_array($selected_vendor,$start_day,$end_day);
			if($id_array != 0)
			{
				for($x = 0; $x < count($id_array); $x++)
				{
					$array_in = get_order_detail($id_array[$x]);
					array_push($result, $array_in);
				}
			}
			else {echo "ID array can't not be fetched";}
			if($result != []){echo json_encode($result);}
			else{echo date("0000-00-00");}
		}
		else
		{
			$result = array();
			$id_array = get_all_id($start_day,$end_day);
			if($id_array != 0)
			{
				for($x = 0; $x < count($id_array); $x++)
				{
					$array_in = get_order_detail($id_array[$x]);
					array_push($result, $array_in);
				}
			}
			else {echo "ID array can't not be fetched";}
			if($result != []){echo json_encode($result);}
			else{echo date("0000-00-00");}
		}
	}
	else
	{
		$result = array("0","0","0");
		echo json_encode($result);
	}
?>