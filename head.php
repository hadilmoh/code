<?php 
require 'db.php';
?>
<html>
<!DOCTYPE html>
<html lang="en"> <!-- dir="rtl" -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/master.css">
    </head>

        <div class="head">
            <label></label>
            <div class="icons">
                <nav class="navbar">
                    <ul>
                        <li>
                            <?php
                            $id = $_SESSION['id'];
                            $sql = "SELECT * FROM notifications WHERE us_id = $id ORDER BY id DESC";
                            $res = mysqli_query($con, $sql); 

                            $sq = "SELECT * FROM notifications WHERE status='0' AND us_id = $id";
                            $re = mysqli_query($con, $sq);?>
                            <a class="p-0" href="#" id="notifications">
                              <label class="notific" for="check">
                                  <i class="fa-regular fa-bell" aria-hidden="true"></i>
                                  <span class="count"><?php echo mysqli_num_rows($re); ?></span>
                              </label>
                            </a>
                            <input type="checkbox" class="dropdown-check" id="check"/>
                            <ul class="dropdown">
                                <div class="notific-head">
                                    <i class="fa-solid fa-circle"></i> Notification
                                </div>
                                <div class="notific-body">
                                    <?php
                                    if (mysqli_num_rows($res) > 0) {
                                        foreach ($res as $item) {
                                            if ($item["status"] == 0){
                                        ?>
                                        <li style="background-color: #4d4dff2e;">
                                            <a href="<?= $item["link"]?>"><?php echo $item["text"] ?>
                                                <h6 style="color: #aaa; font-size:7px;"><?php echo $item["time"]; ?></h6>
                                            </a>
                                        </li>
                                        <?php 
                                        }else {
                                            ?>
                                        <li>
                                            <a href="<?= $item["link"]?>"><?php echo $item["text"] ?>
                                                <h6 style="color: #aaa; font-size:7px;"><?php echo $item["time"]; ?></h6>
                                            </a>
                                        </li>
                                        <?php 
                                        }}
                                    } 
                                    ?>
                                </div>                                
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div  style="font-family: 'Anton', sans-serif; margin-left:20px;">
                    <?php
                    if(isset($_SESSION['name'])){
                        ?> <span class="text-secondary">Hi, </span> <?php echo  $_SESSION['name'];
                    }
                    ?>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#notifications").on("click", function() {
        $.ajax({
          url: "readNotifications.php",
          success: function(res) {
            console.log(res);
          }
        });
      });
    });
  </script>
  </html>
  <?php 