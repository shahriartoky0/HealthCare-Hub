<?php
require_once "db.php";

//adding product from the confirmed cart table 
function add_order($order)
{
    $con = getconnection();
    $sql = "INSERT INTO deal (cart_id, product_id, product_name, buying_quantity, product_price, cost, consumer_id, seller_id, shipping_address, transaction_id ,shipping_status, received_status )
    SELECT cart_id, product_id, product_name, buying_quantity, product_price,cost,consumer_id, seller_id, '{$order['shipping_address']}', '{$order['transaction_id']}' , '{$order['shipping_status']}',   '{$order['received_status']}' 
    FROM cart";
    $status = mysqli_query($con , $sql);
    return $status;
}

//function to add transaction_id to online payments 
function update_transaction_id($cart_id, $transaction_id)
{
        $con = getconnection();
        $sql = "UPDATE deal SET transaction_id = '{$transaction_id}' WHERE cart_id = '{$cart_id}'";
        $status= mysqli_query($con , $sql);
        return $status;
}
//function to show consumer his orders 
function show_consumer_order($consumer)
{
    $con = getconnection();
    $sql = "SELECT * FROM deal WHERE consumer_id = '{$consumer['id']}' AND received_status='NO'"; 
    $status= mysqli_query($con,$sql);
    return $status;
}
//function to show provider his orders 
function show_provider_order($provider)
{
    $con = getconnection();
    $sql = "SELECT * FROM deal WHERE seller_id = '{$provider['id']}' AND shipping_status = 'Unshipped'"; 
    $status= mysqli_query($con,$sql);
   
    return $status;
}
//update shipping status
function update_shipping_status($product)
{
    $con = getconnection();
    $sql = "UPDATE deal SET shipping_status = 'SHIPPED' WHERE deal_id = '{$product['deal_id']}'";
    $status= mysqli_query($con , $sql);
    return $status;
}

//update recieved status
function update_received_status($product)
{
    $con = getconnection();
    $sql = "UPDATE deal SET received_status = 'YES' WHERE deal_id = '{$product['deal_id']}'";
    $status= mysqli_query($con , $sql);
    return $status;
}
// checks rating of the product 
function check_rating_exists($consumer_id , $product_id)
{
    $con = getconnection();
    $sql ="SELECT * FROM deal WHERE consumer_id = {$consumer_id} AND product_id = {$product_id}";
    $result = mysqli_query($con ,$sql);
    if (!$result) {
        // query failed
        return false;
    }
    $row = mysqli_fetch_assoc($result);
    if ($row === null) {
        // no rows returned
        return false;
    }
    $rating = $row['rating'];
    if ($rating > 0) {
        // rating exists
        return true;
    } else {
        // rating does not exist
        return false;
    }
}
// funtion to update the rating 
function add_rating($consumer_id, $product_id, $rating)
{
    $con = getconnection(); 
    $sql = "UPDATE deal SET rating = {$rating}
            WHERE consumer_id= {$consumer_id} AND product_id= {$product_id}";
    $result = mysqli_query($con , $sql );
    return $result;
}
//function to get the average rating value 
function get_average_rating($product)
{
    $con = getconnection();
    $sql = "SELECT AVG(rating) AS average_rating FROM deal WHERE product_id = {$product['product_id']}";
    $result = mysqli_query($con , $sql);
    $status = mysqli_fetch_assoc($result);
    return $status['average_rating'] ;
}



?>