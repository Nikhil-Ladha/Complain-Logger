<?php include('Ne_server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Complaint Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
	<div>
		<h2 style="text-align: center;">Register</h2>
	</div>
	 <form method="post" action="Ne_reg.php">
	 	<!--Display valid errors here -->
	 	<?php include('errors.php'); ?>
	 	<div>
	 		<label>Username</label>
	 		<input type="text" name="username" maxlength="15" autocomplete="off" value="<?php echo $username;?>">
        </div>
        <div>
	 		<label>Email</label>
	 		<input type="text" name="email" maxlength="25" autocomplete="off" value="<?php echo $email;?>">
        </div>
        <div>
	 		<label>Password</label>
	 		<input type="password" name="password_1" maxlength="25">
        </div>
        <div>
	 		<label>Confirm Password</label>
	 		<input type="password" name="password_2" maxlength="25">
        </div><br>
        <div>
	 		<button type="submit" name="register">Register</button>
        </div>
        <p>
        	Already a member? <a href="New_login.php">Sign In</a>
        </p>
	 </form>

</body>
</html>