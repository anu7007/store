<?php
session_start();
if(isset($_POST['update'])){
    $full_name = $_SESSION['full_name']= $_POST['full_name'];
    $username = $_SESSION['username']= $_POST['username'];
    $email = $_SESSION['email']= $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if($password != $confirm_password){
        $_SESSION['updateMsg'] = "Passwords don't match";
        header('location:registerHTML.php');
    }
    $_SESSION['updateMsg']="Successfully Updated";
    header('location:profile.php');
}
?>