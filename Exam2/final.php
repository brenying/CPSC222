<?php
// TODO:
// make personal page
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<header>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
	</header>
	<body>
		<h1>CPSC222 Final Exam</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$_SESSION['username'] = $username;

	if ($username == "Brennen" && $password == "password") {
?>
		<h3>Welcome, <?php echo htmlspecialchars($username); ?>! (<a href="final_logout.php">Log Out</a>)</h3>
		<p>Dashboard:</p>
		<ul>
			<li><a href="final.php?page=1">User List</a></li>
			<li><a href="final.php?page=2">Group List</a></li>
			<li><a href="final.php?page=3">Syslog</a></li>
		</ul>
		<hr>
<?php
		echo date("Y-m-d h:i:s A");
	}
	else {
		header("Location: final.php?page=999");
		exit();
	}
}
elseif (isset($_GET['page'])) {
	$page = $_GET['page'];
	if ($page == '1') {
		$username = $_SESSION['username'];
?>
		<h3>Welcome, <?php echo htmlspecialchars($username); ?>! (<a href="final_logout.php">Log Out</a>)</h3>
		<?php $_SERVER['REQUEST_METHOD'] == 'POST'; ?>
		<a href="final.php"><- Back to Dashboard</a>
		<h4>User List</h4>
<?php
		$lines = file('/etc/passwd');
?>
		<table border=1>
			<tr>
				<th>Username</th>
				<th>Password</th>
				<th>UID</th>
				<th>GID</th>
				<th>Display Name</th>
				<th>Home Directory</th>
				<th>Default Shell</th>
			</tr>
<?php
		foreach($lines as $line) {
			if(trim($line) == '') {
				continue;
			}
			$data = explode(":", $line);
			echo "<tr>";
			echo "<td>" . htmlspecialchars($data[0]) . "</td>";
			echo "<td>" . htmlspecialchars($data[1]) . "</td>";
			echo "<td>" . htmlspecialchars($data[2]) . "</td>";
			echo "<td>" . htmlspecialchars($data[3]) . "</td>";
			echo "<td>" . htmlspecialchars($data[4]) . "</td>";
			echo "<td>" . htmlspecialchars($data[5]) . "</td>";
			echo "<td>" . htmlspecialchars($data[6]) . "</td>";
			echo "</tr>";
		}
?>
		</table>
		<hr>
<?php
		echo date("Y-m-d h:i:s A");
	}
	elseif ($page == '2') {
		$username = $_SESSION['username'];
?>
		<h3>Welcome, <?php echo htmlspecialchars($username); ?>! (<a href="final_logout.php">Log Out</a>)</h3>
		<?php $_SERVER['REQUEST_METHOD'] == 'POST'; ?>
		<a href="final.php"><- Back to Dashboard</a>
		<h4>Group List</h4>
<?php
		$lines = file('/etc/group');
?>
		<table border=1>
			<tr>
				<th>Group Name</th>
				<th>Password</th>
				<th>GID</th>
				<th>Users</th>
			</tr>
<?php
		foreach($lines as $line) {
			if(trim($line) == '') {
				continue;
			}
			$data = explode(":", $line);

			echo "<tr>";
			echo "<td>" . htmlspecialchars($data[0]) . "</td>";
			echo "<td>" . htmlspecialchars($data[1]) . "</td>";
			echo "<td>" . htmlspecialchars($data[2]) . "</td>";
			echo "<td>" . htmlspecialchars($data[3]) . "</td>";
			echo "</tr>";
			}
?>
		</table>
		<hr>
<?php
		echo date("Y-m-d h:i:s A");
	}
	elseif ($page == '3') {
		$username = $_SESSION['username'];
?>
		<h3>Welcome, <?php echo htmlspecialchars($username); ?>! (<a href="final_logout.php">Log Out</a>)</h3>
		<?php $_SERVER['REQUEST_METHOD'] == 'POST'; ?>
		<a href="final.php"><- Back to Dashboard</a>
		<h4>Syslog</h4>
<?php
		$lines = file('/var/log/syslog');
?>
		<table border=1>
			<tr>
				<th>Date</th>
				<th>Hostname</th>
				<th>Application [PID]</th>
				<th>Message</th>
			</tr>
<?php
		foreach($lines as $line) {
			if(trim($line) == '') {
				continue;
			}
			$data = explode(" ", $line, 6);
			echo "<tr>";
			echo "<td>" . htmlspecialchars($data[0]) . "</td>";
			echo "<td>" . htmlspecialchars($data[1]) . "</td>";
			echo "<td>" . htmlspecialchars($data[2]) . "</td>";
			echo "<td>" . htmlspecialchars($data[5]) . "</td>";
			echo "</tr>";
		}
?>
		</table>
		<hr>
<?php
		echo date("Y-m-d h:i:s A");
	}
	if ($page == '999') {
	$username = $_SESSION['username'];
?>
		<h3>Welcome, <?php echo htmlspecialchars($username); ?>! (<a href="final_logout.php">Log Out</a>)</h3>
		<?php $_SERVER['REQUEST_METHOD'] == 'POST'; ?>
		<a href="final.php"><- Back to Dashboard</a>
		<h4>Invalid Page</h4>
		<hr>
<?php
		echo date("Y-m-d h:i:s A");
	}
}
else {
?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method ="POST">
			<label for="username">Username: </label>
			<input name="username" id="username" type="text" /><br>
			<label for="password">Password: </label>
		 	<input name="password" id="password" type="password" /><br>
			<input value="Login" type="submit">
		<br>
		<hr>
<?php
echo date("Y-m-d h:i:s A");
}
?>
	</body>
</html>
