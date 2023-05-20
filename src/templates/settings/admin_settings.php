<!DOCTYPE html>
<html>

<head>
    <title>Back-office</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
</head>

<body>
<?php $currentPage = 'admin_set'; ?>
<?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
        
        <?php require(__DIR__.'/../common/sidebar.php'); ?>
        <main class="container w_aside">

        <?php
                require_once(__DIR__.'/../../database/tickets.php');
                require_once(__DIR__.'/../../database/user.php');
                require_once(__DIR__.'/../../database/departments.php');
                require_once(__DIR__.'/../../database/status.php');
                require_once(__DIR__.'/../../database/messages.php'); ?>

        <div id="filter-ticket-overlay" class="overlay">
                <div class="overlay-content-forms">
                    <h3>Filter Tickets</h3>
                    <?php if (isset($_SESSION['ERROR'])) { ?>
                        <small style="color:red"><?php echo htmlentities($_SESSION['ERROR']) ?></small>

                    <?php } else if (isset($_SESSION['SUCCESS'])) { ?>
                        <small style="color:green"><?php echo htmlentities($_SESSION['SUCCESS']) ?></small>
                    <?php } unset($_SESSION['ERROR']);unset($_SESSION['SUCCESS']); ?>
                    </form>

                    <form action="" method="post" required>
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
            
        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>