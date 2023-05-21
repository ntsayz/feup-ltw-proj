<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/status.php');


if (isset($_POST['add_status'])) {
    $statusName = $_POST['status_name'];

    $result = add_status($statusName);

    if ($result === 1) {
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/admin_settings.php';
        $_SESSION['SUCCESS'] = 'Status added successfully';
        header("Location: $page_url");
    } else {
        $_SESSION['ERROR'] = 'Something went wrong';
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/admin_settings.php';
        header("Location: $page_url");
    }
    
}
?>
