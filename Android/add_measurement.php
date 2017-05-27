<?php
include("config/db.php");


$ibo=$_POST['ibo'];
$height=$_POST['height'];
$weight=$_POST['weight'];
$dob=$_POST['dob'];




$query ="insert into add_measurement(ibo,height,weight,dob,created) values('$ibo','$height','$weight','$dob',now())";
 
$result = mysqli_query($conn, $query);
 if($result){
 
	 echo "inserted";
 }
 else
 {
 echo "error";
 }
 ?>