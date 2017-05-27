<?php
include("config/db.php");

if(isset($_GET['Username']))
{
$username=$_GET['Username'];
}

 $format = strtolower($_GET['format']) == 'json'; //xml is the default

		
		$query = mysqli_query($conn,"SELECT IBO FROM distributor_profile_hdr where Username= '$username' and Flag='1'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$ibo= $rows['IBO'];
		
		 $posts[] = array('IBO' => $ibo);
		
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
	?>