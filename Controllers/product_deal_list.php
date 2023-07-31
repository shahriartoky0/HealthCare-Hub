<?php
if(isset($_REQUEST['submit']))
{
    $product_id= $_REQUEST['product_id'];
    $buying_quantity= $_REQUEST['buying_quantity'];
    $cost= $_REQUEST['cost'];
    $consumer_id= $_REQUEST['consumer_id'];
    $seller_id= $_REQUEST['seller_id'];
    $address= $_REQUEST['address'];
    $payment_method= $_REQUEST['payment_method'];
    $transaction_ids= $_REQUEST['transaction_id'];
    //echo $payment_method;
    

    //attaching order _model files 
    require_once "../models/deal_model.php";
    require_once "../models/cart_model.php";
    require_once "../models/product_model.php";
    require_once "../models/notifications_model.php";

    //print_r($transaction_ids);
    if ($payment_method == 'cod')
    {
        $transaction_id = "CASH ON DELIVERY";
        echo $transaction_id;
    }
    else {
       
        $transaction_id = $transaction_ids;
        
        }

    // Adding a default value for transaction id then just updating according to the cart_id
    $order = ['shipping_address'=> $address , 'transaction_id'=> $transaction_id , 'shipping_status'=> "Unshipped" , 'received_status'=> 'NO' ];
    $status= add_order($order);
    
    /* --------------update the quantity of the product starts -------------- */
    $all_cart_data =show_all_cart_data();
    //gotta get product quanity from product table 
    
    while ($cart_data= mysqli_fetch_assoc($all_cart_data))
    {   
        
        /*-------- after an order a notification has to be sent to the provider starts for every product-------- */
        echo $seller_id;
        $notification= ['type'=>'provider', 'id'=>$cart_data['seller_id'] , 
        'notice'=>"{$cart_data['product_name']} has been bought {$cart_data['buying_quantity']} pcs."];
        add_notification($notification);
        //print_r($notice);
    
        /*-------- after an order a notification has to be sent to the provider ends for every product-------- */
        $product = ['product_id' =>$cart_data['product_id'] ];
        $selected_product_all_data_object = show_provider_products_by_productid($product);
        $selected_product_all_data = mysqli_fetch_assoc($selected_product_all_data_object);
        //echo $cart_data['buying_quantity']."hello !";
        

        $new_quantity =$selected_product_all_data['quantity'] -  $cart_data['buying_quantity'];
        $update_product = ['id'=>$cart_data['product_id'], 'quantity'=>$new_quantity];
        $update_product_quantity= update_product_quantity($update_product);


    }
    /* --------------update the quantity of the product ends -------------- */
    $delete = delete_all_cart_data();
    if ($status)
    {
        echo "added !";
        if ($payment_method != 'cod')
        {
        foreach($transaction_ids as $cart_id => $specific_transaction_id)
        {
            print_r($transaction_ids);
            //$sql = "UPDATE deal SET transaction_id = '{$specific_transaction_id}' WHERE cart_id = '{$cart_id}'";
            $update_onine_payment = update_transaction_id($cart_id, $specific_transaction_id);
            
            
        }
        
    }
}


    header("location:../Views/consumer_page.php");


 }

?>