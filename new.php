<?php include('New_server.php'); ?>
<?php include('data.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Complain Logs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="new_style.css">
  <link rel="stylesheet" type="text/css" href="userpage.css">
      <style type="text/css">
      footer{
        color: black;
        font-size: 12px;
        width: 200px;
        float: right;
        bottom: 0px;
        margin: 5px;
      
      }
    </style>
</head>
<body>
     
<h2 style="text-align: center;font-family: Verdana;color: rgb(40,40,40);">Complain Logs</h2>
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
	<?php
$conn=mysqli_connect('localhost','root','password','formdata') or die('Error in connecting to database');

$sql = "SELECT * FROM formdetails ORDER BY id DESC";
$sqli= "SELECT * FROM adminform";
$result = $conn->query($sql);
$resulti= $conn->query($sqli);
  $count=mysqli_num_rows($result);
  $sql1="SELECT * FROM formdetails WHERE chck='Yes'";
   $result1 = $conn->query($sql1);
   $count1=mysqli_num_rows($result1);
   $sql2="SELECT * FROM formdetails WHERE isclear='Yes'";
   $result2 = $conn->query($sql2);
   $count2=mysqli_num_rows($result2);
   $sql3="SELECT * FROM formdetails WHERE isclear='No'";
   $result3 = $conn->query($sql3);
   $count3=mysqli_num_rows($result3);

?>
     <div id="stats"><fieldset><legend>Statistics</legend><h4><div id="one1">Total Number of Submissions: <?php echo $count;?><br></div><div id="two2">Number Of Submissions Attended: <?php echo $count1;?><br></div><div id="three3">Number Of Submissions Cleared: <?php echo $count2;?></div><div id="four4">Number Of Submissions Re-Opened: <?php echo $count3;?><br></div></h4></fieldset></div>
<fieldset><legend>Submissions:</legend>
<table border="0" class="table1">
 <tr id="head">
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
   <font face="Arial, Helvetica, sans-serif">User Checked</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">User Remarks</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Check</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Name of Attendee</font>
  </th>
  <th>
   <font face="Arial, Helvetica, sans-serif">Remarks</font>
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
    	
      if(($row["chck"]=="No")&&($row["isclear"]==""))
      {
        echo "<tr style='background:#BEBEBE;'><td>" . $row["id"]. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        
        if(empty($row["isclear"]))
        {
          echo "<td>Not Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["isclear"]."</td>";
        }
        if(empty($row["userremarks"]))
        {
          echo "<td>No Remarks</td>";
        }
        else
        {
          echo "<td>".$row["userremarks"]."</td>";
        }
         echo "<td><form method='post' action='new.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";

         if($row["chck"]=="No")
         {
          
            echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
            echo "<td><select name='attendee'><option>Select</option><option>Suvendu Sarkar</option><option>Arnangshu Haldar</option><option>Satatdru Das</option><option>Souvik Maitra</option><option>Kaushik Deti</option><option>Ayan Mondal</option><option>Tarak Roy</option></select></td>";
            echo "<td><textarea name='remarks' rows='1' cols='25'></textarea></td>";
            //echo $id;
            echo "<input type='hidden' name='id' value='$id'/>"; 
            //echo $id;
            $_SESSION['name']=$row["name"];
            $_SESSION['mob']=$row["mobile"];
            $_SESSION['mail']=$row["emailid"];
            echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        else
        {
           echo  $row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>Cleared</td></form></tr>";
        }
       }
       elseif(($row["chck"]=="No") && ($row["isclear"]=="No"))
       {
        echo "<tr style='background:#FF6600;'><td>" . $row["id"]. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        if(empty($row["isclear"]))
        {
          echo "<td>Not Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["isclear"]."</td>";
        }
        if(empty($row["userremarks"]))
        {
          echo "<td>Not Yet Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["userremarks"]."</td>";
        }
         echo "<td><form method='post' action='new.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";

         if($row["chck"]=="No")
         {
           
            echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
            echo "<td><select name='attendee'><option>Select</option><option>Suvendu</option><option>Arnangshu</option><option>Satatdru</option><option>Souvik</option><option>Kaushik</option></select></td>";
            echo "<td><textarea name='remarks' rows='1' cols='25'></textarea></td>";
            echo "<input type='hidden' name='id' value='$id'/>"; 
            $_SESSION['name']=$row["name"];
            $_SESSION['mob']=$row["mobile"];
            $_SESSION['mail']=$row["emailid"];
            echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        else
        {
           echo  $row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>Cleared</td></form></tr>";
        }
       }
       elseif(($row["chck"]=="Yes") && ($row["isclear"]==""))
       {
        echo "<tr style='background:#808080;'><td>" . $row["id"]. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        if(empty($row["isclear"]))
        {
          echo "<td>Not Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["isclear"]."</td>";
        }
        if(empty($row["userremarks"]))
        {
          echo "<td>Not Yet Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["userremarks"]."</td>";
        }
         echo "<td><form method='post' action='new.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";

         if($row["chck"]=="No")
         {
            echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
            echo "<td><select name='attendee'><option>Select</option><option>Suvendu</option><option>Arnangshu</option><option>Satatdru</option><option>Souvik</option><option>Kaushik</option></select></td>";
            echo "<td><textarea name='remarks' rows='1' cols='25'></textarea></td>";
            echo "<input type='hidden' name='id' value='$id'/>"; 
            $_SESSION['name']=$row["name"];
            $_SESSION['mob']=$row["mobile"];
            $_SESSION['mail']=$row["emailid"];
            echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        else
        {
           echo  $row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>Waiting For User Reply</td></form></tr>";
        }
       }
       else
       {
        echo "<tr style='background:#DCDCDC;'><td>" . $row["id"]. "</td><td>" .$row["type"]. "</td><td>" . $row["message"]. "</td><td>" . $row["name"]. "</td><td> " . $row["mobile"]. "</td><td>" . $row["emailid"]. "</td><td>".$row["company"]."</td><td>";
        echo '<a href="link.php?id='.$row['id'].'"target=_blank>' .$row['imagename']. "</a></td>";
        if(empty($row["isclear"]))
        {
          echo "<td>Not Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["isclear"]."</td>";
        }
        if(empty($row["userremarks"]))
        {
          echo "<td>Not Yet Checked By User</td>";
        }
        else
        {
          echo "<td>".$row["userremarks"]."</td>";
        }
         echo "<td><form method='post' action='new.php' enctype='multipart/form-data'><?php include('errors.php'); ?>";

         if($row["chck"]=="No")
         {
            echo "<input type='radio' name='check' value='Yes'>Yes<br><input type='radio' name='check' value='No' checked='checked'>No</td>";
            echo "<td><select name='attendee'><option>Select</option><option>Suvendu</option><option>Arnangshu</option><option>Satatdru</option><option>Souvik</option><option>Kaushik</option></select></td>";
            echo "<td><textarea name='remarks' rows='1' cols='25'></textarea></td>";
            echo "<input type='hidden' name='id' value='$id'/>"; 
            $_SESSION['name']=$row["name"];
            $_SESSION['mob']=$row["mobile"];
            $_SESSION['mail']=$row["emailid"];
            echo "<td><button type='submit' name='submit1'>Submit</button></td></form></tr>";
         }
        else
        {
           echo  $row["chck"]. "</td>"; 
           echo "<td>" .$row["attendee"]. "</td>";
           echo "<td>".$row["remarks"]. "</td>";
           echo "<td>Cleared</td></form></tr>";
        }
       }
     }
  
$conn->close();
?> 
</table>
</fieldset>
</body>
<footer><p>Developed By:Nikhil Ladha </p>
&copy;Copyright 2018 Switzindia PVT. LTD.</footer>

</html>