<?php
include("config/db.php");

$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "select * from distributor_profile_hdr where Email='$username' and Password='$password'";
 
$res = mysqli_query($conn,$sql);
 
$check = mysqli_fetch_array($res);
 
$var='success';
$var1="failiure";

 
if(isset($check)){
echo 'success';
}else{
echo 'failiure';
}

?>