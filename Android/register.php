<?php
include("config/db.php");
$Username=$_POST['Username'];
$password=$_POST['Password'];
$email=$_POST['Email'];
$sponsor=$_POST['Sponsor'];



$sqls = "SELECT Email FROM distributor_profile_hdr where Email= '$email'";
$resultch = mysqli_query($conn, $sqls);

	if(mysqli_num_rows($resultch) > 0){
		echo "Email Already Exists!";
	}
else

{

$query ="insert into distributor_profile_hdr(Username,Email,Password,Sponsor,Created_Date) values('$Username','$email','$password','$sponsor',now())";
 
$result = mysqli_query($conn, $query);
 if($result){
 
	 echo "Sucessfully Registered";
 }
 else
 {
 echo "error";
 }
 }
 ?>