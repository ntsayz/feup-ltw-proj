<?php
require_once(__DIR__.'/../initialization/init.php');


$user_id = $_GET['id']; // Get the user ID from the URL query parameters
$_SESSION['target_user_id'] = $user_id; // Store the user ID in the session

require_once(__DIR__.'/../templates/user/user_dashboard.php');
?>
