<?php
	session_start();
 
	require_once 'connect.php';
 
	if(ISSET($_POST['login'])){
		if($_POST['username'] != " " || $_POST['password'] != " "){
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			$sql = "SELECT * FROM `register` WHERE `email`= '$email' AND `password`= '$password'";
			$query = $conn->prepare($sql);
			$query->execute(array($email,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['email'];
				header("location: dashboard.html");
			} else{
				echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = 'login.html'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'login.html'</script>
			";
		}
	}
?>