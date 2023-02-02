<?php
session_start();
require 'dbcon.php';

function img_upload($img){
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111,99999).$img['name_company'];

    $new_loc = UPLOAD_SRC.$new_name;

    if(!move_uploaded_file($tmp_loc,$new_loc)){
        header("location: edit-profile.php?alert=img_upload");
        exit;
    }else{
        return $new_name;
    }
}



if(isset($_POST['editcompany'])){
    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value);
    }

    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
        $query="SELECT * FROM company WHERE id=$_POST[editpid]";
        $result=mysqli_query($con,$query);
        $fetch=mysqli_num_rows($result);

        $imgpath=img_upload($_FILES['image']);

        $update="UPDATE `company` SET `name_company`='$_POST[name_company]',`image`='$imgpath' WHERE `id`='$_POST[editpid]'";
        
    }else{
        $update="UPDATE `company` SET `name_company`='$_POST[name_company]' WHERE `id`='$_POST[editpid]'";

    }
    if(mysqli_query($con,$update)){
        header("location: edit-profile.php?success=updated");
    }else{
        header("location: edit-profile.php?alert=updated_failled");
    }
}

