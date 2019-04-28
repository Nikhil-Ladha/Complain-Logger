<?php 
 $check="";
 $select="";
 $remarks="";
 //$id=$_POST['id'];
 $errors=array();

 //connect to database
   $db=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');

   //if submit button is clicked
   if(isset($_POST['submit1']))
   {
   	 $check=mysqli_real_escape_string($db,$_POST['check']);
   	 $select=mysqli_real_escape_string($db,$_POST['attendee']);
   	 $remarks=mysqli_real_escape_string($db,$_POST['remarks']);
     $id=mysqli_real_escape_string($db,$_POST['id']);

   	 if($check=="No")
   	 {
   	 	 array_push($errors,"Check the detais of submission");
         echo "<script>alert('Check the details of submission')</script>";
   	 }
   	 if($select=="Select")
   	 {
   	 	 array_push($errors,"Check the detais of submission");
         echo "<script>alert('Check the details of submission')</script>";
   	 }
   	 //echo "In Page!!";
     //echo $check,$select;
     //echo $id;
   	 //$sql="INSERT INTO adminform(chck,attendee,remarks) VALUES ('$check','$select','$remarks')";
   	   	//echo '<script>var myTab1= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=New Complain by Employee Name:Mobile Number:,Email Id:Problem Type:,Problem:&receivers=8777025869&isflash=0","_blank");
          //  setTimeout(function(){ myTab1.close();},1500);</script>';
   	 //echo $select;

   	 if(count($errors)==0)
   	 {
       /*if($select=="Suvendu")
       {
       	echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Check this Complain ID:'.$id.' by Employee Name:'.$name.'Mobile Number:'.$mob.',Email Id:'.$email.'Remarks:'.$remarks.'&receivers=8777025869&isflash=0","_blank");
            setTimeout(function(){ myTab.close();},2000);</script>';
       }
       if($select=="Arnangshu")
       {
       	echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Check this Complain ID:'.$id.' by Employee Name:'.$name.'Mobile Number:'.$mob.',Email Id:'.$email.'Remarks:'.$remarks.'&receivers=8777025869&isflash=0","_blank");
            setTimeout(function(){ myTab.close();},2000);</script>';
       }
       if($select=="Satatdru")
       {
       	echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Check this Complain ID:'.$id.' by Employee Name:'.$name.'Mobile Number:'.$mob.',Email Id:'.$email.'Remarks:'.$remarks.'&receivers=8777025869&isflash=0","_blank");
            setTimeout(function(){ myTab.close();},2000);</script>';
       }
       if($select=="Souvik")
       {
       	echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Check this Complain ID:'.$id.' by Employee Name:'.$name.'Mobile Number:'.$mob.',Email Id:'.$email.'Remarks:'.$remarks.'&receivers=8777025869&isflash=0","_blank");
            setTimeout(function(){ myTab.close();},2000);</script>';
       }
       if($select=="Kaushik")
       {
       echo '<script>var myTab= window.open("http://smartsol.100coins.co/sendsms?officeid=DR4762&officepass=user123$&mask=MSDBPL&message=Check this Complain ID:'.$id.' by Employee Name:'.$name.'Mobile Number:'.$mob.',Email Id:'.$email.'Remarks:'.$remarks.'&receivers=8777025869&isflash=0","_blank");
            setTimeout(function(){ myTab.close();},2000);</script>';
        }*/

   	 $sql="UPDATE formdetails SET chck='$check',attendee='$select',remarks='$remarks' WHERE id='$id'";
   	 if(mysqli_query($db,$sql))
   	 {
   	   //echo "Records Added!!";
   	   header('location: new.php');
   	 	//echo '<script>setTimeout(function(){window.open("http://localhost:81/site_1/new.php","_self");},2400)</script>';
   	 }
   	 else
   	 {
   	 	//echo "Records Not Added!";
   	 }
    }
  }
?>