<?php
  require_once(__DIR__.'/session.php');
  require_once(__DIR__.'/../database/connection.php');

  if(isset($_SESSION['ERROR'])){
    $error = $_SESSION['ERROR'];
    unset($_SESSION['ERROR']);
  } else {
    $error = "";
  }

  // Generate a new CSRF token if one doesn't exist
  if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }

  // Check the CSRF token on every POST request
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      die('Invalid CSRF token');
    }
  }

  if((get_user_id() === null || get_username() === null) && basename($_SERVER['PHP_SELF']) != 'register.php'){
    header('Location:../pages/login.php');
  }
?>
