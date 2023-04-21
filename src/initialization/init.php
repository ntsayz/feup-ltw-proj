<?php
  require_once(__DIR__.'/session.php');
  require_once(__DIR__.'/../database/connection.php');

  if(isset($_SESSION['ERROR'])){
    $error = $_SESSION['ERROR'];
  	unset($_SESSION['ERROR']);
    
  } else {
  	$error = "";
  }

  if((get_user_id() === null || get_username() === null) && basename($_SERVER['PHP_SELF']) != 'register.php'){
    header('Location:../pages/login.php');}

?>