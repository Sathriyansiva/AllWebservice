<?php  
include("config/db.php");
if(isset($_GET['ibo']))
{
$ibo =$_GET['ibo'];
}
else
{
$ibo =$_POST['ibo'];
}


include("config/db.php");
		
	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"select * from sap_pay_image Where userid ='$ibo '") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		

		
		$userid= $rows['userid'];
		$image= $rows['image'];
		$elevel= $rows['entrylevel'];
		$sponsor= $rows['sponsor'];
		$spo_amt= $rows['sponsor_amount'];
		$status= $rows['status'];
		$uploaddate= $rows['created'];
		$apprej= $rows['apprej'];
		
		
		 $posts[] = array('userid'=>$userid,'image'=>$image,'elevel'=>$elevel,'sponsor'=>$sponsor,'spo_amt'=>$spo_amt,'status'=>$status,'uploaddate'=>$uploaddate,'apprej'=>$apprej);
		
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

