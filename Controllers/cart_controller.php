<?php
if(isset($_REQUEST['submit']))
{
    $product_id = $_REQUEST['product_id'];
    $consumer_id = $_REQUEST['consumer_id'];
    $buying_quantity = $_REQUEST['buying_quantity'];
    $product_price = $_REQUEST['product_price'];
    $product_name = $_REQUEST['product_name'];
    $seller_id = $_REQUEST['seller_id'];

    $cost = ($buying_quantity * $product_price);

    //attaching the cart model file 
    require_once "../models/cart_model.php";
    $product = ['product_id'=> $product_id ,'product_name'=> $product_name , 'buying_quantity'=>$buying_quantity ,'product_price'=>$product_price , 'cost'=> $cost, 'consumer_id' => $consumer_id, 'seller_id'=> $seller_id  ];
    $result = add_to_cart($product);
    session_start();
    if ($result)
    {
        $_SESSION['product_added_to_cart']= "Product was Succefully added";
        header("location:../Views/buy.php");

    }
    else 
    {
        $_SESSION['product_added_to_cart']= "Product was Not added ; Try again!";
        header("location:../Views/buy.php");
    }


}


?>