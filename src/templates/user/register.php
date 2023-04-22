<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
	
    <div class="inner-container">
        <div class="box">
            <h1>Register</h1>
            <form action="../actions/action_register.php" method="post">
                <input type="text" id="full_name" name="full_name" placeholder="Full Name"/>
                <input type="text" id="email" name="email" placeholder="Email"/>
                <input type="text" id="username" name="username" placeholder="Username"/>
                <input type="password" id="password" name="password" placeholder="Password"/>
                <input type="text" id="ref_code" name="ref_code" placeholder="Referral Code"/>
                <button type="submit" value="Next">Register</button>
            </form>
        <p>Already have an account? <a>Login</a></p>
    </div>
  </div>
  <p id="error_messages">
        <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
    </p>
</body>
</html>
