<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/faqs.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the FAQ ID from the query parameters
    $faqId = $_GET['id'];

    // Call the delete_faq function to delete the FAQ with the specified ID
    $result = delete_faq($faqId);

    if ($result === 0) {
        // Success
        http_response_code(200);
        echo json_encode(['message' => 'FAQ deleted successfully']);
    } elseif ($result === -1) {
        // Error deleting FAQ
        http_response_code(500);
        echo json_encode(['message' => 'Error deleting FAQ']);
    } else {
        // FAQ not found
        http_response_code(404);
        echo json_encode(['message' => 'FAQ not found']);
    }
} else {
    // Invalid HTTP method
    http_response_code(405);
    echo json_encode(['message' => 'Invalid HTTP method']);
}

?>
