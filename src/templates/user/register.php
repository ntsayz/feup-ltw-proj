<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="without-aside">

	
    <div class="inner-container">
        <div class="box-container">
            <div class="box">
                <h1>Registration</h1>
                <form action="../actions/action_register.php" method="post" required>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="text" id="full_name" name="full_name" placeholder="Full Name" autocomplete="off" required/>
                    <input type="text" id="email" name="email" placeholder="Email" required/>
                    <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" required/>
                    <input type="password" id="password" name="password" placeholder="Password" required/>
                    <input type="text" id="ref_code" name="ref_code" placeholder="Referral Code"/>
                    <button type="submit" value="Next">Register</button>
                </form>
                <p>Already have an account? <a href="/pages/login.php">Login</a></p>
            </div>
        </div>
  </div>
  <p id="error_messages">
        <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
    </p>
</body>
</html>
