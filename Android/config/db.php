<?php
$servername = "166.62.27.150";
$username = "donatefunddb";
$password = "donatefunddb";
$dbname = "donatefunddb";

/* $servername = "localhost";
$username = "root";
$password = "";
$dbname = "life_health";
 */ 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//else{
//echo ("sucess");
//}
?>