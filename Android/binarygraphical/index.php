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

	mysqli_query($conn, "SET @p1='$ibo'");
	$mysqlproc = mysqli_query($conn, "CALL binary_graphical_view(@p1)");

 
if (mysqli_num_rows($mysqlproc) > 0) {
    // output data of each row
    while($rows = mysqli_fetch_assoc($mysqlproc)) {
    
    
                $IBO= $rows['IBO'];
		$Firstname= $rows['Firstname'];
		$Phone= $rows['Phone'];
		$Sponsor= $rows['Sponsor'];
		$Email = $rows['Email'];
		$position= $rows['position'];
		if($position == 0){$position="Left";}else{$position="Right";}
	
		 $posts[] = array('IBO'=>$IBO,'Firstname'=>$Firstname,'Phone'=>$Phone,'Sponsor'=>$Sponsor,'Email '=>$Email ,'position'=>$position);
		
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
  