<!DOCTYPE html>
<html>

<head>
    <title>Main Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
</head>

<body>
<?php $currentPage = 'home'; ?>
<?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
        
        <?php require(__DIR__.'/../common/sidebar.php'); ?>
        <main class="container w_aside">
        <h3>All Tickets</h3>
        <div id="scrollableDiv" class="scrollable-div">
            <?php
                require_once(__DIR__.'/../../database/tickets.php');
                require_once(__DIR__.'/../../database/user.php');
                require_once(__DIR__.'/../../database/departments.php');
                require_once(__DIR__.'/../../database/status.php');
                require_once(__DIR__.'/../../database/messages.php');
                $tickets = get_tickets();
                foreach ($tickets as $ticket) {
            ?>
                    <div class="ticket-box" data-overlay-id="overlay-<?php echo $ticket['id'] ?>">
                        <small class="very-small-text">Ticket#<?php echo htmlentities($ticket['id']) ?></small>
                        <h2><?php echo htmlentities($ticket['title']) ?></h2>
                        <p><?php echo htmlentities( substr($ticket['description'],0,45)) ?>...</p>
                    </div>
                    
                    <div id="overlay-<?php echo $ticket['id'] ?>" class="overlay">
    <div class="overlay-content">
        <h1><?php echo htmlentities($ticket['title']) ?></h1>
        <p><?php echo htmlentities($ticket['description']) ?></p>

        <div class="ticket-records">
            <h2>Ticket Records</h2>
            <div class="ticket-records-messages">
                <?php 
                    $ticket_records = get_ticket_records($ticket['id']);
                    foreach ($ticket_records as $record) {
                        echo "<p> <strong>" . htmlentities(get_username_by_id($record['author_id'])) . "</strong> ".htmlentities($record['action']). "</p>";
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
                        echo "<p><strong>".htmlentities(get_username_by_id($message['author_id'])). "</strong>: " . htmlentities($message['message']) . "</p>";
                    }
                ?>
            </div>
        </div>

        <div class="ticket-overlay-buttons">
            <div>
                <button class="ticket-blue-button" id="add-ticket-button">Track</button>
            </div>

            <div>
                <button class="ticket-blue-button" id="add-ticket-button">Reply</button>
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

            <?php
                }
            ?>

        </div>
        <div>
            <button class="main-blue-button" id="add-ticket-button">Submit new ticket</button>
        </div>

        <h3>Submissions and tracking</h3>

        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>