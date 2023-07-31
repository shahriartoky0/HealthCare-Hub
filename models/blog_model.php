<?php
require_once "db.php";

function add_post($post)
{

    $con = getconnection();
    $sql = "insert into blog values ('' , '{$post['title']}' , '{$post['category']}' , '{$post['content']}' , '{$post['doctor_id']}' )";
    $status = mysqli_query($con, $sql);
    return $status;
}
//function to show doctor's own posts 
function doctor_own_posts ($doctor_id)
{
    $con = getconnection();
    $sql = "SELECT * FROM blog WHERE doctor_id= $doctor_id ORDER BY title  ";
    $status = mysqli_query($con, $sql);
    return $status;
}
function showdata()
{
    $con = getconnection();
    $sql = "SELECT * FROM blog ORDER BY title  ";
    $status = mysqli_query($con, $sql);
    return $status;
}
//function to delete data 
function delete_post ($post)

{
    $con = getconnection();
    $sql = "DELETE FROM blog WHERE blog_id = {$post['id']}";
    $status = mysqli_query($con , $sql);
    return $status;

}
//function to show the post written by doctor 
function show_doctor_post($post)
{
    $con = getconnection();
    $sql = "SELECT * FROM blog where blog_id = '{$post['blog_id']}'";
    $status = mysqli_query($con , $sql);
    $result = mysqli_fetch_assoc($status);
    return $result;
}

//function to edit the post written by doctor 
function edit_doctor_post($post)
{
    $con = getconnection();
    $sql = "UPDATE blog SET content ='{$post['content']}', title = '{$post['title']}' 
    where blog_id = '{$post['blog_id']}'";
    $status = mysqli_query($con , $sql);
    return $status;
}


?>