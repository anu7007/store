<?php
session_start();
include_once('config.php');
include_once('connect.php');
if(!isset($_SESSION['cartItems'])){
$_SESSION['cartItems'] = array();
}
// echo "<pre>";
// print_r(($_SESSION['cartItems']));
// echo "</pre>";
// header('location:cart.php');
// echo json_encode($row);
if (isset($_POST['addToCart'])) {
  unset($_POST['addToCart']);
  // header('location:cart.php');
  $product_id = $_POST['product_id'];
  $query = "select * from products where product_id = '$product_id'";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $count = $stmt->rowCount();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "Add To cart"."<br>";
    $id=$_SESSION['product_id'] = $row['product_id'];
    $name=$_SESSION['product_name'] = $row['product_name'];
    $image=$_SESSION['product_image']= $row['product_image'];
    $category=$_SESSION['product_category']= $row['product_category'];
    $price=$_SESSION['product_price' ] = $row['product_price'];
    $quant=$_SESSION['quant' ] = 1;
    
    $cols=array("id"=>$id,"name"=>"$name", "image"=>"$image","category"=> "$category","price"=>"$price");
    array_push($_SESSION['cartItems'], $cols);
    unset($cols);

$html='';
$gt=0;
// print_r($_SESSION['cartItems']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Checkout example · Bootstrap v5.1</title>
    <style>
      input{
        border: none;
      }
    </style>

    <!-- Bootstrap core CSS -->
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


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
  </head>
  <body class="bg-light">
   <div class="container"> 
  <main>
    <div class="py-5 text-center">
      <h2>Cart</h2>
    </div>

    <div class="row g-5">
      <div class="col order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill"><?php echo $count=count($_SESSION['cartItems']);?></span>
        </h4>
        <?php
        $html.='<table class="table">
            <tr class="table table-dark">
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Category</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Total</th>
            </tr>';
            // die(json_encode($_SESSION['cartItems']));
            // unset($_SESSION['addToCart']);
            if(isset($_SESSION['cartItems'])){
            foreach($_SESSION['cartItems'] as $key){
              $html.="";
              $gt+=($key['price'] * $quant);
              $html.='<tr>
                <td>'.$key['id'].'</td>
                <td>'.$key['name'].'</td>
                <td><img src="./productImages/'.$key['image'].'" style="height:50px; width:80px;"></td>
                <td>'.$key['category'].'</td>
                <td>'.$key['price'].'</td>
                <td>
                    <input type="number" class="col" value='.$quant.' style="width:80px; text-align:center;">
                </td>
                <td>
                <form action="delete.php" method="POST">
                    <input type="button" class="btn btn-secondary ms-1 w-20" value="Update">
                    <input type="hidden" name="dltId" class="btn btn-secondary ms-1 w-20" value='.$key['id'].'>
                    <input type="submit" name="delete" class="link-danger" value="Remove">
               </form>
                </td>
                <td>'.(int)($key['price'] * $quant).'</td>
            </tr>';
            }
            // $html="";
            unset($_POST['addToCart']);
            unset($_SESSION['addToCart']);
          }
            
            else{
              echo "UHHOOOO!!! Your cart is empty!!";
              unset($_SESSION['addToCart']);
            }

            $html.='<tfoot>
                <tr>
                    <td colspan="8" class="text-end">'.$gt.'</td>
                    
                </tr>
            </tfoot>
        </table>';
        echo $html;
        $html="";
        unset($_SESSION['addToCart']);

        ?>
      </div>
    </div>
    <div class="row g-5 align-items-right">
        <div class="col-3">
            <form action="checkout.html" method="post">
                    <input type="submit" class="btn btn-primary" value="CheckOut"></button>
            </form>
            
        </div>
    </div></main>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2021 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
<?php
$html="";
unset($_POST['addToCart']);
unset($_SESSION['addToCart']);
exit(0);
if(!isset($_POST['addToCart'])){
  echo "empty";
}
header('location:cart.php');
// exit(0);
}
else {
  // header('location:cart.php');
  echo "Cannot directly access cart";
  // session_destroy();
}


?>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./assets/js/form-validation.js"></script>
</body>
</html>