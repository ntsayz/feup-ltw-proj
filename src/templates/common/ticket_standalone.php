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
                        
                    <div id="ticket-data" data-ticket-id="<?php echo $ticket['id']; ?>"></div>
                    <input type="text" name="chat-input" id="chat-input" class="ticket-input">
                    <button id="send-button" class="send-button">Send</button>

                    

                
                        
                        <div class="ticket-buttons">
                        <?php
                        $tickets_tracked = get_tickets_tracked_by_user();
                        $tracked = false;
                        if (is_array($tickets_tracked) || is_object($tickets_tracked)) {
                            foreach ($tickets_tracked as $ticket_tracked) {
                                if ($ticket_tracked['ticket_id'] == $ticket['id']) {
                                    $tracked = true;
                                    break;
                                }
                            }
                        }
                        ?>

                        <div>
                            <button class="ticket-blue-button track-button" style="<?php echo $tracked ? 'display: none;' : '' ?>" data-ticket-id="<?php echo $ticket['id'] ?>"
                                data-user-id="<?php echo $_SESSION['id'] ?>">Track</button>
                            <button class="ticket-blue-button untrack-button" style="<?php echo $tracked ? '' : 'display: none;' ?>" data-ticket-id="<?php echo $ticket['id'] ?>"
                                data-user-id="<?php echo $_SESSION['id'] ?>">Untrack</button>
                        </div>

                            <?php if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'agent') { ?>
                                <button class="ticket-blue-button" id="add-ticket-button">Options</button>
                            <?php }?>
                        </div>
                    </div>

                    <div class="overlay-info">
                        <p><?php echo htmlentities($ticket['created_at']) ?></p>
                    </div>
                </div>
            </div>        
        </div>
    </main>

    <?php
        $tickets_submitted = get_ticket_submissions_by_user($_SESSION['id']);
        $submitted = false;
        if (is_array($tickets_submitted) || is_object($tickets_submitted)) {
            foreach ($tickets_submitted as $tickets_submitted) {
                if ($tickets_submitted['created_by'] == $_SESSION['id']) {
                    $submitted = true;
                    break;
                }
            }
        }
        ?>

    <?php

    if($submitted || $_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'agent' ) { ?>

    <aside class="ticket-form">
        <form action="../../actions/action_submit_ticket_change.php" method="post" required>
            <div>
                <label for="status">Status</label><br>
                <select id="status" name="status" required>
                    <?php
                    $statuses = get_statuses();
                    foreach ($statuses as $status) {
                        $selected = ($status['id'] == $ticket['status_id']) ? 'selected' : '';
                        echo "<option value='{$status['id']}' $selected>{$status['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="priority">Priority</label><br>
                <select id="priority" name="priority" required>
                    <?php for ($i = 1; $i <= 5; $i++) {
                        $selected = ($i == $ticket['priority']) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="assignee">Assigned Agent</label><br>
                <select id="assignee" name="assignee" required>
                    <?php
                    $agents = get_agent_departments();
                    $hasAssignedAgent = !is_null($ticket['assigned_to']);
                    
                    
                    echo "<option value='NULL' selected>None</option>";
                    
                    
                    foreach ($agents as $agent) {
                        $selected = ($agent['agent_id'] == $ticket['assigned_to']) ? 'selected' : '';
                        $username = get_username_by_id($agent['agent_id']);
                        $dep_name = get_department_by_id($agent['department_id']);
                        echo "<option value='{$agent['agent_id']}' $selected>{$username} ({$dep_name})</option>";
                    }
                    ?>
                </select>
            </div>



            <div>
                <label for="department">Department</label><br>
                <select id="department" name="department">
                    <option value="">None</option>
                    <?php
                    $departments = get_departments();
                    foreach ($departments as $department) {
                        $selected = ($department['id'] == $ticket['department_id']) ? 'selected' : '';
                        echo "<option value='{$department['id']}' $selected>{$department['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <?php
                $_SESSION['current_ticket_id'] = $ticket['id'];
            ?>

            <div>
                <input type="submit" value="Submit" class="ticket-blue-button">
            </div>
        </form>
    </aside>

    <?php } ?>

</div>

<script src="/scripts/script.js"></script>
<script src="/scripts/ticket/tracking.js"></script>
</body>
</html>
