//searchphp will take the post from loginhtml and search for the username and pwd if available will jump to courseselect and if not will jump to loginerror.html
<?php
include "sql.php";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $response=searchforuser($username,$password,'userdata');
  if($response==false)
  {
  //  header("Location:www.uwcourseschedule.com/loginerror.html");
  header("Location:./loginerror.html");
  }
  else{
    session_start();
    $_SESSION['userdata']=$response;
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
  //  header("Location:www.uwcourseschedule.com/selectcoursepage.php");
  header("Location:./selectcoursepage.php?type=2");
  }


  ?>
