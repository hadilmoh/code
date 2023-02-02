<?php

require 'db.php';

$sql = "UPDATE notifications SET status='1'";
$res = mysqli_query($con, $sql);
if ($res) {
  echo "Success";
} else {
  echo "Failed";
}