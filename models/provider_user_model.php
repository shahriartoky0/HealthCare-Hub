<?php
require_once 'db.php';
function add_user ($provider) 
{
    $con = getconnection();
    $sql = "INSERT INTO provider_user VALUES ('','{$provider['username']}','{$provider['email']}','{$provider['password']}','{$provider['contact']}','{$provider['picture']}')";

    $status = mysqli_query($con, $sql);
    if ($status)
    {
        return true ; 
    }
    else 
    {
        return false ; 
    }
}

//function to check if email already exist 

function email_check ($provider)
{   
    $con = getconnection();
    $sql = "SELECT * FROM provider_user where email= '{$provider['email']}' ";
    $result = mysqli_query($con, $sql);
    $row_number = mysqli_num_rows($result);
    
    if ($row_number==1)
    {   
        
        return false ;
        
    }
    return true ;
    // returns false when email already exist 

}

// function to check login status 

function check_user($provider)
{
    $con = getconnection();
    $sql = "SELECT * FROM provider_user WHERE email ='{$provider['email']}' AND password= '{$provider['password']}'";
    $result= mysqli_query($con, $sql);
    
    $row_number = mysqli_num_rows($result);
    if ( $row_number == 1)
    {
        return true;
    }
    return false ;
    //returns true if user is valid
}
// Getting the id from the email 
function get_id ($user)
{
    $con = getconnection();
    $sql = "SELECT id FROM provider_user WHERE email = '{$user['email']}'";
    $status= mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['id'];

}
// Getting the icontact number from the id 
function get_contact ($user)
{
    $con = getconnection();
    $sql = "SELECT contact FROM provider_user WHERE id = '{$user['id']}'";
    $status= mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['contact'];

}
// function to get the image from mail id 
function get_provider_alldata($provider)
{
    $con = getconnection();
    $sql = "SELECT * FROM provider_user WHERE email = '{$provider['email']}'";
    $status = mysqli_query($con , $sql);
    $result = mysqli_fetch_assoc($status);
    return $result;
}
//FUNCTION TO GET THE IMAGE NAME 
function provider_image($email)
{
    $con = getconnection();
    $sql = "SELECT picture FROM provider_user WHERE email = '{$email}'";
    $status = mysqli_query($con , $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['picture'];
}

?>