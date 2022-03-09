<?php
session_start();
require_once 'connect.php';
require_once 'config.php';
if (isset($_GET['status'])) {
    $statusName=$_GET['statusName'];
    $id=$_GET['status'];
    if ($statusName=="pending") {
        $query1 = "update register set status = 'approved' where ID = '$id'";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute();
        header('location:customers.php');
    } else {
        $query1 = "update register set status = 'pending' where ID = '$id'";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute();
        header('location:customers.php');
    }
} elseif (isset($_GET['delete'])) {
    $id=$_GET['delete'];
    $query1 = "DELETE from register where ID = '$id'";
    $stmt1 = $conn->prepare($query1);
    $stmt1->execute();
    header('location:customers.php');
}
