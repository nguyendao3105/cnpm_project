<?php
function connect_to_db1()
{
    $db =  mysqli_connect('localhost', 'root', '', 'db');
    if (!$db) {
        echo "Server is dead";
        return NULL;
    }
    return $db;
}
function get_vendor_table()
{
    $db = connect_to_db1();
    if ($db != NULL) {
        $query = "SELECT * FROM vendor";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result);
            return $row;
        }
    }
    return 0;
}
function get_vendor_inform_from_id($vendor_id) // Lay thong tin ve 1 quay bang id
{
    $db = connect_to_db1();
    if ($db != NULL) {
        $query = "SELECT vendor_name,owner_name FROM vendor WHERE id_vendor = $vendor_id";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result);

            return $row;
        } else {
            return 0;
        }
    }
    return 0;
}
function get_vendor_food_inform_from_id($vendor_id, &$arr) //Lay thong tin ve cac mon an cua 1 quay bang id
{
    $db = connect_to_db1();
    if ($db != NULL) {
        $query = "SELECT available,foodname,price,id_food,descriptions_food,source_image,id_vendor FROM food WHERE id_vendor = $vendor_id ORDER BY id_food ASC";  //ASC or DESC
        $num = 0;
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $num = mysqli_num_rows($result);
            $arr = array();
            $row = mysqli_fetch_all($result);
            for ($x = 0; $x < $num; $x++) {
                array_push($arr, $row[$x]);
            }
            return $num;
        } else {
            return $num;
        }
    }
}
function get_list_vendor_name() //tra ve [array] la danh sach ten quay hang
{
    $result = array();
    $db = connect_to_db1();
    if ($db != NULL) {
        $row = mysqli_query($db, "SELECT vendor_name FROM vendor ORDER BY id_vendor ASC");
        if (mysqli_num_rows($row) > 0) {
            $q = mysqli_fetch_all($row);
            for ($x = 0; $x < count($q); $x++) {
                array_push($result, $q[$x][0]);
            }
            return $result;
        }
    }
    return 0;
}
function get_list_name_vendor_food($vendor_id) //tra ve [array] la danh sach mon an cua 1 quay hang
{
    $zzz = array(); //ket qua tra ve
    $number = get_vendor_food_inform_from_id($vendor_id, $zzz);
    if ($number != 0) {
        return $zzz;
    } else {
        return 0;
    }
}
