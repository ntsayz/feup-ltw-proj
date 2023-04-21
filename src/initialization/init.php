<?php
  require_once('/session.php');
  require_once('/../database/connection.php');

  if(isset($_SESSION['ERROR'])){
    $error = $_SESSION['ERROR'];
  	unset($_SESSION['ERROR']);
    
  } else {
  	$error = "Something went wrong";
  }

  if((get_user_id() === null || get_username() === null) && basename($_SERVER['PHP_SELF']) != 'register.php')
    header('Location:../pages/login.php');

?>