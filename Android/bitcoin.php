<?php  
include("config/db.php");
if(isset($_GET['username']))
{
$username=$_GET['username'];
}

$coin_link=$_POST['coin_link'];
$coin_address=$_POST['coin_address'];
 
 $query ="update temp_distributor set coin_link='$coin_link',coin_address='$coin_address' where username='$username'";
 
 $result = mysqli_query($conn, $query);
 if($result){
 
	 echo "updated";
 }
 else
 {
 echo "error";
 }
 
?>