<?php
include('../signup_21/process_server.php');
	//Lay data tu db "orders"
		function get_order_table() //test done
		{
			$db = connect_to_db();
			if($db != NULL)
			{
				$query = "SELECT * FROM orders ORDER BY id_order ASC";
				$result = mysqli_query($db,$query);
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		return $row;
            		}
            	else return 0;
            }
            else return 0;
		}
		function get_order_id_array() //test done
		{
			$table = get_order_table();
			if($table!= 0)
			{
				$result = array();
				for($x = 0; $x < count($table);$x++)
				{
					array_push($result,$table[$x][0]);
				}
				return $result;
			}
			return 0;
		}
		function get_cusname_array()//done
		{
			$table = get_order_table();
			if($table!= 0)
			{
				$result = array();
				for($x = 0; $x < count($table);$x++)
				{
					array_push($result,$table[$x][1]);
				}
				return $result;
			}
			return 0;
		}
		function get_cusname_by_Id($id)
		{
			$id_array = get_order_table();
			$name_array = get_cusname_array();
			if($id_array != 0)
			{
				for($x = 0; $x < count($id_array);$x++)
				{
					if(intval($id_array[$x]) == $id) {return $name_array[$x];} //Deo hieu sao mang tra ve la mang string
				}
				return "Id doesn't exist";
			}
			return "Some thing went wrong";
		}
		function get_all_id_by_cusname($name)
		{
			$db = connect_to_db();
			if($db != NULL)
			{
				$out = array();
				$query = "SELECT id_order FROM orders WHERE cus_name = '$name'";
				$result = mysqli_query($db,$query);
				if($result != FALSE){
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		for($x = 0; $x < mysqli_num_rows($result); $x++)
               		{
               			array_push($out,$row[$x][0]);
               		}
               		return $out;
            	}
            	}
            	   	else return 444;
            }
            return 0;
		}
		function get_vendor_id_by_order_id($id)
		{
			$db = connect_to_db();
			$out = array();
			if($db != NULL)
			{
				$query = "SELECT id_vendor FROM orders WHERE id_order = $id";
				$result = mysqli_query($db,$query);
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		for($x = 0; $x < mysqli_num_rows($result); $x++)
               		{
               			array_push($out,$row[$x][0]);
               		}
               		return $out;
            	}
            }
            return 0;
		}
		function get_all_order_id_vendor_id_by($id)
		{
			$db = connect_to_db();
			$out = array();
			if($db != NULL)
			{
				$query = "SELECT id_order FROM orders WHERE id_vendor = $id";
				$result = mysqli_query($db,$query);
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		for($x = 0; $x < mysqli_num_rows($result); $x++)
               		{
               			array_push($out,$row[$x][0]);
               		}
               		return $out;
            	}
            }
            return 0;
		}
	//Lay data tu db "orders_detail"
		function get_table_of_food_from_order_id($id)
		{
			$db = connect_to_db();
			$out = array();
			if($db != NULL)
			{
				$query = "SELECT food_name,quantity,total_food FROM orders_detail WHERE id_order = $id";
				$result = mysqli_query($db,$query);
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		for($x = 0; $x < mysqli_num_rows($result); $x++)
               		{
               			array_push($out,$row[$x]);
               		}
               		return $out;
            	}
            }
            return 0;

		}
		function get_total_number_of_food($foodname)
		{
			$db = connect_to_db();
			$out = 0;
			if($db != NULL)
			{
				$query = "SELECT quantity FROM orders_detail WHERE food_name = '$foodname'";
				$result = mysqli_query($db,$query);
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		for($x = 0; $x < mysqli_num_rows($result); $x++)
               		{
               			$out = $out + $row[$x][0];
               		}
               		return $out;
            	}
            }
            return 0;
		}
		function get_total_money_of_food($foodname)
		{
			$db = connect_to_db();
			$out = 0;
			if($db != NULL)
			{
				$query = "SELECT total_food FROM orders_detail WHERE food_name = '$foodname'";
				$result = mysqli_query($db,$query);
				if(mysqli_num_rows($result) > 0){
               		$row = mysqli_fetch_all($result);
               		for($x = 0; $x < mysqli_num_rows($result); $x++)
               		{
               			$out = $out + $row[$x][0];
               		}
               		return $out;
            	}
            }
            return 0;
		}
?>