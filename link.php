<?php
 $conn=mysqli_connect('localhost','root','password','formdata') or die('Error connecting database');
 $sql="SELECT id,image FROM formdetails WHERE id=" .$_GET['id']. ";";
 /*if($sql)
 	echo "True";
 else
 	echo "False";
  */
  $result= $conn->query($sql);
  //header("content-type: image/jpg");
  if($row= $result->fetch_assoc())
  echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"height="800" width="1350" />';
 else
 	echo "Link not done";
 $conn->close();
?>