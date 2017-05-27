<?php
include("config/db.php");
date_default_timezone_set('Asia/Kolkata');

if(isset($_GET['id']))
{
$id=$_GET['id'];


}



 $format = strtolower($_GET['format']) == 'json'; //xml is the default

		
		$query = mysqli_query($conn,"SELECT * FROM do_category where id='$id' ") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		
		$created= $rows['created'];
		$yrdata= strtotime($created);
   $date   =date('M-d', $yrdata);
		
		 $posts[] = array('created' =>$date);
		
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