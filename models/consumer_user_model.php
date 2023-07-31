<?php
require_once 'db.php';
function add_consumer ($consumer) 
{
    $con = getconnection();
    $sql = "INSERT INTO consumer_user VALUES ('','{$consumer['username']}','{$consumer['email']}','{$consumer['password']}','{$consumer['contact']}','{$consumer['picture']}')";

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

function consumer_email_check ($consumer)
{   
    $con = getconnection();
    $sql = "SELECT * FROM consumer_user where email= '{$consumer['email']}' ";
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

function consumer_check_user($consumer)
{
    $con = getconnection();
    $sql = "SELECT * FROM consumer_user WHERE email ='{$consumer['email']}' AND password= '{$consumer['password']}'";
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
    $sql = "SELECT id FROM consumer_user WHERE email = '{$user['email']}'";
    $status= mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['id'];

}
//FUNCTION TO GET THE IMAGE NAME 
function consumer_image($email)
{
    $con = getconnection();
    $sql = "SELECT picture FROM consumer_user WHERE email = '{$email}'";
    $status = mysqli_query($con , $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['picture'];
}

// to get contact 
function consmuer_data ($consumer)
{
    $con = getconnection();
    $sql = "SELECT * FROM consumer_user WHERE id = '{$consumer['id']}'";
    $status= mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc ($status);
    return $result; 
}
?>