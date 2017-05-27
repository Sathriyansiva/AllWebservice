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

if(isset($_GET['level']))
{
$level =$_GET['level'];
}
else
{
$level =$_POST['level'];
}

	mysqli_query($conn, "SET @p0='$ibo'");
	mysqli_query($conn, "SET @p1='$level'");
	$mysqlproc = mysqli_query($conn, "CALL Levelcalc(@p0,@p1)");
	
	while ($row= mysqli_fetch_array($mysqlproc)) {
		
			$parentid = $row['parentid'];
	}
include("config/db.php");
		
	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"select * from distributor_profile_hdr Where ibo ='$parentid'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		

		
		$sfname = $rows['Firstname'];
		$slname = $rows['Lastname'];
		$sibo = $rows['ibo'];
		$Email = $rows['Email'];
		$Phone = $rows['Phone'];
		$Whatsup = $rows['Whatsup'];
		$Entrylevel = $rows['Entrylevel'];
		$coin_link = $rows['coin_link'];
		$coin_address = $rows['coin_address'];
		
		 $posts[] = array('sFirstname'=>$sfname,'sLastname'=>$slname,'sibo'=>$parentid,'sEmail'=>$Email,'sPhone'=>$Phone,'sWhatsup'=>$Whatsup,'sEntrylevel'=>$Entrylevel,'scoin_link'=>$coin_link,'scoin_address'=>$coin_address);
		
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

