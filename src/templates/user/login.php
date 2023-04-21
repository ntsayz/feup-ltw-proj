<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style 
</head>
<body>
	<h2>Login Form</h2>
	<form action="../actions/action_login.php" method="post">
		<label for="username">Username</label>
		<input type="text" id="username" name="username" placeholder="Enter your username">

		<label for="password">Password</label>
		<input type="password" id="password" name="password" placeholder="Enter your password">

		<button type="submit">Login</button>
	</form>
</body>
</html>
