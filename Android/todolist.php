<?php 
 include("config/db.php");
if(isset($_GET['id']))
{
$id=$_GET['id'];
}
else
{
$id=$_POST['id'];
}

if(isset($_GET['day']))
{
$day=$_GET['day'];
}
else
{
$day=$_POST['day'];
}

	$format = strtolower($_GET['format']) == 'json'; //xml is the default
	 $query = mysqli_query($conn,"SELECT hd.prod_name as prod_name,de.days as nod,de.prod_id as prod_id,de.topic as topic,de.desc as full_desc,de.taskname as task,de.taskno  FROM do_product_hdr hd,do_product_details de WHERE hd.id = de.prod_id and hd.id = '$id' and de.days='$day'") or die(mysqli_error());
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$prod_name= $rows['prod_name'];
		$prod_id= $rows['prod_id'];
		$nod= $rows['nod'];
		$topic = $rows['topic'];
		$taskname= $rows['task'];
		$taskno  = $rows['taskno'];
		
	
		 $posts[] = array('prod_name'=>$prod_name,'prod_id'=>$prod_id,'Days'=>$nod,'topic'=>$topic ,'taskname'=>$taskname,'taskno'=>$taskno);
		
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