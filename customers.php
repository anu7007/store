<?php
session_start();
require_once 'connect.php';
require_once 'config.php';
if (!isset($_SESSION['loginmail']) && !isset ($_SESSION['loginpassword'])) {
    echo "Session Expired!!  ";
    echo "You cannot access dashboard without login!Kindly   "?><a href="loginHTML.php">login</a><?php
} else {
            $query = "select * from `register`";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Customers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
    crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


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
        table,
        thead,
        tr,
        tbody,
        th,
        td {
          text-align: center;
}
    </style>

    
    <!-- Custom styles for this template -->
    <!-- <link href="./customers.css" rel="stylesheet"> -->
  </head>
  <body>
    
 <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" 
  type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" 
  aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 mr-5" id="search" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
  <div class="nav-item text-nowrap text-white btn btn-info pt-2 pb-2 px-5 mr-2">
    <?php
    echo "Hello,"."  ". strtoupper($_SESSION['username']);
    ?>
  </div>
  </div>

  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3 btn btn-outline-danger mr-2 mt-1 mb-1" href="logout.php">Sign Out</a>
    </div>
  </div>
 </header>

 <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminProductsList.php">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>        
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
      align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customers</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2" float-left>
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <p class="text text-muted">Top 3 Customers</p>
      <div class="table-responsive">
        <table class="table table-striped table-hover text-align:center">
          <thead class="table table-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Full Name</th>
              <th scope="col">User Name</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
              <th scope="col">Change Status</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
            <?php
              $query = "select * from `register` order by (CASE when role = 'admin' THEN 0 else 1 END), status desc";
              $stmt = $conn->prepare($query);
              $stmt->execute();
            foreach ($stmt as $row) {
                if ($row['status']=="pending" && $row['role']=="user") {
            ?>
          <tbody>
            <tr class="bg bg-danger" style='--bs-bg-opacity: .8;'>
              <td><?php echo $row['ID'];?></td>
              <td><?php echo $row['full_name'];?></td>
              <td><?php echo $row['username'];?></td>
              <td><?php echo $row['email'];?></td>
              <td><?php echo $row['status']; ?></td>
              <td>
                  <form action="function.php" method="GET">
                  <input type="hidden" name="statusName" value="<?php echo $row['status'] ?>">
                  <input type="hidden" name="status" value="<?php echo $row['ID'] ?>">
                  <input type='submit' class='btn btn-warning' value='Change' >
            </form>
                </td>
              <td>
              <form action="function.php" method="GET">
                  <input type="hidden" name="delete" value="<?php echo $row['ID'] ?>">
                  <input type='submit' class='btn btn-danger' value='Delete'/>
                </td>
          </form>
            </tr>           
            <?php
                } elseif ($row['status']=="approved" && $row['role']=="user") {
                ?>
                  <tr class="bg bg-success" style='--bs-bg-opacity: .7;'>
              <td><?php echo $row['ID'];?></td>
              <td><?php echo $row['full_name'];?></td>
              <td><?php echo $row['username'];?></td>
              <td><?php echo $row['email'];?></td>
              <td><?php echo $row['status']; ?></td>
              <td>
                  <form action="function.php" method="GET">
                  <input type="hidden" name="statusName" value="<?php echo $row['status'] ?>">
                  <input type="hidden" name="status" value="<?php echo $row['ID'] ?>">
                  <input type='submit' class='btn btn-warning' value='Change' >
            </form>
                </td>
              <td>
              <form action="function.php" method="GET">
                  <input type="hidden" name="delete" value="<?php echo $row['ID'] ?>">
                  <input type='submit' class='btn btn-danger' value='Delete'/>
                </td>
          </form>
            </tr>
            <?php
                } else {
                    ?>
                      <tr class="bg bg-active" style='--bs-bg-opacity: .7;'>
                  <td><?php echo $row['ID'];?></td>
                  <td><?php echo $row['full_name'];?></td>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td>
                      <form action="function.php" method="GET">
                      <input type="hidden" name="statusName" value="<?php echo $row['status'] ?>">
                        <?php echo "ADMIN" ?>
                      <!-- <input type='submit' class='btn btn-warning' value='Change' > -->
                </form>
                    </td>
                  <td>
                  <form action="function.php" method="GET">
                      <input type="hidden" name="delete" value="<?php echo $row['ID'] ?>">
                      <!-- <input type='submit' class='btn btn-danger' value='Delete'/> -->
                        <del><?php echo "Access" ; ?></del>
                    </td>
              </form>
                </tr>
                <?php
                }
            }
                    ?>
                
          </tbody>
        </table>
      </div>
      <form action="addUserHTML.php" method="POST">
        <input type="submit" name="addUser" class="btn btn-primary" value="Add User">
      </form>
    </main>
    
  </div>
  
 </div>
<?php
}
?>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
      // window.alert("Srch..");
      $("#search").on("keyup", function() {
        $(this).val().toLowerCase();
        $("#body").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
  
  </script>
  </body>
</html>