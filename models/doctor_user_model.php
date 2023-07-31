<?php
require_once 'db.php';
function add_user ($doctor) 
{
    $con = getconnection();
    $sql = "INSERT INTO doctor_user VALUES ('','{$doctor['username']}','{$doctor['email']}','{$doctor['password']}', '{$doctor['education']}','{$doctor['expertise']}','{$doctor['contact']}','{$doctor['picture']}')";

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

function email_check ($doctor)
{   
    $con = getconnection();
    $sql = "SELECT * FROM doctor_user where email= '{$doctor['email']}' ";
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

function check_user($doctor)
{
    $con = getconnection();
    $sql = "SELECT * FROM doctor_user WHERE email ='{$doctor['email']}' AND password= '{$doctor['password']}'";
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
    $sql = "SELECT id FROM doctor_user WHERE email = '{$user['email']}'";
    $status= mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['id'];

}
// showing doctor data by his ID 

function doctor_data_byid($id)
{
    $con = getconnection();
    $sql = "SELECT * FROM doctor_user WHERE id = $id";
    $status= mysqli_query($con, $sql);
    return $status;
}
// function to show all doctors 
function show_all_doctors ()
{
    $con = getconnection();
    $sql = "SELECT * FROM doctor_user";
    $status= mysqli_query($con, $sql);
    return $status;
}
// get doctor name by id 
function doctor_namebyid($id)
{
    $con = getconnection();
    $sql = "SELECT * FROM doctor_user WHERE id = {$id}";
    $status = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['username'];
}
//FUNCTION TO GET THE IMAGE NAME 
function doctor_image($email)
{
    $con = getconnection();
    $sql = "SELECT picture FROM doctor_user WHERE email = '{$email}'";
    $status = mysqli_query($con , $sql);
    $result = mysqli_fetch_assoc($status);
    return $result['picture'];
}

?>