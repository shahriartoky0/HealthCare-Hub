<?php
if(isset($_REQUEST['submit']))
{
    require_once "../models/consumer_user_model.php";
    require_once "../models/complain_model.php";
    session_start();
    $category = $_REQUEST['category'];
    $description = $_REQUEST['description'];
    $user = ['email'=> $_SESSION['consumer_id']];
    $consumer_id= get_id($user);

   //attaching the complain_image if uploaded 
   $complain_image_name ='';
   if(isset($_FILES["complain_image"]) && $_FILES["complain_image"]["error"] == 0)
   {      
   $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
   $filename = $_FILES["complain_image"]["name"];
   $filetype = $_FILES["complain_image"]["type"];
   $filesize = $_FILES["complain_image"]["size"];

   // Verify file extension
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

   // Verify file size - 5MB maximum
   $maxsize = 5 * 1024 * 1024;
   if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

   // Verify MIME type of the file
   if(in_array($filetype, $allowed)){
       // Check if file already exists on the server, if not, move the uploaded file to the server
       if(file_exists("../pictures/uploads_complains/" . $_FILES["complain_image"]["name"])){
           $_SESSION['complain_messege']= $_FILES["complain_image"]["name"]." already exists.";
       } else{

       $complain_image_name = uniqid();
       move_uploaded_file($_FILES["complain_image"]["tmp_name"], "../pictures/uploads_complains/" .$complain_image_name);
       $_SESSION['complain_messege'] = "Uploaded Successfully.";
       }
       } else{
           $_SESSION['complain_messege']= "Error: There was a problem uploading your file. Please try again.";
       }
}
else {
    print_r($_FILES);
    echo " not happened !";
}
    $complain = ['against'=> $category , 'description'=> $description , 'consumer_id'=> $consumer_id ,'image' => $complain_image_name ];
    $status= add_complain ($complain);
    //echo $complain_image_name;
    header("location:../Views/consumer_page.php");
}
?>
