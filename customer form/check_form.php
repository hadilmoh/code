<?php

require '../dbcon.php';

// insert Department

if(isset($_POST['send_request']))
{
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $issu = mysqli_real_escape_string($con, $_POST['issu']);
    $Description = mysqli_real_escape_string($con, $_POST['Description']);
    $Name = mysqli_real_escape_string($con, $_POST['name']);
    $Gmail = mysqli_real_escape_string($con, $_POST['email']);
    $Phone = mysqli_real_escape_string($con, $_POST['Phone']);
    $id_customers = mysqli_real_escape_string($con, $_POST['id_customers']);

    if($issu == "")
    {
        $res = [
            'status' => 421,
            'message' => 'select your issue please'
        ];
        echo json_encode($res);
        return;
    }

    $email_check = "SELECT * FROM customers WHERE email = '$Gmail'";
    $re = mysqli_query($con, $email_check);
    if(mysqli_num_rows($re) > 0)
    {
        $fetchInfo = mysqli_fetch_assoc($re);
        $id_customers = $fetchInfo['c_id'];
    }
    else
    {
        $id_customers = mysqli_real_escape_string($con, $_POST['id_customers']);
        $que = "INSERT INTO `customers`(`c_id`,`name`, `email`, `phone`) 
                VALUES ('$id_customers','$Name','$Gmail','$Phone')";
                mysqli_query($con,$que);
    }

    $quer = 'SELECT requests.id, requests.day, requests.hour ,requests.priority, request_department.department_id, request_department.request_id
    FROM requests, request_department
    Where request_department.request_id = requests.id';
     $query_ru = mysqli_query($con, $quer);
     if(mysqli_num_rows($query_ru) > 0)
     {

        foreach($query_ru as $ticket)
        {
            if($ticket['request_id'] == $issu)
            {
                $day= ($ticket['day'] * 24) + $ticket['hour'];
                $priority=$ticket['priority'];
                $department_id=$ticket['department_id'];
                $query = "INSERT INTO `ticket`(`code`, `request`, `description`, `time`, `priority`, `department`, `customers`) 
                          VALUES ('$code','$issu','$Description','$day','$priority','$department_id','$id_customers')";
                $query_run = mysqli_query($con,$query);

          }
        }
        
        $q="SELECT * FROM ticket WHERE code='$code' AND description='$Description'";
                $query_r = mysqli_query($con,$q);
                foreach($query_r as $t){
                $id=$t['ticket_id'];
                $subject = 'Track your service request here';
                $message = "http://localhost/ticketing/view_ticket.php?ticket_id=$id";
                $sender = 'From: sajamma1998@gmail.com';
                mail($Gmail, $subject, $message, $sender);
                break;
            }

        if($query_run)
        {
              $s = "SELECT user_id FROM request_user WHERE request_id = '$issu'";
              $q = mysqli_query($con, $s);
              if(mysqli_num_rows($q) > 0)
              {
                foreach($q as $t)
                {
                  $id_u= $t['user_id'];
                  $qu = "INSERT INTO `notifications`(`text`, `us_id`)
                  VALUES ('A new ticket has arrived','$id_u')";
                  mysqli_query($con, $qu);
                }
              }
        }

        $res = [
            'status' => 200,
            'message' => 'The ticket is success added And Track your service request for your gmail'
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
    
    ?>