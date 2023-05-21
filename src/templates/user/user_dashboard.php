<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
    <link rel="stylesheet" href="/css/user/style.css">
</head>

<body>
    <?php $currentPage = 'user_dashboard'; ?>
    <?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
        <?php require(__DIR__.'/../common/sidebar.php');
        require_once(__DIR__.'/../../database/tickets.php');
        require_once(__DIR__.'/../../database/user.php');
        require_once(__DIR__.'/../../database/departments.php');
        require_once(__DIR__.'/../../database/status.php');
        require_once(__DIR__.'/../../database/messages.php');
        ?>
        <main class="dashboard">


            <div class="user-info dash-box">
                <h3>Info</h3>
                <?php
                    $user_id = $_SESSION['target_user_id'];
                    echo "<p> <strong>" . htmlentities(get_username_by_id($user_id)) . "</strong> " .
                         "(".htmlentities( get_full_name($user_id)) . ")". "</p>";
                ?>
            </div>

            <div class="user-records dash-box">
            <h3>User Records</h3>
            <div class="scrollable" style="max-height: 200px; overflow-y: auto;">
                <?php
                $ticketsRecords = get_ticket_records_by_author($user_id);
                foreach ($ticketsRecords as $record) {
                    echo "<p><strong> Ticket#" . htmlentities($record['id'])."</strong> " .
                        htmlentities($record['action']) . "</p>";
                }
                ?>
            </div>
        </div>


            <div class="user-tickets dash-box">
                <h3>Tickets submissions</h3>
                <?php
                $tickets_submitted = get_ticket_submissions_by_user($user_id);
                foreach ($tickets_submitted as $ticket) {
                    echo "<p> <strong>" . htmlentities($ticket['title']) ."#" . htmlentities($ticket['id']). "</strong> " .
                          "</p>";
                }
                ?>
            </div>

            <?php
             // Fetch the current user type from the session
            $currentUserType = $_SESSION['user_type'];
            $target_user_type =  get_user_type_by_id($user_id);
            $_SESSION['target_user_id'] = $user_id;
            ?>

            <?php if ($currentUserType === 'admin') { ?>
                <div class="user-type-selection dash-box">
                
                    <h3>Select User Type</h3>
                    <form action="../../actions/change_user_type.php" method="post">
                        <select id="user-type" name="user-type">
                            <option value="admin" <?php if ($target_user_type === 'admin') { echo 'selected'; } ?>>Admin</option>
                            <option value="client" <?php if ($target_user_type === 'client') { echo 'selected'; } ?>>Client</option>
                            <option value="agent" <?php if ($target_user_type === 'agent') { echo 'selected'; } ?>>Agent</option>
                        </select>
                        <input type="submit" value="Change User Type">
                    </form>
                </div>
            <?php } ?>


            <div class="user-departments dash-box">
                <h1>User Departments</h1>
                <?php
                // Get the user department data from the database
                $user_departments = get_departments_by_agent_id($user_id);
                // Loop through the user departments and display the department and users
                foreach ($user_departments as $department_id) {
                    echo '<div class="user-department-item">';
                    echo '<h2 class="user-department-title" id="' . $department_id . '">' . htmlentities(get_department_by_id($department_id)) . '</h2>';
                    if($_SESSION['user_type'] === 'admin') {
                        echo '<button class="remove-user-button" data-user-id=" '.$user_id .'" data-department-id="'.$department_id.'">Remove Department</button>';
                    }
                    echo '</div>';
                }
                ?>
            </div>


        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>
