<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- start css files -->
            <!-- this link i get it from youtube video to put icon -->
        <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
            <!-- rendear allelement normaly -->
        <link rel="stylesheet" href="css/normalize.css">
            <!-- font Awesome Library -->
        <link rel="stylesheet" href="css/all.min.css">
            <!-- master file -->
        <link rel="stylesheet" href="css/master.css">
        <!-- end css files -->
        <!-- google fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Work+Sans:wght@200;400;600;700&display=swap" rel="stylesheet">
        <!-- end google fonts  -->
    </head>
    <body>
        <div class="signin-page">
            <img src="image/undraw_Mobile_login_9ntv.png" alt="">
            <div class="form-sign">
                <form action="login.php" method="POST" autocomplete="off">
                    <h1>Welcom!</h1>
                    <p>Sign in to your Account</p>
                    <?php
                        if($errors > 0){
                            foreach($errors AS $displayErrors){
                            ?>
                            <div style="color: #A94442; text-align:center; margin-buttom:2rem;"><?php echo $displayErrors; ?></div>
                            <?php
                            }
                        }
                    ?>
                    <input type="email" name="user_email"  placeholder="Enter Your Email" required>
                    <input type="password" name="password" placeholder="Enter Your Password" required>
                    <a href="forgot.php" id="forgot">Forgot password?</a>
                    <input type="submit" name="login" value="Sign in">
                </form>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
    </body>
</html>