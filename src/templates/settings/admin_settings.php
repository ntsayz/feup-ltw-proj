<!DOCTYPE html>
<html>

<head>
    <title>Back-office</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
    <link rel="stylesheet" href="/css/user/style.css">
</head>

<body>
<?php $currentPage = 'admin_set'; ?>
<?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
        
        <?php require(__DIR__.'/../common/sidebar.php'); ?>
        <main class="container w_aside">

        <div class="dashboard">

                <?php
                        require_once(__DIR__.'/../../database/tickets.php');
                        require_once(__DIR__.'/../../database/user.php');
                        require_once(__DIR__.'/../../database/departments.php');
                        require_once(__DIR__.'/../../database/status.php');
                        require_once(__DIR__.'/../../database/messages.php');
                        require_once(__DIR__.'/../../database/admin.php'); ?>

            


                    <div class="user-list dash-box">
                        <h3>Users</h3>
                        <div class="scrollable" style="max-height: 200px; overflow-y: auto;">
                            <?php
                            $users = get_all_users();
                            foreach ($users as $user) {
                                echo '<p><a href="/pages/user_dashboard.php?id=' . $user['id'] . '">'
                                 .htmlentities($user['full_name']). " (".htmlentities($user['username']).")" . '</a></p>';
                            }
                            ?>
                        </div>
                        
                    </div>
                    <div class="user-list dash-box">
                        <h3>Agents</h3>
                        <div class="scrollable" style="max-height: 200px; overflow-y: auto;">
                            <?php
                            foreach ($users as $user) {
                                if($user['user_type'] == "agent"){
                                echo '<p><a href="/pages/user_dashboard.php?id=' . $user['id'] . '">'
                                 .htmlentities($user['full_name']). " (".htmlentities($user['username']).")" . '</a></p>';
                                }
                            }
                            ?>
                        </div>
                        
                    </div>

                    <div class="department-list dash-box">
                        <h3>Departments</h3>
                        <ul>
                            <?php
                            $departments = get_departments();
                            foreach ($departments as $department) {
                                echo '<p><a href="/pages/department.php?id=' . $department['id'] . '">' . htmlentities($department['name']) . '</p></a>';
                            }
                            ?>
                        </ul>

                        <h3>Add Department</h3>
                        <form action="/actions/action_add_department.php" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <label for="department-name">Department Name:</label>
                            <input type="text" id="department-name" name="department_name" required>
                            <input type="submit" name="add_department" value="Add">
                        </form>
                    </div>

                    <div class="status-list dash-box">
                        <h3>Status</h3>
                        <ul>
                            <?php
                            $statuses = get_statuses();
                            foreach ($statuses as $status) {
                                echo '<p>' . htmlentities($status['name']) . '</p>';
                            }
                            ?>
                        </ul>

                        <h3>Add Status</h3>
                        <form action="/actions/action_add_status.php" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <label for="status-name">Status Name:</label>
                            <input type="text" id="status-name" name="status_name" required>
                            <input type="submit" name="add_status" value="Add">
                        </form>
                    </div>


                </main>
            </div>
        </div>

            
        </main>
    

    <script src="/scripts/script.js"></script>
</body>

</html>