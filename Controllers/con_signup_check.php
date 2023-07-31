<?php
session_start();
if(isset($_REQUEST['submit'])){
$username= $_REQUEST['username'];
$email= $_REQUEST['email'];
$password= $_REQUEST['password'];
$r_password= $_REQUEST['r_password'];
$contact= $_REQUEST['contact'];

//including php files 
require_once "../models/consumer_user_model.php";

//validation starts
if($username== '' || $username=='' || $email=='' || $password =='' || $contact==''){
        $_SESSION['blank_msg']= "Please Provide all the Information !";
        header('location:../Views/consumer_signup.php');
    
}
else {
  if(filter_var($email, FILTER_VALIDATE_EMAIL))
          { 
              //checking if the email already exist 
            $consumer= ['email'=>$email];
            $status= consumer_email_check ($consumer);
            
            if (!$status)
            {

              $_SESSION['password_match_msg']= "User Already Exists !!";
              header('location:consumer_signup.php');
              exit();
            }
            
               
        if ($password == $r_password){
        
      
        if(strlen($password) < 8) {
          
          $_SESSION['pass_check_msg']="Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
          header ('location:../Views/consumer_signup.php');
          
        }
         else {
          $consumer= ['username'=>$username , 'email'=>$email , 'password'=> $password, 'contact'=>$contact, 'picture'=>''] ;
          $status = add_consumer($consumer);
          if ($status)
          {
            header ('location:../Views/consumer_login.php');
          }
          else 
          {
            $_SESSION['password_match_msg']= "Failed to sign in !";
            header('location:../Views/consumer_signup.php');
          }

        } 
        }
        else {
          $_SESSION['password_match_msg']= "Password did not match !";
          header('location:../Views/consumer_signup.php');
        }
    }
else {
  $_SESSION['pass_check_msg']="Invalid Email";
  header ('location:../Views/consumer_signup.php');
  //echo "invalid email";
}
}
}
else{
    echo "<h2 align='center'>Invalid User Request</h2>";
}


?>