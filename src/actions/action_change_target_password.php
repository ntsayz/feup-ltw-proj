<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/user.php');

if(change_password_by_id($_SESSION['target_user_id'], $_POST['new_password']) == 0){
    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $current_url_path = dirname($_SERVER['REQUEST_URI']);
    $home_page_url = $base_url . $current_url_path . '/../pages/user_dashboard.php?id=' . $_SESSION['target_user_id'];
    $_SESSION['SUCCESS']  = 'Password changed successfully for user: '. get_username_by_id($_SESSION['target_user_id']);
    header("Location: $home_page_url");	
}
else{
    $_SESSION['ERROR'] = 'Something went wrong ';
}
?>
