<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/tickets.php');
require_once(__DIR__.'/../database/user.php');
require_once(__DIR__.'/../database/status.php');
require_once(__DIR__.'/../database/departments.php');

// Get the form data
$status = $_POST['status'];
$priority = $_POST['priority'];
$assignee = $_POST['assignee'];
$department = $_POST['department'];
$currentUserId = $_SESSION['id'];
// Get the current ticket details
$currentTicket = get_ticket_by_id($_SESSION['current_ticket_id']);
$ticketID = $_SESSION['current_ticket_id'];
unset($_SESSION['current_ticket_id']);

// Update the ticket attributes
if ($status != $currentTicket['status_id']) {
    // Status changed
    $prevStatus = get_status_name_by_id($currentTicket['status_id']);
    $currStatus = get_status_name_by_id($status);
    $action = "STATUS CHANGED: $prevStatus TO $currStatus";
    update_ticket_status($ticketID, $status);
    submit_ticket_record($ticketID, $action, $currentUserId);
}

if ($priority != $currentTicket['priority']) {
    // Priority changed
    $action = "PRIORITY CHANGED: {$currentTicket['priority']} TO $priority";
    update_ticket_priority($ticketID, $priority);
    submit_ticket_record($ticketID, $action, $currentUserId);
}

if ($assignee != $currentTicket['assigned_to']) {
    // Assignee changed
    $currentAssignee = get_username_by_id($currentTicket['assigned_to']);
    $newAssignee = get_username_by_id($assignee);
    $action = "ASSIGNED: $currentAssignee TO $newAssignee";
    update_ticket_assignee($ticketID, $assignee);
    submit_ticket_record($ticketID, $action, $currentUserId);
}

if ($department != $currentTicket['department_id']) {
    // Department changed
    $currentDepartment = get_department_by_id($currentTicket['department_id']);
    $newDepartment = get_department_by_id($department);
    $action = "DEPARTMENT CHANGED: $currentDepartment TO $newDepartment";
    update_ticket_department($ticketID, $department);
    submit_ticket_record($ticketID, $action, $currentUserId);
}

// Redirect to the ticket page
$base_url = 'http://' . $_SERVER['HTTP_HOST'];
$current_url_path = dirname($_SERVER['REQUEST_URI']);
$page_url = $base_url . $current_url_path . '/../pages/ticket.php?ticket_id=' . $ticketID;
header("Location: $page_url");


//action = "STATUS CHANGED: $prev status TO $curr status"
//action = "Sagent name ASSIGNED $assigned agent name"
//action = "$username edited $prev description TO $curr description

?>
