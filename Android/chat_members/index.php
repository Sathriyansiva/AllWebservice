<?php 
 include("config/db.php");
 
 if(isset($_GET['ibo']))
 {
 $ibo12 =$_GET['ibo'];
 }


$format = strtolower($_GET['format']) == 'json'; //xml is the default
	$query = mysqli_query($conn,"SELECT * FROM `distributor_profile_hdr` where IBO != '$ibo12'") or die(mysqli_error());
 
  $posts = array();
  if(mysqli_num_rows($query)) {
    while($post = mysqli_fetch_assoc($query)) {
		if($post['Firstname']=="")
		{
		$data = $post['Username'];
		}else
		{
		$data = $post['Firstname'];
		}
	        $ibo = $post['IBO']; 
		 $posts[] = array('Username'=>$data,'ibo' =>$ibo);
		
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