<?php include('New_server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
	<div>
		<h2 class="header">Login</h2>
	</div>
	 <form method="post" action="New_login.php">
	 	<!--Display valid errors here -->
	 	<?php include('errors.php'); ?>
	 	<div class="input-group">
	 		<label>Select User Type</label>
	 		<select name="usertype">
	 			<option>Select User</option>
	 			<option>Admin</option>
	 			<option>User</option>
	 		</select>

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
	 		<label>Username</label>
	 		<input type="text" name="username" maxlength="15" autocomplete="off">
        </div>
        <div class="input-group">
	 		<label>Email Id</label>
	 		<input type="text" name="email" maxlength="30" autocomplete="off">
        </div>
        <div class="input-group">
	 		<label>Password</label>
	 		<input type="password" name="password" id="pass" maxlength="25">
        </div>
        <input type="checkbox" onclick="myFunction()"><label>Show Password</label>
        <br><br>
        <div class="input-group">
	 		<button type="submit" name="login" class="btn">Sign In</button>
        </div>
        <p>
        	Not Yet a Member? <a href="New_register.php">Sign Up</a>
        </p>
	 </form>
	 <script type="text/javascript">
	 	function myFunction()
	 	{
	 	  var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
	    }
	 </script>

</body>
</html>