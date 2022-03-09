<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Sign Up</title>    

    <!-- Bootstrap core CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="register.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="register.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Create an Account</h1>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Full Name" name="full_name" 
      value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>">
      <label for="floatingInput">Full Name</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control mt-1" id="floatingInput" placeholder="UserName" name="username" 
      value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control mt-1" id="floatingInput" placeholder="Email" name="email"
       value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control mt-1" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingInput">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control mt-1" id="floatingPassword" 
      placeholder="Confirm_Password"name="confirm_password">
      <label for="floatingInput">Confirm Password</label>
    </div>
    </div>
    <span class="registerError">
        <?php
        echo isset($_SESSION['error']) ? $_SESSION['error'] : '';
      //  echo isset($_SESSION['error1']) ? $_SESSION['error1'] : '';
        ?>
       <br>
    </span>
    <input type="submit" name="register" value="Sign Up" class="registerbtn">
    <!-- <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Sign Up</button> -->
    <p class="text-center text-muted mt-5 mb-0">Already have an account? 
      <a href="loginHTML.php" class="fw-bold text-body"><u>Login here</u></a></p>

    <p class="mt-5 mb-3 text-muted">&copy; CEDCOSS Technologies</p>
  </form>
</main>
</body>
</html>