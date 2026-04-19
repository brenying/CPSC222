<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$username = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['username']);
	$password = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['password']);

	if ($username == "admin" && $password == "password") {
		$_SESSION['loggedin'] = true;
		$_SESSION['user'] = $username;
	}
	else {
		$error = "Invalid Login...";
	}
}

if(isset($_GET['action']) && $_GET['action'] == 'logout') {
	session_destroy();
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
	<header>
		<title>PHP Chapter 13</title>
		<meta name="viewport" content="width=width-device" />
		<meta charset="utf-8" />
	</header>
	<body>
<?php
if ($_SESSION['loggedin'] && $_SESSION['loggedin'] == true) {
?>
		<h1>Hello, <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
		<a href="chapt13.php?action=logout">Logout</a>
<?php
}
else {
	if ($_SERVER['REQUEST_METHOD'] === "POST" && $error) {
		echo $error;
	}

?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			Username: <input type="text" name="username" /><br>
			Password: <input type="password" name="password" /><br>
			<input type="submit" name="submit" value="Login" />
		</form>
<?php
}
?>
	</body>
</html>
