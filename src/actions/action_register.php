<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/user.php');

	if(username_exists($_POST['username'])){
		$_SESSION['ERROR'] = 'Duplicated Username';
		header("Location:".$_SERVER['HTTP_REFERER']."");
	}
	else if(email_exists($_POST['email'])){
		$_SESSION['ERROR'] = 'Duplicated Email';
		header("Location:".$_SERVER['HTTP_REFERER']."");
	}
 	else if (($user_id = create_user($_POST['username'], $_POST['password'], $_POST['full_name'], $_POST['email'], $_POST['ref_code'])) != -1) {

  		echo 'User Registered successfully';
        set_current_user($user_id, $_POST['username']);
 		header("Location:../index.php");	
 	}
 	else{

  		$_SESSION['ERROR'] = 'ERROR';
  		header("Location:".$_SERVER['HTTP_REFERER']."");
 	}
 ?>