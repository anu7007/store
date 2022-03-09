<?php
session_start();
require_once ('connect.php');
require_once ('config.php');
if (isset($_POST['update'])) {
    try {
        $full_name = $_SESSION['full_name']= $_POST['full_name'];
        $username = $_SESSION['username']= $_POST['username'];
        $email = $_SESSION['email']= $_POST['email'];
        $password = $_SESSION['password']=$_POST['password'];
        $confirm_password = $_SESSION['confirm_password']=$_POST['confirm_password'];
        if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
            $_SESSION['updateMsg'] = $emptycheck = "*Please fill all the fields";
            header('location:profile.php');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailvalid = $_SESSION['updateMsg'] =$emailValidCheck ="Enter a  valid email";
            header('location:profile.php');

        } elseif (!empty($password) || !empty($confirm_password)) {
            if (!($password == $confirm_password)) {
                    $_SESSION['updateMsg'] = $passCheck = "Passwords don't match";
                    header('location:profile.php');
            } elseif (strlen($password) <= 6) {
                    $passlength = $_SESSION['updateMsg'] = $lenCheck ="Choose a password longer than 6 character";
                    header('location:profile.php');
            } else {
            // user doesn't exist already, you can safely insert him.
                if (empty($lenCheck) && empty($passCheck) && empty($emailValidCheck) && empty($emptycheck)) {
                //Securely update in the database
                        $sql = "UPDATE `register` SET full_name = '$full_name', username = '$username', 
                        email = '$email', password = '$password', confirm_password = '$confirm_password'
                        where email = '$email'" ;
                        $conn->exec($sql);
                        $_SESSION['updateMsg'] ="*Record Updated Successfully !!";
                        header('location:profile.php');
                } else {
                    $_SESSION['error']="Some Error Occured";
                    header('location:profile.php');
                }
            }
        }
    } //try
    catch (PDOException $e) {
        exit($e->getMessage());
    }
}
