<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/faqs.php');


if(($user_id = submit_faq($_POST['question'], $_POST['answer'])) != -1){
	$base_url = 'http://' . $_SERVER['HTTP_HOST'];
	$current_url_path = dirname($_SERVER['REQUEST_URI']);
	$page_url = $base_url . $current_url_path . '/../pages/faqs.php';
	// Redirect the user to the home_page.php file	
	header("Location: $page_url");	
}  else {
	$_SESSION['ERROR'] = 'Error submiting the faq';
}
?>