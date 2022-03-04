<?php
session_start();
require_once ('connect.php');
require_once ('config.php');
if(ISSET($_POST['register']))
{
try 
{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    //Verifcation 
    if (empty($full_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password))
        {
        echo "Complete all fields";
        }

    // Password match
    if ($password != $confirm_password)
        {
        echo $passmatch = "Passwords don't match";
        }

    // Email validation

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
        echo $emailvalid = "Enter a  valid email";
        }

    // Password length
    if (strlen($password) <= 6){
        echo $passlength="Choose a password longer then 6 character";
    }
    function userExists($conn,$email)
    {
        $userQuery = ("SELECT * FROM register WHERE email='$email'");
        $stmt = $conn->prepare($userQuery);
        $stmt->execute();
        return !!$stmt->fetch(PDO::FETCH_ASSOC);
    }

    $email = $_POST['email'];
    $exists = userExists($conn,$email);
    if($exists)
    {
        echo "email exists already.";
    }
    else
    {
        // user doesn't exist already, you can savely insert him.
        if(empty($passmatch) && empty($emailvalid) && empty($passlength)) {

        //Securly insert into database
        $sql = "INSERT INTO `register` VALUES ('$full_name', '$username', '$email', '$password', '$confirm_password')";    
        $conn->exec($sql);
        }}

} catch (PDOException $e)
{
    exit($e->getMessage());
}
header('location:login.html');
}
?>