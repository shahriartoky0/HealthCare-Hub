<?php
//controller type file 
if(isset($_REQUEST['submit'])) 
{
    require_once "../models/blog_model.php";
    $id = $_REQUEST['blog_id'];
    $post = ['id'=> $id];
    $result = delete_post($post);
    if ($result)
    {
        header("location:../Views/blog_make_form.php");
    }
}

?>