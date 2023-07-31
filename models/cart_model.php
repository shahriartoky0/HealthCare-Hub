<?php

include_once "db.php";

function add_to_cart($product)
{
    $con = getconnection();
    $sql = "INSERT INTO cart VALUES ('' , '{$product['product_id']}' ,'{$product['product_name']}' ,'{$product['buying_quantity']}' ,'{$product['product_price']}','{$product['cost']}' ,'{$product['consumer_id']}','{$product['seller_id']}' )";
    $status = mysqli_query($con , $sql );
    return $status;
    
}
//function to show individual consumer product 
function show_my_data($data)
{
    $con = getconnection();
    $sql = "SELECT * FROM cart WHERE consumer_id = {$data['consumer_id']}";
    $status = mysqli_query($con , $sql );
    //return mysqli_fetch_assoc($status);
    return $status;
}
// function to delete item from the existing cart 
function delete_item($item)
{   
    $con = getconnection();
    $sql = "DELETE FROM cart WHERE cart_id = {$item['cart_id']}";
    $status = mysqli_query($con , $sql );
    return $status;

}
// function to delete all data 
function delete_all_cart_data()
{
    $con = getconnection();
    $sql = "DELETE FROM cart ";
    $status = mysqli_query($con , $sql );
    return $status;
}
function show_all_cart_data()
{
    $con = getconnection();
    $sql = "SELECT * FROM cart ";
    $status = mysqli_query ($con , $sql);
    return $status;
}



?>