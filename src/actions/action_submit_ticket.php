<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/tickets.php');

    // Get the current user ID. This depends on your authentication system. 
    // Usually, you can get the logged-in user's ID from the session.
    $user_id = $_SESSION['id'];  

    // Default status_id for a new ticket
    $status_id = 1;  // Open

    // Submit the ticket
    if (($ticket_id = submit_ticket($_POST['title'], $_POST['description'], $_POST['priority'], $status_id, $user_id, $_POST['department'])) != -1){
        if($ticket_record_id = submit_ticket_record($ticket_id, $user_id,"created the ticket") != -1) {
            $base_url = 'http://' . $_SERVER['HTTP_HOST'];
            $current_url_path = dirname($_SERVER['REQUEST_URI']);
            $page_url = $base_url . $current_url_path . '/../pages/ticket.php?ticket_id=' . $ticket_id;
            $_SESSION['SUCCESS'] = 'Ticket submitted successfully';
            header("Location: $page_url");
        }else{
            $_SESSION['ERROR'] = 'Error submitting the ticket';
            $base_url = 'http://' . $_SERVER['HTTP_HOST'];
            $current_url_path = dirname($_SERVER['REQUEST_URI']);
            $page_url = $base_url . $current_url_path . '/../pages/home_page.php';
            header("Location: $page_url");
        }
    } else {
        $_SESSION['ERROR'] = 'Error submitting the ticket';
        $base_url = 'http://' . $_SERVER['HTTP_HOST'];
        $current_url_path = dirname($_SERVER['REQUEST_URI']);
        $page_url = $base_url . $current_url_path . '/../pages/home_page.php';
        header("Location: $page_url");
    }

?>
