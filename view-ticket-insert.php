<?php
session_start();

require 'db.php';

if(isset($_POST['idUser']) && !empty($_POST['tkID'])){
    
    $id = $_POST['idUser'];
    $tk_id = $_POST['tkID'];

    $query = "UPDATE ticket SET user = '$id' WHERE ticket_id = '$tk_id'";
    $query_run = mysqli_query($con, $query);

    $query_ass = "SELECT * FROM ticket WHERE ticket_id = '$tk_id'";
    $query_run_ass = mysqli_query($con, $query_ass);
    foreach($query_run_ass as $q){
        $user = $q['user'];
    $qu = "INSERT INTO `notifications`(`link` ,`text`, `us_id`)
    VALUES ('http://localhost/ticketing/view_ticket.php?ticket_id=$tk_id','A New Ticket Assigned To You,','$user')";
     $qu_run = mysqli_query($con, $qu);
    }

}

if(isset($_POST['status_tk']) && !empty($_POST['tkID']) && !empty($_POST['code'])) {

    $status_tk = $_POST['status_tk'];
    $tk_id = $_POST['tkID'];
    $code = $_POST['code'];

    $query_st = "UPDATE ticket SET `status` = '$status_tk' WHERE ticket_id = '$tk_id'";
    $query_run_st = mysqli_query($con, $query_st);


    $query_status = "SELECT * FROM ticket  WHERE ticket_id = '$tk_id' AND `status` = 'Closed'";
    $query_status_run = mysqli_query($con, $query_status);
        if(mysqli_num_rows($query_status_run) > 0){

              $s = "SELECT * FROM ticket  WHERE code = '$code' ";
              $q = mysqli_query($con, $s);
                foreach($q as $t)
                {
                    if($t['ticket_id'] != $tk_id){
                        
                    $id_Ticker = $t['ticket_id'];
                    $id_u = $t['user'];

                  $qu = "INSERT INTO `notifications`(`link` ,`text`, `us_id`)
                  VALUES ('http://localhost/ticketing/view_ticket.php?ticket_id=$id_Ticker','The Ticket in a same request is closed','$id_u')";
                  mysqli_query($con, $qu);
                }
                }
        }

    $s=0;
    $r=0;

    $q = "SELECT * FROM ticket  WHERE code = '$code'";
    $q_run = mysqli_query($con , $q);
    foreach($q_run as $code){
        $s++;
    if($code['status'] == 'Closed'){
        $r++;
    }
    }


    if($r === $s){

        $query = "SELECT customers.email, customers.c_id, ticket.customers, ticket.ticket_id
                  FROM ticket , customers
                  WHERE ticket.ticket_id = '$tk_id'
                  AND customers.c_id = ticket.customers";
        $query_status_run = mysqli_query($con , $query);
                foreach($query_status_run as $status){

                $Gmail=$status['email'];
                
                $subject = 'Your request has been completed. Thank you for dealing with us.';
                $message = "http://localhost/ticketing/view_ticket.php?ticket_id=$tk_id";
                $sender = 'From: sajamma1998@gmail.com';
                mail($Gmail, $subject, $message, $sender);
                break;
            }

    }
 
}


if(isset($_POST['user_assigned']) && !empty($_POST['tkID'])) {

    $assigne_tk = $_POST['user_assigned'];
    $tk_id = $_POST['tkID'];

    $query_valid = "SELECT * FROM ticket WHERE ticket_id = '$tk_id'";
    $query_valid_run = mysqli_query($con, $query_valid);
    $result = $query_valid_run->fetch_assoc();

    if($result['user'] == 0){
        $query_ass = "UPDATE ticket SET `user` = '$assigne_tk' WHERE ticket_id = '$tk_id'";
        $query_run_ass = mysqli_query($con, $query_ass);

        if($query_run_ass){
            $res = [
                'status' => 150,
                'message' => 'The ticket is assigned'
            ];
            echo json_encode($res);
            return;
        }
    }
                

    if($result['user'] != 0 && $result['user'] != $_SESSION['id']) { 

        $res = [
            'status' => 200,
            'message' => 'Is already assigned to another user'
        ];
        echo json_encode($res);
        return;
    }
    if($result['user'] == $_SESSION['id']){
        $res = [
            'status' => 220,
            'message' => 'Is already assigned to you'
        ];
        echo json_encode($res);
        return;
    }


}


?>
