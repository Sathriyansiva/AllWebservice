<?php  
include("config/db.php");
if(isset($_GET['prod_id']))
{
$id=$_GET['prod_id'];
}
else
{
$id=$_POST['prod_id'];
}

	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"SELECT MAX( days ) as days 
FROM  `do_product_details` where prod_id='$id'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		

		
		$days= $rows['days'];
		
		
		 $posts[] = array('Count'=>$days);
		
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

