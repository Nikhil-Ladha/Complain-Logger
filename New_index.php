<?php include('New_server.php'); ?>
<?php include('from.php'); ?>
<?php include('data1.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Complaint Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Formcss.css">
	<link rel="stylesheet" type="text/css" href="userpage.css">
</head>
<body onload="document.refresh();">
	<div>
		<h1 style="text-align: center; font-family: Verdana;color:rgb(40,40,40);">Complain form</h1>
	</div>
	
	<div>
		<?php if(isset($_SESSION['success'])): ?>
			<div>
				<h3>
					<?php
					   echo $_SESSION['success'];
					   $_SESSION['success']="You are logged in";
					?>
				</h3>
			</div>
		<?php endif ?>

		<?php if(isset($_SESSION['username'])){
			echo "<h4 style='font-family:Cursive;'>Welcome, </h4><p style='font-family:Cursive;'>" .$_SESSION['username']. "</p>";
			echo "<p><a href='New_index.php?logout='1'' style='color: red;'>Logout</a></p>";
		    }
		    else
		     {
		       header('location:New_login.php');
		     }
		?>
	</div>
  <div id="log">
  	<h2 style="text-align:center;color:rgb(40,40,40);">Enter The Details Of Your Complain:-</h2><br> 
	 <fieldset><legend>Personal Details:</legend>
	 <form name="myForm" method="post" action="New_index.php" enctype="multipart/form-data">
     <?php include('errors.php'); ?>
	  <label>Issuer's Name:</label>
	  <input type="text" name="name" placeholder="Enter Your Name.." maxlength="30" autocomplete="off" value="<?php echo $name;?>">
	  <br><br>
	  <label>Issue Type:</label>
	  <input name="itype" type="radio" value="Hardware">Hardware</input>
	  <input name="itype" type="radio" value="Software">Software</input>
	  <input name="itype" type="radio" value="Other">Other</input><br><br>
	  <label>Enter Your Problem:</label><textarea name="msg" rows="6" cols="50" placeholder="Enter Your Problem Here......" value="<?php echo $msg;?>"></textarea><br><br>
	  <label>Select Image to Upload:</label>
      <input type="file" name="myimage">
	  <br><br>
	  <button name="submit" type="submit" class="but">Submit</button>
	 </form>
	 </fieldset>
  </div>
  <fieldset><legend>Submissions Info:</legend>
  <?php
   
   $conn=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');
   
   $email=$_SESSION['email'];
   $sql = "SELECT * FROM formdetails WHERE emailid='$email' ORDER BY id DESC";
   $result = $conn->query($sql);
   $count=mysqli_num_rows($result);
   $sql1="SELECT * FROM formdetails WHERE emailid='$email' AND chck='Yes'";
   $result1 = $conn->query($sql1);
   $count1=mysqli_num_rows($result1);
   $sql2="SELECT * FROM formdetails WHERE emailid='$email'AND isclear='Yes'";
   $result2 = $conn->query($sql2);
   $count2=mysqli_num_rows($result2);
   //echo "Total Number Of Submissions:".$count."\r\nNumber Of Submissions Attended:".$count1."\r\nNumber Of Submissions Cleared:".$count2;
   
   ?>
  <div id="stats"><fieldset><legend>Statistics</legend><h4><div id="one">Total Number of Submissions: <?php echo $count;?><br></div><div id="two">Number Of Submissions Attended: <?php echo $count1;?><br></div><div id="three">Number Of Submissions Cleared: <?php echo $count2;?></div></h4></fieldset></div>
 <table border="0" class="floattable">
 <tr>
  <th>
   <font face="Arial, Helvetica, sans-serif">Serial Number</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Problem Type</font>
  </th>	
  <th style="width: 150px;">
   <font face="Arial, Helvetica, sans-serif">Problem</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Person Name</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Mobile Number</font>
  </th>
  <th style="width: 200px;">
   <font face="Arial, Helvetica, sans-serif">Email Id</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Company Name</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Image</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Is Your Problem Solved</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Is Attended</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Name of Attendee</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Remarks</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Your Remarks</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Clear Problem</font>
  </th>
 </tr>
 <?php  
    $i=0;// output data of each row
    while(($row = $result->fetch_assoc())) {
    	$i=$i+1;
    	$id=$row["id"];
    	//$sub_check=$row1["chck"];
    	//$image_path=$row["imagepath"];
    	//echo $i;
    	if($row["isclear"]=="" && ($row["chck"]=="No"))
        {
        echo "<tr style='background:#BEBEBE;'><td>" .$i. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        //echo "</td><td><input type='checkbox'></td><td><textarea rows='1' cols='25'></textarea></td>";
         echo "<td><form method='post' action='New_index.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";
         
        if((empty($row["isclear"])) || ($row["isclear"]=="No"))
        {
         
         if($row["chck"]=="No")
        
         {
           echo "No</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>Not Yet Attended</td>";
           echo "<td>Not Yet Attended</td>";
           echo "<td>Not Available Now</td>";
           echo "<input type='hidden' name='id' value='$id'/>";
           echo "<td>Not Yet Attended By Officials</form></tr>";
         }
         
         else
        
         {
           echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td><textarea name='userremarks' rows='1' cols='25'></textarea></td>";
           echo "<input type='hidden' name='id' value='$id'/>";
           echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        }
        else
        {
           echo  $row["isclear"]."</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>".$row["userremarks"]."</td>";
           echo "<td>Cleared</td></form></tr>";	
        }
     }
     elseif(($row["isclear"]=="") && ($row["chck"]=="Yes"))
     {
     	echo "<tr style='background:#DCDCDC;'><td>" .$i. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        //echo "</td><td><input type='checkbox'></td><td><textarea rows='1' cols='25'></textarea></td>";
         echo "<td><form method='post' action='New_index.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";
         
        if((empty($row["isclear"])) || ($row["isclear"]=="No"))
        {
         
         if($row["chck"]=="No")
        
         {
           echo "No</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>Not Yet Attended</td>";
           echo "<td>Not Yet Attended</td>";
           echo "<td>Not Available Now</td>";
           echo "<input type='hidden' name='id' value='$id'/>";
           echo "<td>Not Yet Attended By Officials</form></tr>";
         }
         
         else
        
         {
           echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td><textarea name='userremarks' rows='1' cols='25'></textarea></td>";
           echo "<input type='hidden' name='id' value='$id'/>";
           echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        }
        else
        {
           echo  $row["isclear"]."</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>".$row["userremarks"]."</td>";
           echo "<td>Cleared</td></form></tr>";	
        }
     }
     else
     {
       echo "<tr style='background:#F5F5F5;'><td>" .$i. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        //echo "</td><td><input type='checkbox'></td><td><textarea rows='1' cols='25'></textarea></td>";
         echo "<td><form method='post' action='New_index.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";
         
        if((empty($row["isclear"])) || ($row["isclear"]=="No"))
        {
         
         if($row["chck"]=="No")
        
         {
           echo "No</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>Not Yet Attended</td>";
           echo "<td>Not Yet Attended</td>";
           echo "<td>Not Available Now</td>";
           echo "<input type='hidden' name='id' value='$id'/>";
           echo "<td>Not Yet Attended By Officials</form></tr>";
         }
         
         else
        
         {
           echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td><textarea name='userremarks' rows='1' cols='25'></textarea></td>";
           echo "<input type='hidden' name='id' value='$id'/>";
           echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        }
        else
        {
           echo  $row["isclear"]."</td>";
           echo  "<td>".$row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>".$row["userremarks"]."</td>";
           echo "<td>Cleared</td></form></tr>";	
        }
     }
   }
   $conn->close();
?>
</table>
</fieldset>
</body>
</html>