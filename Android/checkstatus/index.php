<?php 
 include("config/db.php");
if(isset($_GET['ibo']))
{
$ibo=$_GET['ibo'];

}
if(isset($_GET['prod_id']))
{
$prod_id=$_GET['prod_id'];

}


	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	
	$query123 = mysqli_query($conn,"select MAX(created) as created from do_product_subscriptions Where user_ibo = '$ibo' and prod_id='$prod_id'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query123 )) {
    while($rows = mysqli_fetch_assoc($query123)) {
		
		$created= $rows['created'];
		
		
	}
	
  }
	
	 $query = mysqli_query($conn,"select MAX(created),status from do_product_subscriptions Where user_ibo = '$ibo' and prod_id='$prod_id' and created='$created' ") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$status= $rows['status'];
		
		 $posts[] = array('status'=>$status);
		
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