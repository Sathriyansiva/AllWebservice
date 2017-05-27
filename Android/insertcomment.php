<?php
include("config/db.php");


$ibo=$_POST['ibo'];
$prod_id=$_POST['prod_id'];
$taskno=$_POST['taskno'];
$day=$_POST['day'];
$message=$_POST['message'];
$username=$_POST['username'];



$query ="insert into comment_image(ibo,prod_id,taskno,day,message,username,created) values('$ibo','$prod_id','$taskno','$day','$message','$username',now())";
 
$result = mysqli_query($conn, $query);
 if($result){
 
	 echo "inserted";
 }
 else
 {
 echo "error";
 }
 ?>