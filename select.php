<?php

require 'db.php';

/* =================================================
================== to show user in modal============ 
====================================================*/


if(isset($_POST["emp_id"]))  
{
    $output = '';


    $query = "SELECT request_user.user_id, users.id, users.name, users.department_id, departments.department_id, departments.department_name
    FROM request_user, users, departments
    WHERE request_user.user_id = users.id AND users.department_id = departments.department_id AND request_id = '".$_POST["emp_id"]."'";  
    $result = mysqli_query($con, $query);  


    $output .= '  
    <div class="table-responsive">  
         <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  
         $output .= '  
              <tr>  
                   <td width="25%">'.$row["id"].'</td>  
                   <td width="25%">'.$row["name"].'</td>  
                   <td width="25%">'.$row["department_name"].'</td> 
              </tr>  
              
              ';  
    }  
    $output .= "</table></div>";  
    echo $output;  

}


/* =================================================
=========== to show department in modal ============ 
====================================================*/


if(isset($_POST["demp_id"]))  
{
    $output = '';


    $query = "SELECT request_department.department_id, departments.department_id, departments.department_name
    FROM request_department, departments
    WHERE request_department.department_id = departments.department_id AND request_id = '".$_POST["demp_id"]."'";  
    $result = mysqli_query($con, $query);  


    $output .= '  
    <div class="table-responsive">  
         <table class="table table-bordered">';  
    while($row = mysqli_fetch_array($result))  
    {  
         $output .= '  
              <tr>  
                   <td width="50%">'.$row["department_id"].'</td>  
                   <td width="50%">'.$row["department_name"].'</td>  
              </tr>  
              
              ';  
    }  
    $output .= "</table></div>";  
    echo $output;  

}


?>