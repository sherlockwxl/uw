<?php
  $json=($_POST['data']);
  session_start();
  $username=$_SESSION['username'];
  $password=$_SESSION['password'];
  if($username!="" && $password!=""){
  updateuser($username,$password,$json);
}
  ?>
