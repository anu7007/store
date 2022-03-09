<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo 'Kindly  <a href="loginHTML.php">Login</a>  to view your Profile<?php';
} else {
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>My Profile</title>

  <!-- Bootstrap core CSS -->
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link href="register.css" rel="stylesheet"> -->
  </style>


  <!-- Custom styles for this template -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>My Profile</title>

  <!-- Bootstrap core CSS -->
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link href="register.css" rel="stylesheet"> -->
  </style>


  <!-- Custom styles for this template -->

</head>

<body class="text-center">
  <h1 class="h3 mb-3 fw-normal">MyAccount</h1>
  <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" 
    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" 
    aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php
    if (isset($_SESSION['username'])) {
    ?>
      <div class="navbar-nav">
        <div class="nav-item text-nowrap text-white btn bg-secondary pt-2 pb-2  px-5 mr-2">
        <?php
        echo "Welcome," . "  " . strtoupper($_SESSION['username']) . "  !";
    } else {
        echo '';
    }
        ?>
        </div>
      </div>

      <div class="navbar-nav">
        <div class="nav-item">
          <a class="nav-link pl-2 pr-2 text-dark btn btn-outline-danger mr-3" href="logout.php">Sign out</a>
        </div>
      </div>
  </header><br>
  <form action="update.php" method="POST">

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
      <input type="password" class="form-control mt-1" id="floatingPassword" placeholder="Password" name="password" 
      value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>">
      <label for="floatingInput">Password</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control mt-1" id="floatingPassword" placeholder="Confirm_Password" 
      name="confirm_password">
      <label for="floatingInput">Confirm Password</label>
    </div>
    </div>
    <span class="registerError bg-active">
        <?php
        echo isset($_SESSION['updateMsg']) ? $_SESSION['updateMsg'] : '';
        ?>
      <br>
    </span>
    <?php
    if (isset($_SESSION['username'])) {
    ?>
      <input type="submit" class="btn btn-success" value="Update" name="update"></button>
      <a href="products.php" class="btn btn-primary">Products</a>
    <?php
    }
}
    ?>
</body>
</html>