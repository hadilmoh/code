<?php
require 'db.php';
  
  $department_id = mysqli_real_escape_string($con, $_GET['department_id']);
  $department_status = mysqli_real_escape_string($con, $_GET['status']);
  $updatequery1 = "UPDATE departments SET status=$department_status WHERE department_id=$department_id";
  mysqli_query($con,$updatequery1);
  header('location:departments.php');
?>


