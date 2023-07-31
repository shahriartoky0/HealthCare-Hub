<?php
session_start() ;
require_once "../models/consumer_user_model.php";
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
    $consumer= ['email'=>trim($email) , 'password'=>$password];
    $status = consumer_check_user($consumer);
    if ($status)
    {   

        $_SESSION['consumer_id']=trim($email);

        setcookie('consumer_logged_flag',true,time()+4000,'/');
        $status = ['state'=> 'success']; 
        
        if ($remember == true)
        {
            setcookie('consumer_logged_flag',true,time()+10000000000,'/'); 
        }
        echo json_encode($status);
        //header("location:../Views/consumer_page.php");
    }
    else
    {
            
        $status = ['state'=> 'failed'];
        echo json_encode($status);
        //header('location:../Views/consumer_login.php?msg=error');
            
    }
}

?>