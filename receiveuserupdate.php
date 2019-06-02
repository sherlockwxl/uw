<?php
include "sql.php";
$json=($_POST['data']);
print_r($custarray);
session_start();
$username=$_SESSION["username"];
$password=$_SESSION["password"];
updateuser($username,$password,$json,'userdata');
?>
