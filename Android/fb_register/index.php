<?php
include("config/db.php");

$username=$_POST['Username'];

 $format = strtolower($_GET['format']) == 'json'; //xml is the default
$sqls = "SELECT Username FROM distributor_profile_hdr where Username= '$username' and Flag='1'";
$resultch = mysqli_query($conn, $sqls);

	if(mysqli_num_rows($resultch) > 0){
		
		
		$query = mysqli_query($conn,"SELECT IBO FROM distributor_profile_hdr where Username= '$username' and Flag='1'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$ibo= $rows['IBO'];
		
		 $posts[] = array('IBO' => $ibo,'Username'=>"Already Exist");
		
	}
	
  }
  if($format == 'json') {
    header('Content-type: application/json');
    echo json_encode(array('posts'=>$posts));
  }
  else {
    header('Content-type: text/xml');
    echo '';
    foreach($posts as $index => $post) {
      if(is_array($post)) {
        foreach($post as $key => $value) {
          echo '<',$key,'>';
          if(is_array($value)) {
            foreach($value as $tag => $val) {
              echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
            }
          }
          echo '</',$key,'>';
        }
      }
    }
    echo '';
  }
	}
else

{

$query ="insert into distributor_profile_hdr(Username,Sponsor,Created_Date,Flag) values('$username','1000',now(),'1')";
 
$result = mysqli_query($conn, $query);
 if($result){
 
	 $query = mysqli_query($conn,"SELECT IBO FROM distributor_profile_hdr where Username= '$username' and Flag='1'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$ibo= $rows['IBO'];
		
		 $posts[] = array('IBO' => $ibo,'Username'=>"Available");
		
	}
	
  }
  if($format == 'json') {
    header('Content-type: application/json');
    echo json_encode(array('posts'=>$posts));
  }
  else {
    header('Content-type: text/xml');
    echo '';
    foreach($posts as $index => $post) {
      if(is_array($post)) {
        foreach($post as $key => $value) {
          echo '<',$key,'>';
          if(is_array($value)) {
            foreach($value as $tag => $val) {
              echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
            }
          }
          echo '</',$key,'>';
        }
      }
    }
    echo '';
  }
 }
 else
 {
 echo "error";
 }
 
 
 }
 

	 
 ?>