<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'db');

if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	// ????????????
  $permission = mysqli_real_escape_string($db, $_POST['permission']);
  $code = mysqli_real_escape_string($db, $_POST['code']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
	 if (empty($permission)) { array_push($errors, "Permission is required"); }
  }
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  // ?????????
    if( $permission === "1"){
		if($code != "True_Cook"){
			array_push($errors, "Something went wrong");
		}
	}
	if( $permission === "2"){
		if($code != "True_IT"){
			array_push($errors, "Something went wrong");
		}
	}
	if( $permission === "3"){
		if($code != "True_Vendor"){
			array_push($errors, "Something went wrong");
		}
	}
	if( $permission === "4"){
		if($code != "True_Manager"){
			array_push($errors, "Something went wrong");
		}
	}

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, email, password,permission) 
  			  VALUES('$username', '$email', '$password','$permission')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in"; 
      if($permission === "9"){
      header('location: ../signin_21/home_customer.php');}
       if($permission === "1"){
      header('location: ../signin_21/home_cook.php');} 
      if($permission === "2"){
      header('location: ../signin_21/home_it.php');} 
      if($permission === "3"){
      header('location: ../signin_21/home_ower.php');} 
      if($permission === "4"){
      header('location: ../signin_21/home_manager.php');}
      else{array_push($errors, "Something went wrong");}
  }
}
// ... 
// LOGIN USER


//Day la phan login ne 
  if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) === 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      $row = mysqli_fetch_assoc($results);
      $permission = $row['permission'];
      if($permission === "9"){
      header('location: ../signin_21/home_customer.php');}
       if($permission === "1"){
      header('location: ../signin_21/home_cook.php');} 
      if($permission === "2"){
      header('location: ../signin_21/home_it.php');} 
      if($permission === "3"){
      header('location: ../signin_21/home_ower.php');} 
      if($permission === "4"){
      header('location: ../signin_21/home_manager.php');}
      else{array_push($errors, "Something went wrong");}
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
  
}


  if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../signup_21/index.html");
  }