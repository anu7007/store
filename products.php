<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     echo 'Kindly  <a href="loginHTML.php">Login</a>  to view Products<?php';
// } else {
    require_once 'connect.php';
    require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Hey, ".$_SESSION['full_name']." !"?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" 
  data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" 
  aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-active">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
        <a class="nav-link" href="profile.php">
              <span data-feather="file"></span>
              My Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              My Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          
          
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li> -->
        </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
      align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <form class="row row-cols-lg-auto g-3 align-items-center">
        <div class="col-12">
          <label class="visually-hidden" for="inlineFormInputGroupUsername">Search</label>
          <div class="input-group">
            <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Enter id,name...">
          </div>
        </div>
      
        <div class="col-lg-3 col-12">
          <label class="visually-hidden" for="inlineFormSelectPref">Sort By</label>
          <select class="form-select" id="inlineFormSelectPref">
            <option selected>Sort By</option>
            <option value="1">Price</option>
            <option value="2">Recently Added</option>
            <option value="3">Popularity</option>
          </select>
        </div>
      
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
        
      </form> 
      <main>
        <div class="album py-3 bg-light">
            <div class="container overflow-hidden">
              <form class="row row-cols-lg-auto align-items-right mt-0 mb-3">
                  <div class="col-lg-6 col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Search</label>
                  </div>
                        
                </form>
            </div>
          <div class="container bg-dark">
            
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $a="";
                $query = "select * from `products`";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                foreach ($stmt as $row) {
                    $a.="<div class='col col-md-4 col-lg-3 d-flex justify-content-between'>
                    <div class='card shadow-sm'>
                    <div class='card-body'>
                    <img class='card-img-top imp-fluid img-thumbnail h-50'
                     src=./productImages/".$row['product_image'].">
                    <h5>".$row['product_name']."</h5>
                    <p class='card-text'>".$row['product_category']."</p>
                    <div class='d-flex justify-content-between align-items-center'>
                    <p><strong>"."₹".$row['product_price']."</strong>&nbsp;<del></p>
                    <form action='cart.php' method='post'>
                    <input type='hidden' name='product_id' value=".$row['product_id'].">
                    <input type='submit' name='addToCart' class='btn btn-primary'>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>";
                }
                 echo $a;

                ?>
                
              
            </div> 
          </div>
           
        </div>
      
      </main>
      <div class="col">
        <nav aria-label="Page navigation example float-end">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
      </div>
      <footer class="text-muted py-5">
        <div class="container">
          <p class="float-end mb-1">
            <a href="#">Back to top</a>
          </p>
          <p class="mb-1">&copy; CEDCOSS Technologies</p>
        </div>
        
      </footer>
      
      
          <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
           crossorigin="anonymous"></script>
            
      </div>
    </main>
  </div>
</div>


    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"
     integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
     crossorigin="anonymous"></script>
  </body>
</html>

