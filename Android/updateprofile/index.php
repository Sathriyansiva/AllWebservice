<?php
include("config/db.php");

if(isset($_GET['ibo']))
{
$ibo =$_GET['ibo'];
}
else
{
$ibo =$_POST['ibo'];
}

$fname1=$_POST['Firstname'];
$email1=$_POST['Email'];
$phone1=$_POST['Phone'];
$whatsup1=$_POST['Whatsup'];
$address1 =$_POST['Address1'];

 $query ="update distributor_profile_hdr set Firstname='$fname1',Email='$email1',Phone='$phone1',Whatsup='$whatsup1',Address1='$address1' where ibo='$ibo'";
 
 $result = mysqli_query($conn, $query);
 if($result){
 
	 echo "updated";
 }
 else
 {
 echo "error";
 }
 ?>
  