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

        <div id="scrollableDiv" class="scrollable-div">
        <?php
        require_once(__DIR__.'/../../database/tickets.php');
            $tickets = get_tickets();
            foreach ($tickets as $ticket) {
        ?>
                <div class="ticket-box" data-overlay-id="overlay-<?php echo $ticket['id'] ?>">
                    <h2><?php echo htmlentities($ticket['title']) ?></h2>
                    <p><?php echo htmlentities($ticket['content']) ?></p>
                </div>
                
                <div id="overlay-<?php echo $ticket['id'] ?>" class="overlay">
                    <p>This is an overlay for ticket <?php echo htmlentities($ticket['title']) ?>. Click anywhere to close.</p>
                </div>
        <?php
            }
        ?>

        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>