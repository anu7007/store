<?php
session_start(); 
require_once 'connect.php';
require_once 'config.php';
$msg = ""; 
if(isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  if($email != "" && $password != "") {
    try {
      $query = "select * from `register` where `email`= '$email' and `password`='$password'";
      $stmt = $conn->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['email']   = $row['email'];
        $_SESSION['full_name'] = $row['full_name'];
        $_SESSION['username'] = $row['username'];
        header('location:dashboard.html');
        echo "Hello"."$username";
      } else {
        echo $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    echo $msg = "Both fields are required!";
  }
}
?>