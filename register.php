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
    //Verification 
    if (empty($full_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password))
        {
        // echo "Complete all fields";
        ?>
        <script>window.alert("Please fill all the fields.");</script>
    <?php
        }

    // Password match
    if ($password != $confirm_password)
        {
            ?>
        <script>window.alert("Password and confirm password don't match.");</script>
    <?php
        $passmatch = "Passwords don't match";
        }

    // Email validation

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
        $emailvalid = "Enter a  valid email";
        ?>
        <script>window.alert("Please enter a valid email");
    </script>
    <?php
        }

    // Password length
    if (strlen($password) <= 6){
        $passlength="Choose a password longer then 6 character";
        ?>
        <script>
        window.alert("Choose a password longer then 6 character");
        // window.location='register.html';
        </script>
        <?php
        header('location:register.html');
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
        ?>
        <script>window.alert("email exists already.");</script>
    <?php
    }
    else
    {
        // user doesn't exist already, you can safely insert him.
        if(empty($passmatch) && empty($emailvalid) && empty($passlength)) {

        //Securely insert into database
        $sql = "INSERT INTO `register` VALUES ('$full_name', '$username', '$email', '$password', '$confirm_password')";    
        $conn->exec($sql);
        header('location:login.html');
        }
    }

} catch (PDOException $e)
{
    exit($e->getMessage());
}

}
?>