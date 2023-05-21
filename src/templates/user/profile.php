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
<?php require(__DIR__.'/../common/header.php'); ?>
    <div class="wrapper">
    <h2><?php echo htmlentities($_SESSION['username']) ?> (<?php echo htmlentities($_SESSION['user_type']) ?>)</h2>
    <?php 
    $currentPage = 'profile';
    require(__DIR__.'/../common/sidebar.php'); ?>
        <div class="box-container">
            <div class="box"> 


                <h2>Change Username</h2>
                <form method="post" action="../actions/action_change_username.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                
                <?php if(isset($_SESSION['ERROR'])) { ?>
                    <small style="color:red"><?php echo htmlentities($_SESSION['ERROR']) ?></small>

                <?php } else if(isset($_SESSION['SUCCESS'])){ ?>
                <small style="color:green"><?php echo htmlentities($_SESSION['SUCCESS']) ?></small>
                <?php } unset($_SESSION['ERROR']);unset($_SESSION['SUCCESS']); ?>

                    <input type="text" id="new_username" name="new_username" placeholder="Enter the new username">
                    <button type="submit">Change Username</button>

                </form>

                
                <h2>Change Password</h2>
                <form method="post" action="../actions/action_change_password.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <?php if(isset($_SESSION['ERROR'])) { ?>
                        <small style="color:red"><?php echo htmlentities($_SESSION['ERROR']) ?></small>

                    <?php } else if(isset($_SESSION['SUCCESS'])){ ?>
                    <small style="color:green"><?php echo htmlentities($_SESSION['SUCCESS']) ?></small>
                    <?php } unset($_SESSION['ERROR']);unset($_SESSION['SUCCESS']); ?>


                    <input type="password" id="new_password" name="new_password" placeholder="Enter the new password">
                    <button type="submit">Change Password</button>
                </form>
                
                <h2>Change Email</h2>
                <form method="post" action="../actions/action_change_email.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <?php if(isset($_SESSION['ERROR'])) { ?>
                        <small style="color:red"><?php echo htmlentities($_SESSION['ERROR']) ?></small>

                    <?php } else if(isset($_SESSION['SUCCESS'])){ ?>
                    <small style="color:green"><?php echo htmlentities($_SESSION['SUCCESS']) ?></small>
                    <?php } unset($_SESSION['ERROR']);unset($_SESSION['SUCCESS']); ?>


                    <input type="email" id="new_email" name="new_email" placeholder="Enter the new email">
                    <button type="submit">Change Email</button>
                </form>
            </div>


            <div class="box" style="margin-top:30px">
            <form method="post"  action="../actions/action_logout.php">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <button type="submit">Log out</button>
                </form>
            </div>

        </div>
    </div>

   
</body>

</html>




