<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/tickets.php');

$postData = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($postData, true);

// Now you can access the properties in the JSON data as if they were keys in an array
$ticketId = $data['ticketId'];
$userId = $data['userId'];

if (remove_ticket_tracking($ticketId, $userId) != -1) {
    // Tracking removed successfully
    $_SESSION['SUCCESS'] = 'Ticket tracking removed successfully';
    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $current_url_path = dirname($_SERVER['REQUEST_URI']);
    $page_url = $base_url . $current_url_path . '/../pages/ticket.php?ticket_id=' . $ticketId;
    header("Location: $page_url");
} else {
    // Error removing ticket tracking
    $_SESSION['ERROR'] = 'Error removing ticket tracking';
    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $current_url_path = dirname($_SERVER['REQUEST_URI']);
    $page_url = $base_url . $current_url_path . '/../pages/home_page.php';
    header("Location: $page_url");
}
?>
