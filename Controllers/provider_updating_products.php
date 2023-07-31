<?php
if(isset($_REQUEST['submit']))
{   
    $product_id = $_REQUEST['product_id'];
    $product_name = $_REQUEST['product_name'];
    $product_description = $_REQUEST['product_description'];
    $product_price = $_REQUEST['product_price'];
    $product_quantity = $_REQUEST['product_quantity'];
    require_once "../models/product_model.php";
    $product = ['product_name'=> $product_name , 'product_description'=> $product_description , 'product_price'=> $product_price , 'product_quantity'=>$product_quantity, 'product_id'=>$product_id];
    $status = update_provider_products($product);
    if ($status)
    {
        header("location:../Views/show_provider_selling_products.php");
    }

}

?>