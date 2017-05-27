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


	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"select * from distributor_profile_hdr Where IBO ='$ibo'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		

		
		$fname = $rows['Username'];
		
		
		$Email = $rows['Email'];
		$Phone = $rows['Phone'];
		$Whatsup = $rows['Whatsup'];
		$country = $rows['Country'];
		$address =$rows['Address1'];
		
		
		 $posts[] = array('Firstname'=>$fname,'Email'=>$Email,'Phone'=>$Phone,'Whatsup'=>$Whatsup,'country'=>$country,'Address1'=>$address);
		
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



