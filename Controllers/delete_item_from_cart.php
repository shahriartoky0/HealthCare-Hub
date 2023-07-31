<?php
//attaching the model files 
require_once "../models/cart_model.php";
if (isset($_REQUEST['submit']))
{
    $cart_id = $_REQUEST['cart_id'];
    $item = ['cart_id'=>$cart_id];
    $delete = delete_item($item);
    if ($delete)
    {
        session_start();
        $_SESSION['cart_item_remove_msg']= "Item removed!! ";
        header("location:../Views/cart.php");

    }
    else 
    {
        $_SESSION['cart_item_remove_msg']= "Item could not be removed ";
        header("location:../Views/cart.php");
    }


}

?>