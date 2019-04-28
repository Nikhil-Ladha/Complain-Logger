<?php 
 $check="";
 //$select="";
 $userremarks="";
 $id="";
 $errors=array();

 //connect to database
   $db=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');

   //if submit button is clicked
   if(isset($_POST['submit1']))
   {
   	 $check=mysqli_real_escape_string($db,$_POST['check']);
   	 //$select=mysqli_real_escape_string($db,$_POST['attendee']);
   	 $userremarks=mysqli_real_escape_string($db,$_POST['userremarks']);
     $id=mysqli_real_escape_string($db,$_POST['id']);

   	 /*if($check=="No")
   	 {
   	 	 array_push($errors,"Check the detais of submission");
       echo "<script>alert('Check the details of submission')</script>";
   	 }
   	 if($select=="Select")
   	 {
   	 	 array_push($errors,"Check the detais of submission");
     echo "<script>alert('Check the details of submission')</script>";
   	 }*/
   	 //echo "In Page!!";
     //echo $check,$select;
     //echo $id;
   	 //$sql="INSERT INTO adminform(chck,attendee,remarks) VALUES ('$check','$select','$remarks')";
   	 if($check=="No")
   	 {
   	 	$sql="UPDATE formdetails SET chck='$check',isclear='$check',userremarks='$userremarks' WHERE id='$id'";
   	 if(mysqli_query($db,$sql))
   	 {
   	   echo "Records Added!!";
   	   header('location: New_index.php');
   	 }
   	 else
   	 {
   	 	echo "Records Not Added!";
   	 }
    }
    else
    {
     $sql="UPDATE formdetails SET isclear='$check',userremarks='$userremarks' WHERE id='$id'";
     if(mysqli_query($db,$sql))
     {
       echo "Records Added!!";
       header('location: New_index.php');
     }
     else
     {
      echo "Records Not Added!";
     } 
    }
  }
?>