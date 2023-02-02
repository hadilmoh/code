<?php 
if(isset($_SESSION['password']) && isset($_SESSION['user_email'])){
    require_once('db.php');

	if (isset($_POST['op']) && isset($_POST['np'])
		&& isset($_POST['c_np'])) {

		function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}

		$op = validate(md5($_POST['op']));
		$np = validate(md5($_POST['np']));
		$c_np = validate(md5($_POST['c_np']));

	    if($np !== $c_np){
			header("location: setting1.php?error= new password is not similar");
			exit();
		}else {
			$id = $_SESSION['id'];
        
			$sql = "SELECT password FROM users WHERE id='$id' AND password='$op'";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result) === 1){
				$sql_2 = "UPDATE users  SET password='$np' WHERE id='$id'";
				$result_2 = mysqli_query($con,$sql_2);
				header("location: setting1.php?success=change password successfully");
				exit();
			}else{
				header("location: setting1.php?error=your password is incorrect");
				exit();
			}
		}

	}else{
		header("Location: setting1.php");
		exit();
	}

	}else{
     header("Location: login.php");
     exit();
}

    ?>