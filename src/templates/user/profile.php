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
<h1>You're logged in as <?php echo htmlentities($_SESSION['username']) ?></h1>
            <div class="content box"> 
                <form method="post" action="../actions/action_logout.php">
                    <button type="submit">Log out</button>
                </form>
            </div>

</body>

</html>




