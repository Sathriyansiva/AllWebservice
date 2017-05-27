<?php
  include("config/db.php");
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $image = $_POST['image'];
 $ibo = $_POST['ibo'];
 
 $config123  = "http://kothuram.com/donatefund/uploads/1003";
		
		if(!is_dir($config123)){
			mkdir($config123);
		}
 
 }
 
 ?>