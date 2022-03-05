<?php
session_start();
require_once ('connect.php');
require_once ('config.php');
if(ISSET($_POST['register']))
{
    $errors[] = $_SESSION['error'] = "";
    try 
    {
            $full_name = $_SESSION['full_name']= $_POST['full_name'];
            $username = $_SESSION['username']= $_POST['username'];
            $email = $_SESSION['email']= $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            //Verification 
            if (empty($full_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password))
                {
                    $error[] = $_SESSION['error'] = "*Please fill all the fields";
                    header('location:registerHTML.php');
                // echo "Complete all fields";
                
                }

            // Password match
            

            // Email validation

            else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $error[]=$emailvalid = $_SESSION['error'] ="Enter a  valid email";
                    header('location:registerHTML.php');
            
                }

            // Password length
            else if (strlen($password) <= 6){
                $error[]= $passlength=$_SESSION['error'] ="Choose a password longer then 6 character";
                header('location:registerHTML.php');
            }
            //password match
            else if ($password != $confirm_password)
                    {
                    $error[] = $_SESSION = $passmatch = "Passwords don't match";
                    header('location:registerHTML.php');
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
                $error[] = $_SESSION['error'] ="*Email already exists. Try with a different email";
                header('location:registerHTML.php');
            }
            else
            {
                // user doesn't exist already, you can safely insert him.
                if(empty($passmatch) && empty($emailvalid) && empty($passlength)) {

                //Securely insert into database
                $sql = "INSERT INTO `register` VALUES ('$full_name', '$username', '$email', '$password', '$confirm_password')";    
                $conn->exec($sql);
                header('location:loginHTML.php');
                }
            }

    } //try
    catch (PDOException $e)
    {
        exit($e->getMessage());
    }

}//if
?>