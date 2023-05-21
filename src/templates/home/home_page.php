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

        <h3>Submissions and tracking</h3>
            

            <div id="scrollableDiv" class="scrollable-div">
                <?php
                require_once(__DIR__.'/../../database/tickets.php');
                require_once(__DIR__.'/../../database/user.php');
                require_once(__DIR__.'/../../database/departments.php');
                require_once(__DIR__.'/../../database/status.php');
                require_once(__DIR__.'/../../database/messages.php');
                $tickets = get_tickets();
               $tracked_tickets = get_tickets_tracked_and_submitted_by_user();

               if ($tracked_tickets === -1 || $tracked_tickets === 0) {
                   echo "<h2>You have no submitted or tracked tickets yet</h2>";
               } else {
                   foreach ($tracked_tickets as $ticket) {
                ?>
                    <div class="ticket-box" data-overlay-id="overlay-<?php echo $ticket['id'] ?>">
                        <small class="very-small-text">Ticket#<?php echo htmlentities($ticket['id']) ?></small>
                        <h2><?php echo htmlentities($ticket['title']) ?></h2>
                        <p><?php echo htmlentities(substr($ticket['description'], 0, 45)) ?>...</p>
                    </div>
                    
                    <?php require(__DIR__.'/../common/ticket_overlay.php');?>

                <?php
                }}
                ?>

            </div>
           

            <div id="new-ticket-overlay" class="overlay">
                <div class="overlay-content-forms">
                    <h3>Submit New Ticket</h3>
                    <?php if (isset($_SESSION['ERROR'])) { ?>
                        <small style="color:red"><?php echo htmlentities($_SESSION['ERROR']) ?></small>

                    <?php } else if (isset($_SESSION['SUCCESS'])) { ?>
                        <small style="color:green"><?php echo htmlentities($_SESSION['SUCCESS']) ?></small>
                    <?php } unset($_SESSION['ERROR']);unset($_SESSION['SUCCESS']); ?>
                    </form>

                    <form action="../../actions/action_submit_ticket.php" method="post" required>
                        <div>
                            <input type="text" id="title" name="title" placeholder="Title" required>
                        </div>

                        <div>
                            <textarea id="description" name="description" class="fixed-size-textarea"
                                placeholder="Write the description here" required></textarea>
                        </div>

                        <div>
                            <label for="priority">Priority</label>
                            <select id="priority" name="priority" required>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label for="department">Department</label>
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
                            <input type="submit" value="Submit" onclick="openNewTicketOverlay()" class="ticket-blue-button">
                        </div>

                    </form>


                </div>
            </div>

            <div>
                <button class="main-blue-button" id="add-ticket-button"
                    onclick="document.getElementById('new-ticket-overlay').style.display='flex'">Submit new
                    ticket</button>
            </div>

            <h3>All Tickets</h3>

            <div  class="scrollable-div">
                <?php
                
                foreach ($tickets as $ticket) {
                ?>
                    <div class="ticket-box" data-overlay-id="overlay-<?php echo $ticket['id'] ?>">
                        <small class="very-small-text">Ticket#<?php echo htmlentities($ticket['id']) ?></small>
                        <h2><?php echo htmlentities($ticket['title']) ?></h2>
                        <p><?php echo htmlentities(substr($ticket['description'], 0, 45)) ?>...</p>
                    </div>
                    
                    <?php require(__DIR__.'/../common/ticket_overlay.php');?>

                <?php
                }
                ?>

            </div>



            <div id="filter-ticket-overlay" class="overlay">
                <div class="overlay-content-forms">
                    <h3>Filter Tickets</h3>
                    <?php if (isset($_SESSION['ERROR'])) { ?>
                        <small style="color:red"><?php echo htmlentities($_SESSION['ERROR']) ?></small>

                    <?php } else if (isset($_SESSION['SUCCESS'])) { ?>
                        <small style="color:green"><?php echo htmlentities($_SESSION['SUCCESS']) ?></small>
                    <?php } unset($_SESSION['ERROR']);unset($_SESSION['SUCCESS']); ?>
                    

                    <form action="../../actions/action_filter_tickets.php" method="post" required>
                    <div>
                        <label for="status">Status</label><br>
                        <select id="status" name="status" required>
                            <?php
                            $statuses = get_statuses();
                            echo "<option value='NULL' selected>All</option>";
                            foreach ($statuses as $status) {
                                $selected = ($status['id'] == 1) ? 'selected' : '';
                                echo "<option value='{$status['id']}' $selected>{$status['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="priority">Priority</label><br>
                        <select id="priority" name="priority" required>
                            <?php
                                echo "<option value='NULL' selected>All</option>";
                                for ($i = 1; $i <= 5; $i++) {
                                $selected = ($i == 1) ? 'selected' : '';
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
                            
                            
                            echo "<option value='NULL' selected>All</option>";
                            
                            
                            foreach ($agents as $agent) {
                                $username = get_username_by_id($agent['agent_id']);
                                $dep_name = get_department_by_id($agent['department_id']);
                                echo "<option value='{$agent['agent_id']}'>{$username} ({$dep_name})</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="department">Department</label><br>
                        <select id="department" name="department">
                            <option value="NULL">All</option>
                            <?php
                            $departments = get_departments();
                            foreach ($departments as $department) {
                                $selected = ($department['id'] ==1) ? 'selected' : '';
                                echo "<option value='{$department['id']}' $selected>{$department['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>


                                <div>
                                    <input type="submit" value="Submit" onclick="" class="ticket-blue-button">
                                </div>

                        </form>

                        


                        </div>
                    </div>

            <div class="filter-container ticket-buttons">
                <button class="main" id="filter-tickets-button"
                    onclick="document.getElementById('filter-ticket-overlay').style.display='flex'">Filter</button>
            </div>


            <h3>Submissions and tracking</h3>
            

           
            

            

        </main>
    </div>

    <script src="/scripts/script.js"></script>
    <script src="/scripts/ticket/tracking.js"></script>
</body>

</html>
