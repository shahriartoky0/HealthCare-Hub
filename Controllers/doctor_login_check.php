<?php
session_start() ;
require_once "../models/doctor_user_model.php";
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
    $doctor= ['email'=>trim($email) , 'password'=>$password];
    $status = check_user($doctor);
    if ($status)
    {   

        $_SESSION['doctor_id']=trim($email);

        setcookie('doctor_logged_flag',true,time()+4000,'/');
        $status = ['state'=> 'success']; 
        
        if ($remember == true)
        {
            setcookie('doctor_logged_flag',true,time()+10000000000,'/'); 
        }
        echo json_encode($status);
        //header("location:../Views/doctor_page.php");
    }
    else
    {
            
        $status = ['state'=> 'failed'];
        echo json_encode($status);
        //header('location:../Views/doctor_login.php?msg=error');
            
    }
}

?>