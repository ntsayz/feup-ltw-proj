<?php
require_once(__DIR__.'/../initialization/init.php');
include_once(__DIR__.'/../database/init.php');

if(($user_id = check_login($_POST['username'], $_POST['password'])) != -1){

	set_current_user($user_id, $_POST['username']);
	header("Location:../pages/home_page.php");

} else {
	$_SESSION['ERROR'] = 'Incorrect username or password';
}

?>