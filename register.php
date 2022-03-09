<?php
session_start();
include 'connect.php';
include 'config.php';
if (isset($_POST['register'])) {
    $_SESSION['error']="";
    try {
        $full_name = $_SESSION['full_name'] = $_POST['full_name'];
        $username = $_SESSION['username'] = $_POST['username'];
        $email = $_SESSION['email'] = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        function userExists($conn, $email)
        {
            $stmt = $conn->prepare("SELECT * FROM `register` WHERE `email` = '$email'");
            $stmt->execute();
            $found = $stmt->fetchColumn();

            if ($found) {
                return true;
            } else {
                return false;
            }
        } //function
        $exists = userExists($conn, $email);
        if (empty($full_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $error[] = $_SESSION['error'] = "*Please fill all the fields";
            header('location:registerHTML.php');
            // echo "Complete all fields";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = $emailvalid = $_SESSION['error'] = "Enter a  valid email";
            header('location:registerHTML.php');
        } elseif (strlen($password) <= 6) {
            $error[] = $passlength = $_SESSION['error'] = "Choose a password longer than 6 character";
            header('location:registerHTML.php');
        } elseif ($password != $confirm_password) {
            $error[] = $_SESSION['error'] = $passmatch = "Passwords don't match";
            header('location:registerHTML.php');
        } elseif ($exists) {
            $error[] = $_SESSION['error'] = "*Email already exists. Try with a different email";
            header('location:registerHTML.php');
        } else {
            // user doesn't exist already, you can safely insert him.
            if (empty($passmatch) && empty($emailvalid) && empty($passlength)) {
                //Securely insert into database
                $sql = "INSERT INTO register (full_name, username, email, password, confirm_password, status, role) 
                VALUES 
                ('$full_name', '$username', '$email', '$password', '$confirm_password','pending','user')";
                $conn->exec($sql);
                header('location:loginHTML.php');
            } else {
                $_SESSION['error'] = "Some Error Occured";
            }
        }
    } //try
    catch (PDOException $e) {
        exit($e->getMessage());
    }
}//
