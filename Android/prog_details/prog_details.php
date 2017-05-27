<?php
include("config/db.php");
date_default_timezone_set('Asia/Kolkata');

if(isset($_GET['id']))
{
$id=$_GET['id'];
}

if(isset($_GET['prod_id']))
{
$prod_id=$_GET['prod_id'];
}
 $format = strtolower($_GET['format']) == 'json'; //xml is the default

		
		$query = mysqli_query($conn,"SELECT * FROM do_product_hdr where prod_cate='$id' and prod_id=$prod_id") or die(mysqli_error()); 
 $posts = array();
  if(mysqli_num_rows($query)) {
    while($rows = mysqli_fetch_assoc($query)) {
		
		$prod_desc= $rows['prod_desc'];
		$benifits= $rows['benifits'];
		$fromdate1= $rows['fromdate'];
		$todate1= $rows['todate'];
		$fdate=  date("d/m/Y", strtotime($fromdate1));
		$tdate = date("d/m/Y", strtotime($todate1));
		$testimonial= $rows['testimonial'];
		$prod_image= $rows['prod_image'];
		$points= $rows['points'];
		$fromdate= strtotime($rows['fromdate']);
		$todate= strtotime($rows['todate']);
		$prod_id= $rows['prod_id'];
$timeDiff = abs($todate - $fromdate);

$duration= $timeDiff/86400;  // 86400 seconds in one day

// and you might want to convert to integer
$numberDays = intval($numberDays);
               
		
		 $posts[] = array('prod_id' => $prod_id,'prod_desc' => $prod_desc,'duration'=>$duration,'benifits' =>$benifits,'fromdate' =>$fdate, 'todate' =>$tdate ,'testimonial'=>$testimonial,'prod_image' =>$prod_image,'points'=>$points);
		
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