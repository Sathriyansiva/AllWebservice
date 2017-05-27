<?php 
 include("config/db.php");
if(isset($_GET['prod_id']))
{
$prod_id=$_GET['prod_id'];
}


if(isset($_GET['day']))
{
$day=$_GET['day'];
}


if(isset($_GET['taskno']))
{
$taskno=$_GET['taskno'];
}


if(isset($_GET['ibo']))
{
$ibo=$_GET['ibo'];
}


	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"select a.message,b.firstname from comment_image a , distributor_profile_hdr b where a.ibo=b.ibo and a.day='$day' and a.taskno='$taskno'  and a.prod_id = '$prod_id'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$message= $rows['message'];
		$name= $rows['firstname'];
		
		
	
		 $posts[] = array('message'=>$message,'name'=>$name);
		
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