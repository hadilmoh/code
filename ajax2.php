<?php
require 'db.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    
    $id = $_GET['id'];
    

    $query = "SELECT * FROM users WHERE department_id='$id'";
    $query_run = mysqli_query($con, $query);

       echo '<option selected="" value="0">No User</option>';
    while( $row = mysqli_fetch_array($query_run) ){
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
    
}else{
    echo 'error';
}

?>