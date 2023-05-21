<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/admin.php');
// Ensure a user type is selected and it's either 'admin', 'client', or 'agent'.
if (!isset($_POST['user-type']) || !in_array($_POST['user-type'], ['admin', 'client', 'agent'])) {
    echo "Invalid user type";
    die('Invalid user type');
    
}

$new_user_type = $_POST['user-type'];

// Ensure a user ID is set in the session.
if (!isset($_SESSION['target_user_id'])) {
    echo "No user ID specified";
    die('No user ID specified');
}

$user_id = $_SESSION['target_user_id'];
if(change_user_type_by_id($user_id,$new_user_type) != -1){
    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $current_url_path = dirname($_SERVER['REQUEST_URI']);
    $page_url = $base_url . $current_url_path . '/../pages/user_dashboard.php?id=' . $user_id;
    header("Location: $page_url");
}else{
    echo "Error changing user type";
}
?>
