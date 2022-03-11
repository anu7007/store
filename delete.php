<?php
session_start();
$id=$_POST['dltId'];
if (isset($_POST['delete'])) {
    // echo "delete id=".$id;
    foreach($_SESSION['cartItems'] as $key => $product)
        {
            // print_r ($_SESSION['cartItems'][$key]);
            // echo $key;
            if ($product['id'] == $id)
            {
                // echo "36";
                //Deleting the Product from the Cart Array
                 unset($_SESSION['cartItems'][$key]);
                 header('location:cart.php');
            }
        }
}