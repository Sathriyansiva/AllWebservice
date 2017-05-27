<?php 
 include("config/db.php");
if(isset($_GET['ibo']))
{
$ibo=$_GET['ibo'];
}


if(isset($_GET['receiveribo']))
{
$receiveribo=$_GET['receiveribo'];
}




	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"SELECT * FROM chat WHERE (sender_ibo =  '$ibo' and receiver_ibo =  '$receiveribo') or  (sender_ibo='$receiveribo' and receiver_ibo='$ibo')") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$image= $rows['image'];
		$senderibo =$rows['sender_ibo'];
	        $receiveribo=$rows['receiver_ibo'];
		$message= $rows['message'];
		
		
	
		 $posts[] = array('image'=>$image,'message' => $message,'senderibo'=>$senderibo,'receiveribo'=>$receiveribo);
		
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