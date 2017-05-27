<?php 
 include("config/db.php");
if(isset($_GET['ibo']))
{
$ibo=$_GET['ibo'];
}
else
{
$ibo=$_POST['ibo'];
}

	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"select * from health_user Where IBO='$ibo' ORDER BY id DESC LIMIT 7") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$weight= $rows['weight'];
		$bmi= $rows['bmi'];
		
		 $posts[] = array('weight'=>$weight,'bmi' =>$bmi);
		
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