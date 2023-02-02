<?php
  require 'db.php';
  
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $status = mysqli_real_escape_string($con, $_GET['status']);
  $updatequery2 = "UPDATE users SET status=$status WHERE id=$id";
  mysqli_query($con,$updatequery2);
  header('location:user.php');
?>