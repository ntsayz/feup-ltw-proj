<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/user.php');

    if(change_email($_SESSION['username'], $_POST['new_email']) == 0){
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $home_page_url = $base_url . $current_url_path . '/../pages/profile.php';
        $_SESSION['SUCCESS']  = 'Email changed successfully';
        header("Location: $home_page_url");	
    }
    else{
        $_SESSION['ERROR'] = 'Something went wrong';
    }

?>