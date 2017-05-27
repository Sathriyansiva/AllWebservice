<?php  
include("config/db.php");
$email=$_POST['email'];
$query = mysqli_query($conn,"SELECT * FROM `distributor_profile_hdr` where Email='$email'") or die(mysqli_error());
 if(mysqli_num_rows($query) >0 ) {
    while($row = mysqli_fetch_assoc($query)) {
	$username=$row['Username'];
	$password=$row['Password'];
	$fname=$row['Firstname'];
	
	
	$to = $email;
$message = "<p>Dear : ".ucfirst($fname)."</p><br/>";
		
		
		$message .= "<table  border='1'><style>table {border-collapse: collapse;}table, td, th {padding:5px;border: 1px solid black;}</style>";
		$message .= "<tr><td>Username </td>";
		
		$pieces = explode(",", $username);
		foreach($pieces as $rowsuser){
			$message .= "<td>".$rowsuser." </td>";
		}
		$message .= "</tr>";
		
		$message .= "<tr><td>Password </td>";

		$pieces1 = explode(",", $password);
		foreach($pieces1 as $rowspass){
			$message .= "<td>".$rowspass." </td>";
		}
		
		$message .= "</tr>";

		$message .= "</table>";
		
		
		
		
		$message .= "<p>If you have any questions please submit a support ticket.</p><br/><br/>";

		$message .= "<p>Thanks,</p>";
		$message .= "<p>The SapFund Team,<br/>Where wealth is predictable<br/><br/><br/>";
		
		
		$message .= "<p><b>Do not reply</b> to this email. If you have any questions, please submit a support ticket.<br/>";
		
		$from_email = "info@sapfund.com";
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'From: Sapfund <'.$from_email.'>' . "\r\n";
		
		mail($to,$subject,$message ,$headers);
		
		echo"success";
	
	}
	
	else
	
	{
	echo"error";
	}
	
	
	

?>