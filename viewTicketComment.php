<?php 

session_start();
require 'db.php';


// ================ load data comment ================ //

if(isset($_POST['comment_load_data']))
{
    $code_tk = mysqli_real_escape_string($con, $_POST['code_tk']);

    $comment_query = "SELECT * FROM comments WHERE code_tk = '$code_tk'";
    $comment_query_run = mysqli_query($con, $comment_query);

    $array_result = [];

    if(mysqli_num_rows($comment_query_run) > 0)
    {
       
        foreach($comment_query_run as $row) 
        {
            $user_id = $row['user_id'];
            $customer_id = $row['customer_id'];
            if($user_id != NULL)
            {
                $user_query = "SELECT name FROM users WHERE id = '$user_id' LIMIT 1";
                $user_query_run = mysqli_query($con, $user_query);
                $user_result = mysqli_fetch_array($user_query_run);

                
                array_push($array_result, ['cmt'=>$row, 'user'=>$user_result, 'type'=>$row]); 
            }
            else 
            {
                $user_query = "SELECT name FROM customers WHERE c_id = '$customer_id' LIMIT 1";
                $user_query_run = mysqli_query($con, $user_query);
                $user_result = mysqli_fetch_array($user_query_run);

                array_push($array_result, ['cmt'=>$row, 'user'=>$user_result, 'type'=>$row]);
            }
                   
        }
        header('content-type: application/json');
        echo json_encode($array_result);
    }
    else 
    {
        echo "NO comments yet!";
    }
}

// ================ insert comment to DB ================ //

if(isset($_POST['add_comment']))
{
    $code_tk = mysqli_real_escape_string($con, $_POST['code_tk']);
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    $cust = mysqli_real_escape_string($con, $_POST['customer']);


        $user_id = $_SESSION['id'];  
        $comment_add_query = "INSERT INTO comments (user_id,code_tk,msg,type) VALUES ('$user_id','$code_tk','$msg','user')";
        $comment_add_query_run = mysqli_query($con, $comment_add_query);


    if($comment_add_query_run) {
        header('location: dashboard.php');
    }

    else {
        echo "comment not added something is wrong";
    }
}

//=============//

if(isset($_POST['add_comment_cus']))
{
    $code_tk = mysqli_real_escape_string($con, $_POST['code_tk']);
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    $cust = mysqli_real_escape_string($con, $_POST['customer']);
    $id_user = mysqli_real_escape_string($con, $_POST['user']);
    $id_Ticker = mysqli_real_escape_string($con, $_POST['id_tk']);

        $comment_add_query = "INSERT INTO comments (customer_id,code_tk,msg,type) VALUES ('$cust','$code_tk','$msg','customer')";
        $comment_add_query_run = mysqli_query($con, $comment_add_query);

    if($comment_add_query_run) {
        $query = "INSERT INTO `notifications`(`link` ,`text`, `us_id`)
        VALUES ('http://localhost/ticketing/view_ticket.php?ticket_id=$id_Ticker','New message','$id_user')";
        mysqli_query($con, $query);
    }

    else {
        echo "comment not added something is wrong";
    }
}

//-----------------------------------------------------------------------------//

?>