<?php
require 'db.php';

if(isset($_GET['idjop']) && !empty($_GET['idjop'])){
    
    $id = $_GET['idjop'];
    $id1=$id+1;

    $query = "SELECT * FROM users WHERE setting_joptitle='$id1' AND status='1'";
    $query_run = mysqli_query($con, $query);

       echo '<option selected="" value="0">No Direct_Manager</option>';
    while( $row = mysqli_fetch_array($query_run) ){
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
    
}else{
    echo 'error';
}

?>