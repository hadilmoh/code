<?php
session_start();

require 'db.php';
    // dbcon Created Successfully

    // Store All Errors
    $errors = [];


    
    // if login Button clicked so

    if (isset($_POST['login'])) {
        $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
        $password = md5($_POST['password']);

        $user_emailQuery = "SELECT * FROM users WHERE user_email = '$user_email'";
        $user_email_check = mysqli_query($con, $user_emailQuery);

        if (mysqli_num_rows($user_email_check) > 0) {
            $passwordQuery = "SELECT * FROM users WHERE user_email = '$user_email' AND password = '$password'";
            $password_check = mysqli_query($con, $passwordQuery);
            if (mysqli_num_rows($password_check) > 0) {
                $fetchInfo = mysqli_fetch_assoc($password_check);
                $status = $fetchInfo['status'];
                $name = $fetchInfo['name'];
                $_SESSION['name'] = $name;
                $_SESSION['id'] = $fetchInfo['id'];
                $_SESSION['user_email'] = $fetchInfo['user_email'];
                $_SESSION['password'] = $fetchInfo['password'];
                $_SESSION['permission'] = $fetchInfo['permission'];
                $_SESSION['department_id'] = $fetchInfo['department_id'];
                $_SESSION['Direct_manager'] = $fetchInfo['Direct_manager'];
                if ($status === '1') {
                    header('location: dashboard.php');
                } else {
                    $errors['user_email'] = 'This email is not activated';
                }
            } else {
                $errors['user_email'] = 'Password did not matched';
            }
        } else {
            $errors['user_email'] = 'Invalid email Address';
        }
    } 

    // if forgot button will clicked
    if (isset($_POST['forgot_password'])) {
        $user_email = $_POST['user_email'];
        $_SESSION['user_email'] = $user_email;

        $user_emailCheckQuery = "SELECT * FROM users WHERE user_email = '$user_email'";
        $user_emailCheckResult = mysqli_query($con, $user_emailCheckQuery);

        // if query run
        if ($user_emailCheckResult) {
            // if user_email matched
            if (mysqli_num_rows($user_emailCheckResult) > 0) {
                $code = rand(999999, 111111);
                $updateQuery = "UPDATE users SET code = $code WHERE user_email = '$user_email'";
                $updateResult = mysqli_query($con, $updateQuery);
                if ($updateResult) {
                    $subject = 'email Verification Code';
                    $message = "our verification code is $code";
                    $sender = 'From: sajamma1998@gmail.com';

                    if (mail($user_email, $subject, $message, $sender)) {
                        $message = "We've sent a verification code to your email <br> $user_email";

                        $_SESSION['message'] = $message;
                        header('location: verifyuser_email.php');
                    } else {
                        $errors['otp_errors'] = 'Failed while sending code!';
                    }
                } else {
                    $errors['db_errors'] = "Failed while inserting data into database!";
                }
            }else{
                $errors['invaliduser_email'] = "Invalid mail Address";
            }
        }else {
            $errors['db_error'] = "Failed while checking email from database!";
        }
    }
if(isset($_POST['verifyuser_email'])){
    $_SESSION['message'] = "";
    $OTPverify = mysqli_real_escape_string($con, $_POST['OTPverify']);
    $verifyQuery = "SELECT * FROM users WHERE code = $OTPverify";
    $runVerifyQuery = mysqli_query($con, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            $newQuery = "UPDATE users SET code = 0";
            $run = mysqli_query($con,$newQuery);
            header("location: newPassword.php");
        }else{
            $errors['verification_error'] = "Invalid Verification Code";
        }
    }else{
        $errors['db_error'] = "Failed while checking Verification Code from database!";
    }
}

// change Password
if(isset($_POST['changePassword'])){
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);
    
    if (strlen($_POST['password']) < 8) {
        $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
    } else {
        // if password not matched so
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['password_error'] = 'Password not matched';
        } else {
            $user_email = $_SESSION['user_email'];
            $updatePassword = "UPDATE users SET password = '$password' WHERE user_email = '$user_email'";
            $updatePass = mysqli_query($con, $updatePassword) or die("Query Failed");
            
            session_destroy();
            header('location: login.php');
        }
    }
}