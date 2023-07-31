<?php
if(isset($_REQUEST['submit']))
{
    $deal_id= $_REQUEST['deal_id'];
    require_once "../models/deal_model.php";
    $product = ['deal_id'=> $deal_id];
    $result= update_received_status($product);
    if ($result)
    {
        header("location:../Views/consumer_orders.php");
    }

}
?>