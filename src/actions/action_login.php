<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/user.php');


echo "This was called";
if(($user_id = check_login($_POST['username'], $_POST['password'])) != -1){
	
	set_current_user($user_id, $_POST['username']);
	$base_url = 'http://' . $_SERVER['HTTP_HOST'];
	$current_url_path = dirname($_SERVER['REQUEST_URI']);
	$home_page_url = $base_url . $current_url_path . '/../pages/home_page.php';

	// Redirect the user to the home_page.php file	
	header("Location: $home_page_url");	
} else {
	$_SESSION['ERROR'] = 'Incorrect username or password';
}

?>