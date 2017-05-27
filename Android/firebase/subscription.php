<?php  
include("config/db.php");

 $format = strtolower($_GET['format']) == 'json'; //xml is the default
 $query = mysqli_query($conn,"SELECT * FROM `do_product_hdr` ") or die(mysqli_error());
 
  $posts = array();
  if(mysqli_num_rows($query)) {
    while($post = mysqli_fetch_assoc($query)) {
		
		$data = $post['prod_cate'];
		$data1 = $post['prod_name'];
		$data2 = $post['prod_desc'];
		$data3 = $post['prod_price'];
		$data4 = $post['prod_image'];
		
      $posts[] = array('prod_code'=>$data,'prod_name'=>$data1,'prod_desc'=>$data2,'prod_price'=>$data3,'prod_image'=>$data4);
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