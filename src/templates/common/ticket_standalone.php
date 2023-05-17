<?php
require_once(__DIR__.'/../../database/messages.php');
require_once(__DIR__.'/../../database/tickets.php');
require_once(__DIR__.'/../../database/user.php');
require_once(__DIR__.'/../../database/status.php');
require_once(__DIR__.'/../../database/departments.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlentities($ticket['title']) ?> #<?php echo htmlentities($ticket['id']) ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ticket/style.css">
    <style>
        .wrapper {
            display: flex;
            height: 100vh;
        }

        main {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
        }

        aside {
            background-color: var(--main-blue-darker);
            color: var(--tea-green);
            width: 20%;
            padding: 10px;
        }
    </style>
</head>
<?php require(__DIR__.'/../common/header.php'); ?>
<body>

<div class="wrapper">
    <main>
        <div class="">
            <div id="overlay-<?php echo $ticket['id'] ?>" class="">
                <div class="">
                    <h1>
                        <?php echo htmlentities($ticket['title']) ?><small> #<?php echo htmlentities($ticket['id']) ?></small>
                    </h1>

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
                        <input class="ticket-input">
                        <div class="ticket-buttons">
                            <button class="ticket-blue-button" id="add-ticket-button">Track</button>

                            <?php if ($_SESSION['user_type'] === 'admin' || $SESSION['user_type'] === 'agent') { ?>
                                <button class="ticket-blue-button" id="add-ticket-button">Options</button>
                            <?php }?>
                        </div>
                    </div>

                    <div class="overlay-info">
                        <p>Priority: <?php echo htmlentities($ticket['priority']) ?></p>|
                        <p>Status: <?php echo htmlentities(get_status_name_by_id($ticket['status_id'])) ?></p>|
                        <p>Created by <?php echo htmlentities(get_username_by_id($ticket['created_by'])) ?></p>|
                        <p>Department: <?php echo htmlentities(get_department_by_id($ticket['department_id'])) ?></p>
                        <p>Created at: <?php echo htmlentities($ticket['created_at']) ?></p>
                    </div>
                </div>
            </div>        
        </div>
    </main>

    <aside class= "ticket-form">
        <form action="" method="post" required>
                
                <div>
                    <label for="priority">Priority</label><br>
                    <select id="priority" name="priority" required>
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="department">Department</label><br>
                    <select id="department" name="department">
                        <option value="">None</option>
                        <?php
                        $departments = get_departments();
                        foreach ($departments as $department) {
                        ?>
                            <option value="<?php echo $department['id']; ?>">
                                <?php echo get_department_by_id($department['id']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="priority">Priority</label><br>
                    <select id="priority" name="priority" required>
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <input type="submit" value="Submit" onclick="" class="ticket-blue-button">
                </div>

        </form>
    </aside>
</div>
</body>
</html>
