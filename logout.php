<?php
session_start();
if (isset($_SESSION)) {
    $_SESSION['full_name'] = "";
    $_SESSION['username'] = "";
    $_SESSION['email'] = "";
    $_SESSION['password'] = "";
    $_SESSION['confirm_password'] = "";
    unset($_SESSION);
    if (empty($_SESSION)) {
        session_destroy();
        header("location: loginHTML.php");
    }
} else {
    echo "Session Expired!!";
}
