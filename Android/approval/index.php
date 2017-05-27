<?php
include("config/db.php");


$ibo =$_POST['ibo'];
$prod_id=$_POST['prod_id'];



 $query ="insert into do_product_subscriptions (user_ibo,prod_id,status,created) values ('$ibo','$prod_id','Pending',now())";
 
 $result = mysqli_query($conn, $query);
 if($result){
 
	 echo "updated";
 }
 else
 {
 echo "error";
 }
 ?>
  