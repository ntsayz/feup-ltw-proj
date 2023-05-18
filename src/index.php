<?php
  include_once(__DIR__.'/initialization/init.php');
  
  if(!isset($_SESSION['username'])){
    header("Location:pages/login.php");
  } else {
    
  	header("Location:pages/home_page.php");
  }
?>