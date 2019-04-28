<?php include('New_server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	 <form method="post" action="New_register.php">
	 	<!--Display valid errors here -->
	 	<?php include('errors.php'); ?>
	 	<div class="input-group">
	 		<label>Username</label>
	 		<input type="text" name="username" maxlength="30" autocomplete="off" value="<?php echo $username;?>">
        </div>
        <div class="input-group">
	 		<label>Email</label>
	 		<input type="text" name="email" maxlength="30" autocomplete="off" value="<?php echo $email;?>">
        </div>
        <div class="input-group">
	 		<label>Mobile Number</label>
	 		<input type="text" name="mobile" maxlength="10" autocomplete="off" >
        </div>
        <div class="input-group">
	 		<label>Select Employee Comapany</label>
	 		<select name="company">
	 			<option>Select</option>
	 			<option>DBPL</option>
	 			<option>SFPL</option>
	 		</select>
	    </div>
        <div class="input-group">
	 		<label>Password</label>
	 		<input type="password" name="password_1" id="pass" maxlength="25">
        </div>
        <div class="input-group">
	 		<label>Confirm Password</label>
	 		<input type="password" name="password_2" id="pass1" maxlength="25">
        </div>
        <input type="checkbox" onclick="myFunction()"><label>Show Password</label>
        <br><br>
        <div class="input-group">
	 		<button type="submit" name="register" class="btn">Register</button>
        </div>
        <p>
        	Already a member? <a href="New_login.php">Sign In</a>
        </p>
	 </form>
     <script type="text/javascript">
	 	function myFunction()
	 	{
	 	  var x = document.getElementById("pass");
	 	  var y = document.getElementById("pass1");
            if (x.type === "password" && y.type=== "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
	    }
	 </script>
</body>
</html>