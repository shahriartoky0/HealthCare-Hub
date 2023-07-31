<?php
if(isset($_COOKIE['provider_logged_flag'])){

    // Check if the form has been submitted
    if (isset($_REQUEST['submit'])) {

        // Get the form data
        $item_name = $_POST['item_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        session_start();
        require_once "../models/product_model.php";
        require_once "../models/provider_user_model.php";

        // Save the data to a file
        if ($item_name == '' || $description == '' || $price == '' || $quantity == '') {
            $_SESSION['profile_customization_msg'] = "This field can not be empty !!";
            header("location:../Views/sell.php");
        } else {
            if(isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
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
                    if(file_exists("../pictures/uploads_products/" . $_FILES["picture"]["name"])){
                        $_SESSION['profile_customization_msg']= $_FILES["picture"]["name"]." already exists.";
                        header("location:../Views/sell.php");
                    } else{
                        //the unique id added later part 
                        //move_uploaded_file($_FILES["picture"]["tmp_name"], "uploads/" . $_FILES["picture"]["name"]);
                        $picture_name = time();
                        move_uploaded_file($_FILES["picture"]["tmp_name"], "../pictures/uploads_products/" .$picture_name);
                        $_SESSION['profile_customization_msg'] = "Your file was uploaded successfully.";
                        header("location:../Views/sell.php");
                    }
                } else{
                    $_SESSION['profile_customization_msg']= "Error: There was a problem uploading your file. Please try again.";
                    header("location:../Views/sell.php");
                }
                //adding product details 
                $user = ['email'=> $_SESSION['provider_id']];
                $provider_id = get_id($user);
                $product = ['name'=> $item_name , 'description'=>$description , 'price'=> $price , 'quantity'=> $quantity ,'picture'=> $picture_name , 'seller_id'=>$provider_id];
                $status = add_product($product);
                if ($status)
                {
                   // echo "<p align='center'>Thank you for selling $item_name at \$$price each.</p>";
                    $_SESSION['profile_customization_msg']="Thank you for selling $item_name at \$$price each.";
                    header("location:../Views/sell.php");
                }
                else 
                {
                    echo" <p align='center'>Failed to list the product to sell !</p>";
                }
             }
           
        }
    }
}
    else {
        echo "login as a provider !";
    }
?>