<?php
    require_once(__DIR__.'/../initialization/init.php');
    if(get_user_id() !== null  && get_username() !== null) {
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
	$current_url_path = dirname($_SERVER['REQUEST_URI']);
	$home_page_url = $base_url . $current_url_path . '/../pages/login.php';

	// Redirect the user to the home_page.php file	
	header("Location: $home_page_url");  

    } else {
        $_SESSION['ERROR'] = "Error logging out!";
        header("Location:".$_SERVER['HTTP_REFERER']."");
    }
?>