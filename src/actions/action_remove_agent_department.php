<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/departments.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'DELETE') {
    // Get the agent ID and department ID from the query parameters
    $agentId = $_GET['agent_id'];
    $departmentId = $_GET['department_id'];

    // Call the remove_agent_from_department function to remove the agent with the specified ID from the department
    $result = remove_agent_from_department($agentId, $departmentId);

    if ($result === 1) {
        // Success
        http_response_code(200);
        echo json_encode(['message' => 'Agent removed from department successfully']);
    } elseif ($result === -1) {
        // Error removing agent from department
        http_response_code(500);
        echo json_encode(['message' => 'Error removing agent from department']);
    } else {
        // Agent not found
        http_response_code(404);
        echo json_encode(['message' => 'Agent not found']);
    }
} else {
    // Invalid HTTP method
    http_response_code(405);
    echo json_encode(['message' => 'Invalid HTTP method']);
}

?>

