<?php
require_once(__DIR__.'/../initialization/init.php');


$dep_id = $_GET['id']; // Get the user ID from the URL query parameters
$_SESSION['target_department_id'] = $dep_id; // Store the user ID in the session

require_once(__DIR__.'/../templates/department/department.php');
?>
