<?php
require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/tickets.php');

// Retrieve the filter values
$status = $_POST['status'];
$priority = $_POST['priority'];
$assignee = $_POST['assignee'];
$department = $_POST['department'];

echo "Status: $status<br>";
echo "Priority: $priority<br>";
echo "Assignee: $assignee<br>";
echo "Department: $department<br>";

// Get the tickets based on the filter values
$tickets = filter_tickets($status, $priority, $assignee, $department);

// Loop through the tickets and format them into HTML

?>

<div id="scrollabledivtickets" class="scrollable-div">
    <?php foreach ($tickets as $ticket): ?>
        <div class="ticket-box" data-overlay-id="overlay-<?php echo $ticket['id'] ?>">
            <h2><?php echo $ticket['title']; ?></h2>
            <p><?php echo $ticket['description']; ?></p>
            <!-- Other ticket details here... -->
        </div>
    <?php endforeach; ?>
</div>
