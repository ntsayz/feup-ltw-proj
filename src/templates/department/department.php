<!DOCTYPE html>
<html>
<?php
$dep_id = $_SESSION['target_department_id'];
?>
<head>
    <title>Department</title>
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
        <?php require_once(__DIR__.'/../../database/tickets.php');
            require_once(__DIR__.'/../../database/user.php');
            require_once(__DIR__.'/../../database/departments.php');
            require_once(__DIR__.'/../../database/status.php');
            require_once(__DIR__.'/../../database/messages.php');
            require_once(__DIR__.'/../../database/admin.php'); ?>
        ?>
        <main class="dashboard">


            <div class="dep-info dash-box">
                <?php
                $dep_name = get_department_by_id($dep_id);
                    echo '<h2>'.htmlentities($dep_name).'</h2>';
                ?>
            </div>
            <div class="agents dash-box">
    <h3>Agents</h3>
    <div class="scrollable" style="max-height: 200px; overflow-y: auto;">
        <?php
        $agents = get_agents_by_department($dep_id);
        foreach ($agents as $agent) {
            echo "<p><strong>" . htmlentities(get_full_name($agent['agent_id']))."</strong> ";
        }
        ?>
    </div>

    <?php if($_SESSION['user_type'] === "admin"){ ?>

            <h3>Add Agent</h3>
            <form action="/actions/action_add_agent_to_dep.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <label for="agent-select">Select Agent:</label>
                <select id="agent-select" name="agent_id">
                    <?php
                    $users = get_all_users();
                    foreach ($users as $user) {
                        // Check if the user is already an agent in the department
                        $isAgent = is_agent_in_department($user['id'], $dep_id);
                        if (!$isAgent) {
                            echo "<option value='" . $user['id'] . "'>" . htmlentities($user['full_name']) . "</option>";
                        }
                    }
                    ?>
                </select>
                <input type="hidden" name="dep_id" value="<?php echo $dep_id; ?>">
                <input type="submit" name="add_agent" value="Add">
            </form>
        </div>
        <?php } ?>


            <div class="ticket-records dash-box">
                <h3>Tickets Assigned</h3>
                <div class="scrollable" style="max-height: 200px; overflow-y: auto;">
                    <?php
                    $ticketsRecords = get_tickets_by_department($dep_id);
                    foreach ($ticketsRecords as $record) {
                        echo "<p><strong> Ticket#" . htmlentities($record['id'])."</strong> " .
                            htmlentities($record['action']) . "</p>";
                    }
                    ?>
                </div>
            </div>

            


        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>