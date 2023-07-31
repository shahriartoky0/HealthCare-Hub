<?php
//controller file
if(isset($_REQUEST['submit']))
{
// Get form data
$title = $_REQUEST['title'];
$author = $_REQUEST['author'];
$category = $_REQUEST['category'];
$content = $_REQUEST['content'];
if ($title == '' || $content == ''){
    echo 'can not be empty';
    exit();
}

require_once "../models/blog_model.php";
$blog = ['title'=> $title , 'category'=> $category ,'doctor_id'=>$author , 'content' => $content];
$get = add_post($blog);
if ($get)
{
    session_start();
    $_SESSION['msg']= "Post Added Succefully";
    header("location:../Views/blog_make_form.php");
}
 }
?>
