<?php
include "sql.php";
  $username=$_POST['username'];
  $password=$_POST['password'];
  session_start();
  $emptydataarray=array();
  $_SESSION['userdata']=json_encode($emptydataarray);
  $_SESSION['username']=$username;
  $_SESSION['password']=$password;
  adduser($username,$password,'userdata');
  //header("Location:www.uwcourseschedule.com/selectcoursepage.php");
  header("Location:./selectcoursepage.php?type=1");


  ?>
