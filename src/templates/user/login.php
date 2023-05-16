<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="without-aside">

	
    <div class="inner-container">
    <div class="box-container">
        <div class="box">
            <h1>Login</h1>
            <form action="../actions/action_login.php" method="post" required>
                <input type="text" id="username" name="username" placeholder="username" autocomplete="off" required/>
                <input type="password" id="password" name="password" placeholder="password" required/>
                 <button type="submit" value="Next">Login</button>
            </form>
            <p>Don't have an account? <a href="/pages/register.php">Register</a></p>
        </div>
    </div>
  </div>
  <p id="error_messages">
        <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
    </p>
</body>
</html>
