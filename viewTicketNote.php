<?php 

session_start();
require 'db.php';

// ================ load data note ================ //

if(isset($_POST['note_load_data']))
{
    $code_tk = mysqli_real_escape_string($con, $_POST['code_tk']);

    $comment_query = "SELECT * FROM notes WHERE n_code_tk = '$code_tk'";
    $comment_query_run = mysqli_query($con, $comment_query);

    $array_result = [];

    if(mysqli_num_rows($comment_query_run) > 0)
    {
        foreach($comment_query_run as $row) 
        {
            $user_id = $row['n_user_id'];
            $user_query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($array_result, ['cmt'=>$row, 'user'=>$user_result]);        
        }
        header('content-type: application/json');
        echo json_encode($array_result);
    }
    else 
    {
        echo "NO comments yet!";
    }
}

// ================ insert note to DB ================ //

if(isset($_POST['add_note']))
{
    $code_tk = mysqli_real_escape_string($con, $_POST['code_tk']);
    $note = mysqli_real_escape_string($con, $_POST['note']);
    $user_id = $_SESSION['id'];
   
    $comment_add_query = "INSERT INTO notes (n_code_tk,n_user_id,note) VALUES ('$code_tk','$user_id','$note')";
    $comment_add_query_run = mysqli_query($con, $comment_add_query);

    if($comment_add_query_run)
    {
        header('location: dashboard.php');
    }

    else {
        echo "comment not added something is wrong";
    }
}

?>