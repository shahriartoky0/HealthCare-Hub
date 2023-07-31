<?php
require_once "db.php";
//function to add Notification 
function add_notification($notice)
{
    $con = getconnection();
    $sql = "INSERT INTO notifications (user, user_id , notice) VALUES ('{$notice['type']}', {$notice['id']},'{$notice['notice']}' )";
    $status = mysqli_query($con ,$sql);
    return $status;
}
// function to show notification 
function show_notification($notice)
{
    $con = getconnection();
    $sql = "SELECT * FROM notifications WHERE user_id = {$notice['user_id']} AND user='{$notice['type']}' ORDER BY timestamp DESC";
    $status = mysqli_query($con , $sql);
    return $status;
}

//update seen status function for consumer  
function update_consumer_read_status($status)
{
    $con = getconnection(); 
    $sql = "UPDATE notifications SET read_status = 1 
            WHERE user = '{$status['user']}' AND user_id = '{$status['user_id']}' ";
    $status = mysqli_query($con , $sql);
    return $status;
}
//update seen status function for doctor  
function update_doctor_read_status($status)
{
    $con = getconnection(); 
    $sql = "UPDATE notifications SET read_status = 1 
            WHERE user = '{$status['user']}' AND user_id = '{$status['user_id']}' ";
    $status = mysqli_query($con , $sql);
    return $status;
}
//update seen status function for provider  
function update_provider_read_status($status)
{
    $con = getconnection(); 
    $sql = "UPDATE notifications SET read_status = 1 
            WHERE user = '{$status['user']}' AND user_id = '{$status['user_id']}' ";
    $status = mysqli_query($con , $sql);
    return $status;
}
function unread_notification($user)
{
    $con = getconnection();
    $sql = "SELECT * FROM notifications WHERE user ='{$user['type']}' AND user_id = {$user['user_id']} ";
    $status = mysqli_query($con , $sql);
    return $status;
}
?>