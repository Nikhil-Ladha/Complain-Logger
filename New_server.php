<?php
   session_start();
   $usertype="";
   $username="";
   $email="";
   $mob="";
   $set="You are logged in";
   $company="";
   $errors=array();
   //connect to database
   $db=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');

   //if register button is clicked
   if(isset($_POST['register'])){
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $mob=mysqli_real_escape_string($db,$_POST['mobile']);
    $password_1=mysqli_real_escape_string($db,$_POST['password_1']);
    $password_2=mysqli_real_escape_string($db,$_POST['password_2']);
    $company=$_POST['company'];
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
    if(empty($email))
    {
     array_push($errors,"Email Id is required");
    }
    if(empty($mob))
    {
     array_push($errors,"Mobile Number is required");
    }
    if(empty($password_1))
    {
     array_push($errors," Password is required");
    }
    if($password_1 != $password_2)
    {
     array_push($errors,"The two passwords do not match");
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      array_push($errors,"Only letters and white space allowed"); 
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     array_push($errors,"Invalid email format"); 
    }
    if($company=="Select")
    {
     array_push($errors," Employee Company Name is required");
    }
    $sql1= "SELECT * FROM userdetails WHERE emailid='$email' AND company='$company'";
    $result1=mysqli_query($db,$sql1);
    if(mysqli_num_rows($result1)>0)
    {
     array_push($errors,"Email Id is already registered!");
    }  
    //if there are no errors,save user to database
    if(count($errors)==0){
    $password=md5($password_1);//encryption
    $sql= "INSERT INTO userdetails(username,password,emailid,mobile,company) VALUES ('$username','$password','$email','$mob','$company')";
    if(mysqli_query($db, $sql))
     {
     	echo "Records added successfully!";
     }
     else
     {
     	echo "Error:Could not add records!".mysqli_error($db);
     }
     $_SESSION['username']=$username;
     $_SESSION['success']=$set;
     $_SESSION['email']=$email;
     $_SESSION['mobile']=$mob;
     $_SESSION['company']=$company;
     header('location: New_index.php');
     //header("location: New_index.php?email=".$email."&mobile=" .$mob."");
   }
  }

  //log user in from login page
  if(isset($_POST['login'])){
     $usertype=$_POST['usertype'];
     if($usertype=="Admin"){
  	 $username=mysqli_real_escape_string($db,$_POST['username']);
     $password=mysqli_real_escape_string($db,$_POST['password']);
     $email=mysqli_real_escape_string($db,$_POST['email']);
     
       
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
     
    if(empty($password))
    {
     array_push($errors,"Password is required");
    }
    if(empty($password))
    {
     array_push($errors,"Password is required");
    }
     if(empty($email))
    {
     array_push($errors,"Email Id is required");
    }
    /*if($company=="Select")
    {
     array_push($errors,"Select the Company Name");
    }*/

    if(count($errors)==0){
    	$password=md5($password);//encryption
    	$query= "SELECT * FROM admindetails WHERE username='$username' AND password='$password' AND emailid='$email'"; //AND company='$company'";
    	$result = mysqli_query($db,$query);
    	if(mysqli_num_rows($result)>0){
    		//log user in
    		    $_SESSION['username']=$username;
            $_SESSION['success']=$set;
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
     $email=mysqli_real_escape_string($db,$_POST['email']);
     $company=mysqli_real_escape_string($db,$_POST['company']);
       
    //ensure that the form is filled completely
    if(empty($username))
    {
     array_push($errors,"Username is required");
    }
     
    if(empty($password))
    {
     array_push($errors,"Password is required");
    }
    if(empty($email))
    {
     array_push($errors,"Email Id is required");
    }
    if($company=="Select")
    {
     array_push($errors,"Select the Company Name");
    }
       
    if(count($errors)==0){
      $password=md5($password);//encryption
      $query= "SELECT * FROM userdetails WHERE username='$username' AND password='$password' AND emailid='$email' AND company='$company'";
      $result = mysqli_query($db,$query);
      if(mysqli_num_rows($result)>0){
         //log user in
          if($row=$result->fetch_assoc()){
            $_SESSION['username']=$username;
            $_SESSION['success']=$set;
            $_SESSION['email']=$row['emailid'];
            $_SESSION['mobile']=$row['mobile'];
            $_SESSION['company']=$row['company'];
     
            header('location: New_index.php');
           }
        }
        else{
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
    unset($_SESSION['success']);
  	header('location:New_login.php');
  }
 ?>