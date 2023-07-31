<?php
session_start();
require_once "../models/deal_model.php";

// Check if user is logged in
if(isset($_REQUEST['submit'])){

    $consumer_id = $_POST['consumer_id'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];

    // Check if the customer has already rated the product
    $has_rated = check_rating_exists($consumer_id, $product_id);

    if($has_rated){
        // If customer has already rated the product, redirect back to product page with an error message
        echo "You have already rated this product.";
        //header("Location: ../views/product_page.php?product_id=$product_id");
        exit();
    } else {
        // Add the rating to the database
        add_rating($consumer_id, $product_id, $rating);
        // Redirect back to product page with a success message
       // echo "Rating added successfully.";
        header("Location: ../views/consumer_orders.php");
        exit();
    }
} else {
    // If user is not logged in or product_id and rating are not set, redirect back to homepage
    header("Location:../home.html");
    exit();
}
?>
