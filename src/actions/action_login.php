<?php
require_once("../includes/init.php");
include_once("../database/user.php");

if(($user_id = check_login($_POST['username'], $_POST['password'])) != -1){

	set_current_user($user_id, $_POST['username']);
	header("Location:../pages/home_page.php");

} else {
	$_SESSION['ERROR'] = 'Incorrect username or password';
}

?>