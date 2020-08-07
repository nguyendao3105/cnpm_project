<?php include('../signup_21/server_Dao.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>SIGN IN</title>
	<meta charset="utf-8">
	<style type="text/css">
		* {
   			font-family: myFirstFont;
		}
	</style>

</head>
<body style="background-color: #FFDEAD;">	
	<img width="60%" height="160%" src="../hinh/123.jpg" align="right" style="margin-top: -3.0%; margin-right: 0%; margin-left: -15%">
	<div style="height: 30.0%; width: 40.0%; margin-left: 0%; margin-top: 8.0%; margin-right: -10%;">
		<h1 style="text-align: center"><b> SMART FOOD COURT SYSTEM </b> </h1>
			<h2 style="text-align: center; font-size: 180%"> SIGN IN </h2>
			<form action="signin_php.php" method="post">
				<?php include('../signup_21/errors.php'); ?>
				<span style="font-size: 120%;margin-left: 10%;"> Username: </span><input type="text" name="username" placeholder="Username" style="font-size: 120%">
				<br>
				<br>
				<span style="font-size: 120%;margin-left: 10%;"> Password: </span><input type="password" name="password" placeholder="Your password" style="font-size: 120%">
				<br>
				<br>
				<input type="submit" style="font-size: 120%;margin-left:40% " name="login_user" value="Login"></button>
			</form>
				
				<br><br>
				<span  style="margin-left: 25%; font-size: 22px;"> Sign in with </span> &nbsp;
				<img src="../hinh/Google-icon.jpg" width="4%" align="center"><br><br>
				<span style="font-size: 120%;margin-left: 15%;"> Haven't had an account?</span>
				<button type="button" style="font-size: 120%"><a href="../signup_21/signup.php">Sign Up</a></button>
	</div> 

</body>
</html>