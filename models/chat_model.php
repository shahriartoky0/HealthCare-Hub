<?php 
require_once "db.php";

// function to add consumer message 
function add_consumer_message($message)
{
    $con = getconnection();
    $sql = "INSERT INTO chat (chat_id , message_text , consumer_id , doctor_id, sent_by ) 
    VALUE('' , '{$message['msg']}' , '{$message['consumer_id']}', '{$message['doctor_id']}', '{$message['sent_by']}' )" ;
    $status = mysqli_query($con , $sql);
    return $status;
}
//show conversion function 
function show_conversation_consumer($consumer_id, $doctor_id)
{
    $con = getconnection();
    $sql = "SELECT * FROM chat WHERE (consumer_id='$consumer_id' AND doctor_id='$doctor_id') OR (consumer_id='$doctor_id' AND doctor_id='$consumer_id') ORDER BY timestamp ASC";
    $status = mysqli_query($con , $sql);
    return $status;
}
function show_messages_to_doctor($doctor_id)
{
    $con = getconnection();
    $sql = "SELECT * FROM chat WHERE doctor_id = $doctor_id  ORDER BY timestamp ASC " ;
    $status = mysqli_query($con , $sql);
    return $status;
}
?>