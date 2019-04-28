<?php
   $name="";
   $mobile="";
   $vemail=$_SESSION['email'];
   $mob=$_SESSION['mobile'];
   $company=$_SESSION['company'];
   $type="";
   $msg="";
   $set="You are logged in";
   $imagetmp="No Image Attached";
   $errors=array();
   //connect to database
   $db_1=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');

   //if register button is clicked
   if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($db_1,$_POST['name']);
   // $mobile=mysqli_real_escape_string($db_1,$_POST['mobile']);
    //$vemail=mysqli_real_escape_string($db_1,$_POST['vemail']);
    //$type=mysqli_real_escape_string($db_1,$_POST['itype']);
    $msg=mysqli_real_escape_string($db_1,$_POST['msg']);

    
    //ensure that the form is filled completely
    if(empty($name))
    {
     array_push($errors,"Name is required");
     echo "<script>alert('Name is required')</script>";
    }
    /*if(empty($mobile))
    {
     array_push($errors,"Mobile Number is required");
    }
    if(empty($vemail))
    {
     array_push($errors,"Email Id is required");
    }*/
    if(empty($_POST['itype']))
    {
     array_push($errors," Issue Type  is required");
     echo "<script>alert('Issue Type is required')</script>";
    }
    else
    {
      $type=$_POST['itype'];
    }
    if(empty($msg))
    {
     array_push($errors,"Issue Details is required");
     echo "<script>alert('Issue Details is required')</script>";
    }
     
     $imagename=$_FILES["myimage"]["name"]; 

    //Get the content of the image and then add slashes to it 
     if(!empty($_FILES['myimage']['tmp_name']))
      {
        $imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));
      }
    //$folder="c:/xampp/htdocs/site_1/uploads/";

    /*if(move_uploaded_file($_FILES["myimage"]["tmp_name"], "$folder".$_FILES["myimage "]["name"]))
      echo "Move success";
    else
       echo "Move not success";
    */
    //if there are no errors,save user to database
    if(count($errors)==0){
    $sql_1= "INSERT INTO formdetails (name,emailid,mobile,company,type,message,imagename,image,isclear,userremarks,chck,attendee,remarks) VALUES ('$name','$vemail','$mob','$company','$type','$msg','$imagename','$imagetmp','','','No','','')";
    if(mysqli_query($db_1, $sql_1))
     {
      /*if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
      // redirect to your login page
      exit();
      }      
      else{
      //$username = $_SESSION['username'];
      $_SESSION['success']="You are logged in";
      //header('location: New_index.php');
      //unset($_SESSION['success']);
      //unset($_SESSION['username']);
      //echo $username;
     // echo "Records Added!";
      header("location: New_index.php");

      // serve the page normally
     }
   }
    else
    {
      echo "Error:Could not add records!".mysqli_error($db_1);
    }*/
    
    $to = "nikhilladha1999@gmail.com"; // this is your Email address
    $from = $vemail; // this is the sender's Email address
    $first_name = $name;
    $subject = "Problem Form submission";
    $subject2 = "Copy of your complain form submission";
    $message = "\nName:" .$first_name . "\n\nMobile Number: " .$mob. "\n\nProblem:" .$_POST['msg'];
    $message2 = "Here is a copy of your message\n " . $first_name . "\n\n" . $_POST['msg'];
   // echo $from;

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    
    echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=New Complain by Employee Name:'.$name.',Mobile Number:'.$mob.',Email Id:'.$vemail.',Problem Type:'.$type.',Problem:'.$msg.'&receivers=8777025869&isflash=0","_blank");
       setTimeout(function(){ myTab.close();},1300);</script>';
     //myTab.close();</script>';
    //echo '<script>close()</script>'; 
    /*if($company=="DBPL")
    {
      echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=New Complain by Employee Name:'.$name.',Mobile Number:'.$mob.',Email Id:'.$vemail.',Problem Type:'.$type.',Problem:'.$msg.'&receivers=8777025869,9831606537,9836077993,7278878745,8017504030,9681453511&isflash=0","_blank");
       setTimeout(function(){ myTab.close();},1500);</script>';
    }
    else
    {
      echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=New Complain by Employee Name:'.$name.',Mobile Number:'.$mob.',Email Id:'.$vemail.',Problem Type:'.$type.',Problem:'.$msg.'&receivers=8777025869,9831606537,8017981523,8017981520&isflash=0","_blank");
       setTimeout(function(){ myTab.close();},1500);</script>';
    }*/
    //echo 'window.close()</script>';
    //echo "<script>window.open('http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=ADITEK&message=Hello, Welcome to New SMS Service&receivers=8777025869,9831606537,9836077993&isflash=0')</script>";
    /*if(count($errors)==0)
    {
      header("location: http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Complain Message By Employee Name:$name,Email Id:$vemail,Mobile Number:$mob,Problem:$msg&receivers=8777025869&isflash=0");
      //exit();
    }*/
    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
      // redirect to your login page
        header('location: New_login.php');
      exit();
      }      
    else{
          $username = $_SESSION['username'];
          //header('location: New_index.php');
          //header('location: http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Hello, Welcome to New SMS Service&receivers=8777025869&isflash=0');
        //header('location: New_index.php');
          echo '<script>setTimeout(function(){window.open("http://localhost:81/Complain_Logger/New_index.php","_self");},1800)</script>';
      //echo "Records Added!";

      // serve the page normally
      }
     $_SESSION['success']="You are logged in";
     //header('location:New_index.php');
     //header('location: http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Hello, Welcome to New SMS Service&receivers=8777025869&isflash=0');
   //header('location: New_index.php');
    echo '<script>setTimeout(function(){window.open("http://localhost:81/Complain_Logger/New_index.php","_self");},1500)</script>';
    }
   else
    {
      echo "Error:Could not add records!".mysqli_error($db_1);
    }
  }
}
?>
