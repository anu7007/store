<?php
$servername = "mysql-server";
$username = "root";
$password = "secret";

try {
    $conn = new PDO("mysql:host=$servername;dbname=store", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
