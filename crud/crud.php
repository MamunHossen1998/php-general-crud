<?php
include_once('../db/db_connect.php');
session_start();
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $photo = $_FILES['photo'];
       
        $msg   = '';
        $error = false;
        if(empty($fname)){
            $msg = 'Please enter the first name';
            $error = 1;
        }
        elseif(empty($error) && !$lname){ 
            $msg = "Please enter the last name";
            $error =1;
        }
        elseif(empty($error)&& !$photo['name']){
            $msg = "Please enter the photo";
            $error = 1;
        }
        if(!$error){
            if($photo['name']){
                $after_explode = explode('.',$photo['name']);
                $extention = $after_explode[1];
                if($conn){
                    $insert_query = "INSERT INTO `students`(`fname`, `lname`) VALUES ('$fname','$lname')";
                    $insert = mysqli_query($conn,$insert_query);
                    $last_id = mysqli_insert_id($conn);
                    if($last_id){
                        $image_name = $last_id.'.'.$extention;
                        $dest_path = '../images/' . $image_name;
                        move_uploaded_file($photo['tmp_name'], $dest_path);
                        $update_query = "UPDATE `students` SET `photo`='$image_name' WHERE id= '$last_id'";
                        $update = mysqli_query($conn, $update_query);
                        if($update){
                            $_SESSION['success_msg'] = 'Data insert sucessfully !';
                            header("Location:../index.php");
                        }
                    }
                    exit;
                }
                
            }
        }else{
            $_SESSION['data'] = $_POST;
            header("Location:../index.php?msg=".$msg);
        }

        
       
    }




?>