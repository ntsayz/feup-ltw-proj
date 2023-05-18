<?php
require_once(__DIR__.'/../../database/messages.php');
require_once(__DIR__.'/../../database/tickets.php');
require_once(__DIR__.'/../../database/user.php');
require_once(__DIR__.'/../../database/status.php');
require_once(__DIR__.'/../../database/departments.php');
?>

<div id="overlay-<?php echo $ticket['id'] ?>" class="overlay">
    <div class="overlay-content">
        <a><h2 class="ticket-forward" data-ticket-id="<?php echo $ticket['id']?>"><?php echo htmlentities($ticket['title']) ?></h2></a>
        <p><?php echo htmlentities($ticket['description']) ?></p>
        
        
        <div class="ticket-records">
            <h2>Ticket Records</h2>
            <div class="ticket-records-messages">
                <?php 
                $ticket_records = get_ticket_records($ticket['id']);
                foreach ($ticket_records as $record) {
                    echo "<p> <strong>" . htmlentities(get_username_by_id($record['author_id'])) . "</strong> " .
                        htmlentities($record['action']) . "</p>";
                }
                ?>
            </div>
        </div>

        <div class="ticket-conversations">
            <h2>Conversations</h2>
            <div class="ticket-conversations-messages">
                <?php 
                $messages = get_messages($ticket['id']);
                foreach ($messages as $message) {
                    echo "<p><strong>" . htmlentities(get_username_by_id($message['author_id'])) . "</strong>: " .
                        htmlentities($message['message']) . "</p>";
                }
                ?>
            </div>
        </div>

        <div class="ticket-overlay-buttons">
            <div>
                <button class="ticket-blue-button" id="add-ticket-button">Track</button>
            </div>

            <?php if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'agent') { ?>
                <div>
                    <button class="ticket-blue-button" id="add-ticket-button">Options</button>
                </div>
            <?php }?>

            <div>
                <button class="ticket-blue-button ticket-forward" data-ticket-id="<?php echo $ticket['id']?>">More</button>
            </div>
        </div>

        <div class="overlay-info">
            <p>Priority: <?php echo htmlentities($ticket['priority']) ?></p>|
            <p>Status: <?php echo htmlentities(get_status_name_by_id($ticket['status_id'])) ?></p>|
            <p>Created by <?php echo htmlentities(get_username_by_id($ticket['created_by'])) ?></p>|
            <p>Department: <?php echo htmlentities(get_department_by_id($ticket['department_id'])) ?></p>
        </div>
        
    </div>
</div>
