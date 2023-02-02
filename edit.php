<?php  

require 'db.php';

$id = $_POST["id"];   
$column_name = $_POST["column_name"];  
$sql = "UPDATE setting_joptitle SET jopTitle_id='$id',jopTitle_name='$column_name' WHERE jopTitle_id='$id'";  
if(mysqli_query($con, $sql))  
{  
	echo 'Data Updated';  
}  
?>