<?php
session_start();
$_SESSION['full_name'] = "";
$_SESSION['username'] = "";
$_SESSION['email'] = "";
$_SESSION['password'] = "";
$_SESSION['confirm_password'] = "";
if(empty($_SESSION['email'])) header("location: index.php");
?>