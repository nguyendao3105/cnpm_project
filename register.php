<?php include('server.php') ?>

<!DOCTYPE html>
<html>

<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	
	<div class="input-group">
  	  <label>Permission</label>
  	  
  	</div>
	<p> 			<input type="checkbox" name="permission" value= "0"> a customer
					<input type="checkbox" name="permission" value= "1" > a cook
					<input type="checkbox" name="permission" value= "2"> a IT staff
					<br>
					<input type="checkbox" name="permission" value= "3"> a vendor owner
					<input type="checkbox" name="permission" value= "4"> a manager
	</p>
	<div class="input-group">
		<label>Code</label>
		<input type="text" name="code" >
	</div>
	
	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>