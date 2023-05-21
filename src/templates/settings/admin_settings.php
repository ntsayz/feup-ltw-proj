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
                require_once(__DIR__.'/../../database/messages.php');
                require_once(__DIR__.'/../../database/admin.php'); ?>

       


            <div class="user-list dash-box">
                <h3>All Users</h3>
                <ul>
                <?php
                $users = get_all_users();
                foreach ($users as $user) {
                    echo '<li><a href="/pages/user_dashboard.php?id=' . $user['id'] . '">' . htmlentities($user['username']) . '</a></li>';
                }
                ?>
                </ul>
            </div>

            
        </main>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>