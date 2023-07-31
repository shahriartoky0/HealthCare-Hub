<?php
require_once 'db.php';
//adding product to the database 
 
function add_product($product)
{
    $con = getconnection();
    $sql = "INSERT INTO product VALUES ('', '{$product['name']}' , '{$product['description']}' , 
    '{$product['price']}' , '{$product['quantity']}','{$product['picture']}' , '{$product['seller_id']}')";
    $status = mysqli_query($con , $sql);
    if ($status)
    {
        return true ; 
    }
    return false ; 
    // returns true if addedd successfully
}
function getProductById($id) {
    // Connect to the database
    $con = getconnection();

    // Build the query to retrieve the product details
    $sql = "SELECT * FROM product WHERE id = $id";

    // Execute the query and retrieve the product details
    $status = mysqli_query($con, $sql);
    $product = mysqli_fetch_assoc($status);

   
    return $product;
}
//function to show provider his products 


function show_provider_products ($product)
{
    $con = getconnection(); 
    $sql = "SELECT * FROM product WHERE seller_id = {$product['provider_id']}";
    $status = mysqli_query($con, $sql);
    return $status;
}
//function to show provider his products 


function show_provider_products_by_productid ($product)
{
    $con = getconnection(); 
    $sql = "SELECT * FROM product WHERE id = {$product['product_id']}";
    $status = mysqli_query($con, $sql);
    return $status;
}
//function to update provider his products 


function update_provider_products ($product)
{
    $con = getconnection(); 
    $sql = "UPDATE product SET 
            name = '{$product['product_name']}', description= '{$product['product_description']}' , price ={$product['product_price']} , quantity = {$product['product_quantity']}
            WHERE id = {$product['product_id']} ";
    $status = mysqli_query($con, $sql);
    return $status;
}

//function to update the quantity of the product 
function update_product_quantity ($product)
{
    $con = getconnection();
    $sql = "UPDATE product SET quantity = {$product['quantity']} 
                WHERE id = {$product['id']}";
    $status = mysqli_query($con, $sql);
    return $status;
}

function show_all_products()
{
    $con = getconnection();
    $sql = "SELECT * FROM product WHERE quantity > 0 ";
    $status = mysqli_query($con, $sql);
    return $status;
}



?>