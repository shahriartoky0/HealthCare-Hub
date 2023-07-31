<?php
session_start() ;
require_once "../models/provider_user_model.php";
$data = $_POST['data'];
$user = json_decode($data);
$email = $user-> email; 
$password= $user -> password ;
$remember = $user -> checked; 
if ($email == '' || $password == '')
{
    echo " CAN NOT BE EMPTY";
}
else 
{
    $provider= ['email'=>trim($email) , 'password'=>$password];
    $status = check_user($provider);
    if ($status)
    {   

        $_SESSION['provider_id']=trim($email);

        setcookie('provider_logged_flag',true,time()+4000,'/');
        $status = ['state'=> 'success']; 
        
        if ($remember == true)
        {
            setcookie('provider_logged_flag',true,time()+10000000000,'/'); 
        }
        echo json_encode($status);
    }
    else
    {
            
        $status = ['state'=> 'failed'];
        echo json_encode($status);  
    }
}

?>