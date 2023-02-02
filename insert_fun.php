<?php

require 'db.php';

// insert Department

if(isset($_POST['save_department']))
{
    $department_id = mysqli_real_escape_string($con, $_POST['department_id']);
    $department_name = mysqli_real_escape_string($con, $_POST['department_name']);

     $id_dep ="SELECT * FROM departments WHERE department_id = '$department_id'"; 
     $res= mysqli_query($con,$id_dep);
     if(mysqli_num_rows($res) > 0){
         $res =[
             'status' => 112,
             'message' => 'Department that you have entered is already exist!'
          ];
         echo json_encode($res);
         return;
     }

     if($department_id == NULL || $department_name == NULL )
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO  `departments` (`department_id`, `department_name`) VALUES ('$department_id','$department_name')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Request Created Successfully'
        ];
        echo json_encode($res);
        return;
        
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Request Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

 // View Data
if(isset($_GET['department_id']))
{
    $department_id = mysqli_real_escape_string($con, $_GET['department_id']);
    $query = "SELECT  *  FROM departments WHERE department_id='$department_id'";
    $query_run = mysqli_query($con,$query);
   
    if(mysqli_num_rows($query_run) == 1)
    {
        $department = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Depatment Fetch Successfully by id',
            'data' => $department
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Depatment Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

// Update Department

if(isset($_POST['update_department']))
{
   

    $department_id = mysqli_real_escape_string($con, $_POST['department_id']);
    $department_name = mysqli_real_escape_string($con, $_POST['department_name']);

    if($department_name == NULL )
    {
        $res = [
            'status' => 422,
            'message' => 'Enter department name'
        ];
        echo json_encode($res);
        return;
    }

    $query1 = "SELECT department_name FROM departments WHERE department_name='$department_name'";
    $query_run1 = mysqli_query($con,$query1);
    if(mysqli_num_rows($query_run1) > 0)
    {
        $res = [
            'status' => 423,
            'message' => 'Department that you have entered is already exist!',
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE departments SET department_id='$department_id', department_name='$department_name' WHERE department_id='$department_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Department Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Department Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



?>



