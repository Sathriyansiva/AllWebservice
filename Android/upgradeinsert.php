<?php
include("config/db.php");

$image=$_POST['image'];
$userid=$_POST['userid'];
$entrylevel=$_POST['entrylevel'];
$sponsor=$_POST['sponsor'];
$sponsor_amount=$_POST['sponsor_amount'];
$sponsor_coinid=$_POST['sponsor_coinid'];
$sponsor_coinaddress=$_POST['sponsor_coinaddress'];

$query ="insert into comment(image,userid,entrylevel,sponsor,sponsor_amount,sponsor_coinid,sponsor_coinaddress,status,created) values('$image','$userid','$entrylevel','$sponsor','$sponsor_amount','$sponsor_coinid','$sponsor_coinaddress','pending',now())";
 
$result = mysqli_query($conn, $query);
 if($result){
 
	 echo "inserted";
 }
 else
 {
 echo "error";
 }
 ?>
  