<?php
include("config/db.php");

$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "select * from temp_distributor where username='$username' and password='$password'";

$res = mysqli_query($conn,$sql);
 
$check = mysqli_fetch_array($res);

 
if(isset($check)){

 $format = strtolower($_GET['format']) == 'json'; //xml is the default
 $query = mysqli_query($conn,"SELECT * FROM `distributor_profile_hdr` where username='$username'") or die(mysqli_error());
 
  $posts = array();
  if(mysqli_num_rows($query)) {
    while($post = mysqli_fetch_assoc($query)) {
		$data0 = "Y";
		$data = $post['Firstname'];
		$data1 = $post['Entrylevel'];
		$data2 = $post['fund_sent'];
		$data3 = $post['fund_received'];
		$data4 = $post['Created_Date'];
		
      $posts[] = array('Status'=>$data0,'Firstname'=>$data,'Entrylevel'=>$data1,'fund_received'=>$data3,'Created_Date'=>$data4,'fund_sent'=>$data2);
    }
  }
  /* output in necessary format */
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

}else{
	$format = strtolower($_GET['format']) == 'json';
	 $posts = array();
	$data = "N";
		$data1 = "Failiure";
	
$posts[]=array('Status'=>$data,'message'=>$data1);
  if($format == 'json') {
    header('Content-type: application/json');
    echo json_encode(array('posts'=>$posts));
  }
}

?>