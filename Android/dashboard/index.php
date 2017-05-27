<?php  
include("config/db.php");
if(isset($_GET['ibo']))
{
$ibo=$_GET['ibo'];
}
else
{
$username=$_POST['username'];
}
 $format = strtolower($_GET['format']) == 'json'; //xml is the default
 $query = mysqli_query($conn,"SELECT * FROM `distributor_profile_hdr` where ibo='$ibo'") or die(mysqli_error());
 
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
		$data1 = $post['Entrylevel'];
		$data2 = $post['fund_sent'];
		$data3 = $post['fund_received'];
		$data4 = $post['Created_Date'];
		
      $posts[] = array('Username'=>$data,'Entrylevel'=>$data1,'fund_received'=>$data3,'Created_Date'=>$data4,'fund_sent'=>$data2);
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
 
?>