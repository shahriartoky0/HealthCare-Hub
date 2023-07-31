<?php
if(isset($_REQUEST['submit']))
{
    $deal_id= $_REQUEST['deal_id'];
    $consumer_id= $_REQUEST['consumer_id'];
    $product_name= $_REQUEST['product_name'];
    $shipping_address= $_REQUEST['shipping_address'];
    require_once "../models/deal_model.php";
    require_once "../models/notifications_model.php";
    $product = ['deal_id'=> $deal_id];
    $result= update_shipping_status($product);
    if ($result)
    {   
      /* ----------  Here a nofification goes to the consumer that his order has been shipped-----*/
      $notice = $notice= ['type'=>'consumer', 'id'=>$consumer_id , 'notice'=>"Your Product {$product_name} has sent to {$shipping_address} ."];
      add_notification($notice);
        header("location:../Views/provider_own_sell.php");
    }

}
?>