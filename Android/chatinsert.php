<?php
include("config/db.php");


$senderibo = $_POST['senderibo'];
			
$message = $_POST['message'];
$receiveribo= $_POST['receiveribo'];



$query ="insert into chat(sender_ibo,message,receiver_ibo,created) values('$senderibo','$message','$receiveribo',now())";
 
$result = mysqli_query($conn, $query);
 if($result){
 
	 echo "inserted";
 }
 else
 {
 echo "error";
 }
 ?>