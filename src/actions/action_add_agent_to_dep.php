<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/departments.php');
// Check if the form is submitted
if (isset($_POST['add_agent'])) {
    // Get the agent ID and department ID from the form data
    $agent_id = $_POST['agent_id'];
    $department_id = $_POST['dep_id'];

    // Call the function to add the agent to the department
    $result = add_agent_to_department($agent_id, $department_id);

    if ($result === 1) {
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/department.php?id=' . $department_id;
        $_SESSION['SUCCESS'] = 'Department added successfully';
    } else {
        $_SESSION['ERROR'] = 'Something went wrong';
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/department.php?id=' . $department_id;
    }
    header("Location: $page_url");
}

?>