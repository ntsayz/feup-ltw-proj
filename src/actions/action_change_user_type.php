<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/admin.php');


if(($user_id = change_user_type($_POST['username_change'], $_POST['user_type_change'])) != -1){
	//TODO: write to the page that the change has been made 
}  else {
	$_SESSION['ERROR'] = 'Error changing user type';
}
?>