<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
	
    <div class="inner-container">
        <div class="box">
            <h1>Login</h1>
            <form action="../actions/action_login.php" method="post">
                <input type="text" id="username" name="username" placeholder="username"/>
                <input type="text id="password" name="password" placeholder="password"/>
                 <button type="submit">Login</button>
            </form>
        <p>Not a member <a> Sign Up</a></p>
    </div>
  </div>
</body>
</html>
