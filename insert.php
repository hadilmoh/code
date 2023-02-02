<?php  

require 'db.php';

$id = mysqli_real_escape_string($con,$_POST["jopTitle_id"]);
$name = mysqli_real_escape_string($con,$_POST["jopTitle_name"]);
// $id_job ="SELECT * FROM setting_joptitle WHERE jopTitle_id = '$id'"
// $res = mysqli_query($con,$id_job);
// if(mysqli_num_rows($res) > 0){
//      $res =[
//           'status' => 112,
//           'message' => 'Job Title that you have entered is already exist!'
//      ];
//      echo json_encode($rea);
//      return;
// }
$sql = "INSERT INTO setting_joptitle(jopTitle_id, jopTitle_name) VALUES('$id','$name')";  
if(mysqli_query($con, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>