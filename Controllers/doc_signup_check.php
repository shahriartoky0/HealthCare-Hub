<?php
session_start();
if(isset($_REQUEST['submit'])){
$username= $_REQUEST['username'];
$email= $_REQUEST['email'];
$password= $_REQUEST['password'];
$r_password= $_REQUEST['r_password'];
$education= $_REQUEST['education'];
$doctor_field= $_REQUEST['field'];
$contact= $_REQUEST['contact'];

//including php files 
require_once "../models/doctor_user_model.php";


if($username== '' || $username=='' || $email=='' || $password =='' || $contact=='' || $doctor_field== '' || $education ==''){
    //echo '<h3 align="center">Please Provide all the requested information </h3>';
    $_SESSION['blank_msg']= "Please Provide All The Information !";
    header('location:../Views/doctor_signup.php');
    exit();
    
}
else {
  if(filter_var($email, FILTER_VALIDATE_EMAIL))
          {    //checking if the email already exist 
            $doctor= ['email'=>$email];
            $status= email_check ($doctor);
            
            if (!$status)
            {

              $_SESSION['password_match_msg']= "User Already Exists !!";
              header('location:../Views/doctor_signup.php');
              exit();
            }
  
  if ($password == $r_password){
  
  if(strlen($password) < 8 ) {
    
    $_SESSION['pass_check_msg']="Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
    header ('location:../Views/doctor_signup.php');
    
  } else {
    
    
    $doctor = ['username'=>$username , 'email'=>$email , 'password'=>$password , 'education'=>$education, 'expertise'=>$doctor_field, 'contact'=>$contact , 'picture'=>''];
    $status = add_user ($doctor);
    if ($status)
    {

      header ('location:../Views/doctor_login.php?msg=success');
    }
      else {
              $_SESSION['password_match_msg']= "Could not sign in !";
              header ('location:../Views/doctor_signup.php');
          }
  }    
  }
  else {
    $_SESSION['password_match_msg']= "Password did not match !";
    header ('location:../Views/doctor_signup.php');
  }
}
else {
  $_SESSION['pass_check_msg']="Invalid Email";
  header ('location:../Views/doctor_signup.php');
}
}
}
else{
    echo "<h2 align='center'>Invalid User Request</h2>";
}


?>