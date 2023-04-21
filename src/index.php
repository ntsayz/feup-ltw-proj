<?php
  include_once('includes/init.php');
  
  if(!isset($_SESSION['username'])){
    header("Location:pages/login.php");
  } else {
  	header("Location:pages/home_page.php");
  }
?>