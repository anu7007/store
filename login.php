<?php
session_start();
require_once 'connect.php';
require_once 'config.php';
$_SESSION['msg'] = " ";
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if ($email != "" && $password != "") {
        try {
            $query = "select * from `register` where `email`= '$email' and `password`='$password'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {
                $_SESSION['email']   = $row['email'];
                $_SESSION['full_name'] = $row['full_name'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['loginmail'] = $_POST['email'];
                $_SESSION['loginpassword'] = $_POST['password'];
                if ($row['role'] == "admin" && $row['status'] == "approved") {
                    header('location:dashboard.php');
                } elseif ($row['role'] == "user" && $row['status'] == "approved") {
                    header('location:profile.php');
                } else {
                    $_SESSION['msg'] = "Your Request is in Queue." . '<br>' . "Kindly wait for Approval" . '<br><br>';
                    header('location:loginHTML.php');
                }
            } else {
                $msg = $_SESSION['msg'] = "*Invalid username and password!" . '<br><br>';
                header('location:loginHTML.php');
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
        $msg = $_SESSION['msg'] = "*Both fields are required!" . "<br><br>";
        header('location:loginHTML.php');
    }
}
