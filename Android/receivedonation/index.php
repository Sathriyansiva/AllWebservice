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
	 $query = mysqli_query($conn,"SELECT * FROM `sap_pay_image` a,`distributor_profile_hdr` b WHERE a.sponsor='$ibo' and a.userid=b.ibo") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$userid= $rows['userid'];
		$entrylevel = $rows['entrylevel'];
		$Firstname= $rows['Firstname'];
		$Email= $rows['Email'];
		$Phone= $rows['Phone'];
		$sponsor_amount= $rows['sponsor_amount'];
		$apprej= $rows['apprej'];
	
		 $posts[] = array('userid'=>$userid,'entrylevel'=>$entrylevel ,'Firstname'=>$Firstname,'Email'=>$Email,'Phone'=>$Phone,'sponsor_amount'=>$sponsor_amount,'apprej'=>$apprej);
		
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