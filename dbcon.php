<?php

$con = mysqli_connect("localhost","root","","system");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/ticketing/uploads/");

define("FETCH_SRC","http://127.0.0.1/ticketing/uploads/");


?>