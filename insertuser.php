<?php

require 'db.php';

// insert User

if(isset($_POST['save_user']))
{

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $permission = mysqli_real_escape_string($con, $_POST['permission']);
    $setting_joptitle = mysqli_real_escape_string($con, $_POST['setting_joptitle']);
    $department_id = mysqli_real_escape_string($con, $_POST['department_id']);
    $Direct_manager = mysqli_real_escape_string($con, $_POST['Direct_manager']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $email_check = "SELECT * FROM users WHERE user_email = '$user_email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $res = [
            'status' => 112,
            'message' => 'Email that you have entered is already exist!'
        ];
        echo json_encode($res);
        return;
    }
    
    $pass_check = "SELECT * FROM users WHERE id = '$id'";
    $res = mysqli_query($con, $pass_check);
    if(mysqli_num_rows($res) > 0){
        $res = [
            'status' => 212,
            'message' => 'ID that you have entered is already exist!'
        ];
        echo json_encode($res);
        return;
    }

    if($id != 0 && $name != NULL && $Direct_manager == 0 && $department_id != 0){
        $res = [
            'status' => 422,
            'message' => 'The field Direct_manager is empty'
        ];
        echo json_encode($res);
        return;
    }

    if($id != 0 && $name != NULL && $setting_joptitle == 0){
        $res = [
            'status' => 300,
            'message' => 'select joptitle'
        ];
        echo json_encode($res);
        return;
    }

    $subject = 'Email ticketing-system password';
    $message = "The password for ticketing-system is $password";
    $sender = 'From: sajamma1998@gmail.com';

    if (mail($user_email, $subject, $message, $sender)) {

        $password = mysqli_real_escape_string($con, md5($_POST['password']));
        $query = "INSERT INTO `users`(`id`, `name`, `password`,  `user_email`, `permission`, `setting_joptitle`, `department_id`, `Direct_manager`) 
        VALUES ('$id','$name','$password','$user_email','$permission','$setting_joptitle', '$department_id' , '$Direct_manager' )";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $quer = "INSERT INTO direct_manager (manager_name, manager_id) VALUE ('$name','$id')";
        $query_ru = mysqli_query($con, $quer);

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

}else{
    $res = [
        'status' => 420,
        'message' => 'This user cannot be saved. Connect to the Internet and try again!'
    ];
    echo json_encode($res);
    return;
}

}



 // View Data
if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT  *  FROM users WHERE id='$id' ";
    $query_run = mysqli_query($con,$query);
   
    if(mysqli_num_rows($query_run) == 1)
    {
        $user = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $user
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

// Update User

if(isset($_POST['update_user']))
{
   

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $permission = mysqli_real_escape_string($con, $_POST['permission']);
    $setting_joptitle = mysqli_real_escape_string($con, $_POST['setting_joptitle']);
    $department_id = mysqli_real_escape_string($con, $_POST['department_id']);
    $Direct_manager = mysqli_real_escape_string($con, $_POST['Direct_manager']);

    if($id != 0 && $name != NULL && $Direct_manager == 0 && $department_id != 0){
        $res = [
            'status' => 422,
            'message' => 'The field Direct_manager is employee'
        ];
        echo json_encode($res);
        return;
    }else{
        $query = "UPDATE users SET `id`='$id', `name`='$name' , user_email='$user_email', permission='$permission' , setting_joptitle='$setting_joptitle', department_id='$department_id', Direct_manager='$Direct_manager' 
        WHERE id='$id'";
    }

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



?>



