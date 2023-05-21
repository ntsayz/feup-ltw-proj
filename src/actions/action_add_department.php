<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/departments.php');

if (isset($_POST['add_department'])) {
    $departmentName = $_POST['department_name'];

    $result = add_department($departmentName);

   
    if ($result === 1) {
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/user_dashboard.php';
        $_SESSION['SUCCESS'] = 'Department added successfully';
    } else {
        $_SESSION['ERROR'] = 'Something went wrong';
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/user_dashboard.php';
    }
    header("Location: $page_url");
}
?>
