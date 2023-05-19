<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/tickets.php');
require_once(__DIR__.'/../database/user.php');
require_once(__DIR__.'/../database/messages.php');
require_once(__DIR__.'/../database/departments.php');

// Retrieve the message and ticket ID from the POST parameters
$message = $_POST['message'];
$ticket_id = $_POST['ticket_id'];

$result = submit_message($ticket_id, $_SESSION['id'], $message);

// Perform the database insertion here using the $message and $ticketId values
if($result !== -1){
    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $current_url_path = dirname($_SERVER['REQUEST_URI']);
    $page_url = $base_url . $current_url_path . '/../pages/ticket.php?ticket_id=' . $ticket_id;
    header("Location: $page_url");
}else{
    $_SESSION['ERROR'] = 'Error submitting the message';
    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $current_url_path = dirname($_SERVER['REQUEST_URI']);
    $page_url = $base_url . $current_url_path . '/../pages/ticket.php?ticket_id=' . $ticket_id;
    header("Location: $page_url");
}
// You can send a response back if needed

?>
