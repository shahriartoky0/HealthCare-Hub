<?php
if(isset($_REQUEST['submit']))

{
    $blog_id = $_REQUEST['blog_id'];
    $content= $_REQUEST['content'];
    $title = $_REQUEST["title"];
     require_once "../models/blog_model.php";
     $post = ['title' => $title , 'content'=> $content , 'blog_id'=> $blog_id];
     $update = edit_doctor_post($post);
     if ($update)
     {
       
        header("location:../Views/blog_make_form.php");
     }
     else 
     {
        echo "ERROR !!!";
     }


}

?>