<?php include('server_Dao.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>

</head>
<body style="background-color: #FFDEAD">
	<img width="60%" height="120%" src="../hinh/123.jpg" align="right" style="margin-top: 0.0%; margin-right: 0%; margin-left: -15%">
	<div style="height: 30.0%; width: 40.0%; margin-left: 0%; margin-top: 0.0%; margin-right: -10%">
		<h1 style="text-align: center"><b> SMART FOOD COURT SYSTEM </b> </h1>
			<h2 style="text-align: center; font-size: 180%"> SIGN UP </h2>
			<form action="signup.php" method="post">
				<?php include('errors.php'); ?>
				<span style="font-size: 120%"> Username:</span> &emsp; &emsp;&emsp;&emsp;<input type="text" name="username" placeholder="Username" style="font-size: 120%"> 
				<br>
				<br>
				<span style="font-size: 120%"> Password: </span> &emsp; &emsp;&emsp;&emsp;&nbsp;<input type="password" name="password_1" placeholder="Your password" style="font-size: 120%">
				<br>
				<br>
				<span style="font-size: 120%"> Email:   &emsp; &emsp;&emsp;&emsp;&nbsp;&nbsp; </span><input type="text" name="email" placeholder="Your email" style="font-size: 120%">
				<br>
				<br>
				<span style="font-size: 120%"> Confirm password: </span><input type="password" name="password_2" placeholder="Your password" style="font-size: 120%">
				<br>
				<br>
				<span style="font-size: 120%"> Permission: </span>
				<br>
				
					<input type="radio" name="permission" value="9" style="font-size: 22%;margin-left: 28%"> a customer
					<br>
					<input type="radio" name="permission" value="1" style="font-size: 22%;margin-left:28%"> a cook
					<br>
					<input type="radio" name="permission"value="2" style="font-size: 22%;margin-left: 28%"> an IT staff
					<br>
					<input type="radio" name="permission" value="3" style="font-size: 22%;margin-left: 28%"> a vendor owner
					<br>
					<input type="radio" name="permission" value="4" style="font-size: 22%;margin-left: 28%"> a manager
					<br>
				
				<br>
				<br>
				<span style="font-size: 120%">  &emsp; &emsp;&emsp;&emsp;Code:&emsp;</span><input type="text" name="code" placeholder="Code" style="font-size: 120%"> 
				<br>
				<span style="font-size: 120%;margin-left:20%; color: red" >  (Skip this step if you are a customer)  </span>
				<br><br>
				<input  type="submit" style="font-size: 120%;margin-left:40% " name="reg_user" value="Sign Up" ></input>
				</form>
				<br>
				<br><br><br>
				<span style="font-size: 120%;margin-left:20%"> Already had an account?</span>
				<button  type="button" style="font-size: 120%"><a href="../signin_21/signin.html">Sign In</a></button>

	</div> 

</body>
</html>