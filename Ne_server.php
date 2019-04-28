<?php
   session_start();
   $usertype="";
   $username="";
   $email="";
   $errors=array();
   //connect to database
   $db=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');

   //if register button is clicked
   if(isset($_POST['register'])){
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password_1=mysqli_real_escape_string($db,$_POST['password_1']);
    $password_2=mysqli_real_escape_string($db,$_POST['password_2']);
    
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
    if(empty($email))
    {
     array_push($errors,"Email Id is required");
    }
    if(empty($password_1))
    {
     array_push($errors," Password is required");
    }
    if($password_1 != $password_2)
    {
     array_push($errors,"The two passwords do not match");
    }

    //if there are no errors,save user to database
    if(count($errors)==0){
    $password=md5($password_1);//encryption
    $sql= "INSERT INTO admindetails(username,emailid,password) VALUES ('$username','$email','$password')";
    if(mysqli_query($db, $sql))
     {
     	echo "Records added successfully!";
     }
     else
     	echo "Error:Could not add records!".mysqli_error($db);
     $_SESSION['username']=$username;
     $_SESSION['success']="You are now logged in!";
     header('location: New_index.php');
   }
  }

  //log user in from login page
  if(isset($_POST['login'])){
     $usertype=$_POST['usertype'];
     if($usertype=="Admin"){
  	 $username=mysqli_real_escape_string($db,$_POST['username']);
     $password=mysqli_real_escape_string($db,$_POST['password']);
       
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
     
    if(empty($password))
    {
     array_push($errors,"Password is required");
    }
    if(count($errors)==0){
    	$password=md5($password);//encryption
    	$query= "SELECT * FROM admindetails WHERE username='$username' AND password='$password'";
    	$result = mysqli_query($db,$query);
    	if(mysqli_num_rows($result)>0){
    		//log user in
    		    $_SESSION['username']=$username;
            $_SESSION['success']="You are now logged in!";
            header('location: new.php');
        }else{
        	 array_push($errors, "Wrong Username/Password Combination");
        }
    }
  }
  else if($usertype=="User")
  {
     $username=mysqli_real_escape_string($db,$_POST['username']);
     $password=mysqli_real_escape_string($db,$_POST['password']);
       
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
     
    if(empty($password))
    {
     array_push($errors,"Password is required");
    }
    if(count($errors)==0){
      $password=md5($password);//encryption
      $query= "SELECT * FROM userdetails WHERE username='$username' AND password='$password'";
      $result = mysqli_query($db,$query);
      if(mysqli_num_rows($result)>0){
        //log user in
            $_SESSION['username']=$username;
            $_SESSION['success']="You are now logged in!";
            header('location: New_index.php');
        }else{
           array_push($errors, "Wrong Username/Password Combination");
        }
    }
  }
  else
  {
    if($usertype=="Select User")
    {
      array_push($errors,"Select User Type");
    } 
    
     /*$username=mysqli_real_escape_string($db,$_POST['username']);
     $password=mysqli_real_escape_string($db,$_POST['password']);
       
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
     
    if(empty($password))
    {
     array_push($errors,"Password is required");
    }
    if(count($errors)==0){
      $password=md5($password);//encryption
      $query= "SELECT * FROM userdetails WHERE username='$username' AND password='$password'";
      $result = mysqli_query($db,$query);
      if(mysqli_num_rows($result)>0){
        //log user in
            $_SESSION['username']=$username;
            $_SESSION['success']="You are now logged in!";
            header('location: New_index.php');
        }else{
           array_push($errors, "Wrong Username/Password Combination");
        }
    }*/ 
  }
}


  //logout
  if(isset($_GET['logout'])){
  	session_destroy();
  	unset($_SESSION['username']);
  	header('location:New_login.php');
  }
 ?>