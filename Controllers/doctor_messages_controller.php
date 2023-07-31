<?php
if (isset($_POST['submit'])) {
  $doctor_id = $_POST['doctor_id'];
  $consumer_id = $_POST['consumer_id'];
  $message = $_POST['message'];

  require_once '../models/chat_model.php';
  require_once '../models/doctor_user_model.php';
  require_once '../models/notifications_model.php';

  $message = ['consumer_id' => $consumer_id, 'doctor_id' => $doctor_id, 'msg' => $message, 'sent_by'=>'doctor'];
  $add_message = add_consumer_message($message);
  //$result = insert_doctor_reply($doctor_id, $consumer_id, $message);

  if ($add_message) {
    //set the notification to the consumer 
    $doctor_name = doctor_namebyid($doctor_id);
    $notice= ['type'=>'consumer', 'id'=>$consumer_id , 'notice'=>"{$doctor_name} has sent you a message ."];
    add_notification($notice);
    header("Location: ../Views/doctor_messages.php?consumer_id=$consumer_id&doctor_id=$doctor_id");
    exit();
  } else {
    echo "Error";
  }
}

?>