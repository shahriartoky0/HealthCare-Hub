<?php
require_once "db.php";
function add_complain($complain)
{
    $con =getconnection();
    $sql = "INSERT INTO complain VALUES ('', '{$complain['against']}' , '{$complain['description']}', '{$complain['image']}')";
    $status = mysqli_query($con , $sql);
    return $status;
}

?>