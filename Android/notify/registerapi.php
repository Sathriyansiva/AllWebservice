<?php
include("config/db.php");


$firebaseid = $_POST['firebaseid'];
 $email  = $_POST['email'];


 $sql = "INSERT INTO registerapi (firebaseid, email,created) VALUES ('$firebaseid','$email',now())";
 
 //executing the query to the database 
 if(mysqli_query($conn,$sql)){
 echo 'success';
 }else{
 echo 'failure';
 }
 ?>
  