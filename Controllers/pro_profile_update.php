<?php

session_start();
// Retrieve form data
if (isset($_REQUEST['submit']))
{


$name = $_POST['name'];
$contact = $_POST['contact'];
require_once "../models/provider_user_model.php";

if ($name == '' || $contact== ''){
    $_SESSION['empty_msg']="Any Field can not be Empty !!!";
    header("location:../Views/pro_profile.php");
}
else{
setcookie('provider_logged_flag',true,time()+400,'/');
// Check if file was uploaded without errors
if(isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0)
    {      
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
            $filename = $_FILES["picture"]["name"];
            $filetype = $_FILES["picture"]["type"];
            $filesize = $_FILES["picture"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MIME type of the file
            if(in_array($filetype, $allowed)){
                // Check if file already exists on the server, if not, move the uploaded file to the server
                if(file_exists("../pictures/uploads-p/" . $_FILES["picture"]["name"])){
                    $_SESSION['profile_customization_msg']= $_FILES["picture"]["name"]." already exists.";
                } else{
                    //the unique id added later at part 
                //move_uploaded_file($_FILES["picture"]["tmp_name"], "uploads/" . $_FILES["picture"]["name"]);
                $picture_name = time();
                move_uploaded_file($_FILES["picture"]["tmp_name"], "../pictures/uploads-p/" .$picture_name);
                $_SESSION['profile_customization_msg'] = "Your file was uploaded successfully.";
                }
                } else{
                    $_SESSION['profile_customization_msg']= "Error: There was a problem uploading your file. Please try again.";
                }
       }
                
                // Save form data to a file
                
                $user = ['email'=>$_SESSION['provider_id']];
                $status = get_id ($user);

                 $con = getconnection(); 
                 $sql = "UPDATE provider_user 
                 SET username = '{$name}', contact = '{$contact}' , picture= '{$picture_name}'
                 WHERE id = $status ";
                 $status = mysqli_query($con , $sql);
                 if ($status)
                 {

                     // Redirect to the consumer page
                     header("Location:../Views/pro_profile.php");
                 }
}
}
    else{
        echo "Invalid Request" ;
    }
        ?>