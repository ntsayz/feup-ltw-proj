<!DOCTYPE html>
<html>

<head>
    <title>Main Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/positioning.css">
</head>

<body class="without-aside">
    <h2>You're logged in as <?php echo htmlentities($_SESSION['username']) ?> and you are a/an <?php echo htmlentities($_SESSION['user_type']) ?></h2>

    <div class="content box"> 
        <h2>Change Username</h2>
        <form method="post" action="../actions/action_change_username.php">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username">
            <button type="submit">Change Username</button>
        </form>
        
        <h2>Change Password</h2>
        <form method="post" action="../actions/action_change_password.php">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">
            <button type="submit">Change Password</button>
        </form>
        
        <h2>Change Email</h2>
        <form method="post" action="../actions/action_change_email.php">
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email">
            <button type="submit">Change Email</button>
        </form>
        
        <h2>Logout</h2>
        <form method="post" action="../actions/action_logout.php">
            <button type="submit">Log out</button>
        </form>
    </div>
</body>

</html>




