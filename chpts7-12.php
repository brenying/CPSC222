<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP Chapters 7 & 12</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
	</head>
	<body>
		<h1>Birthday Formatter</h1>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<?php
if($_SERVER['REQUEST_METHOD'] != "POST" && !isset($_GET['action'])) {
?>
			<table border=1>
				<tr>
					<th>Month</th>
					<th>Day</th>
					<th>Year</th>
					<th>Hour</th>
					<th>Minute</th>
					<th>AM/PM</th>
				</tr>
				<tr>
					<td> 
						<select name ="month">
<?php
for($x = 1; $x<=12; $x++) {
	$month_word = date('F', mktime(0,0,0, $x, 1));
	echo "<option value=\"" . $x . "\">" . $month_word . "</option>\n"; 
}
?>
						</select>			
					</td>
					<td>
						<select name="day">
<?php
for($y=1; $y<=31; $y++) {
	echo "<option value=\"" . $y . "\">" . $y . "</option>\n";
}
?>
						</select>
					</td>
					<td>
						<select name="year">
<?php
for($z=1900; $z<=date('Y'); $z++) {
	echo "<option value=\"" . $z . "\">" . $z . "</option>\n";
}
?>
						</select>
					</td>
					<td>
						<select name="hour">
<?php 
for($a=1; $a<=12; $a++) {
	echo "<option value\"" . $a . "\">" . $a . "</option>\n";
}
?>
						</select>
					</td>
					<td>
						<select name="minute">
<?php
for($b=0; $b<=59; $b++) {
	echo "<option value=\"" . $b . "\">" . $b . "</option>\n";
}
?>
						</select>
					</td>
					<td>
						<select name="AM/PM">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="Format Date" />
					</td>
				</tr>
			</table>
<?php
}
elseif(isset($_GET['action']) && $_GET['action'] == 'iso') {
	$timestamp = preg_replace("/\D/", "", $_GET['timestamp']);
	echo "<p>" . date("Y-m-d H:i:s", $timestamp) . "<p>";

	echo "</body></html>";
	exit();
}
else {

	$month = preg_replace("/\D/", "", $_POST['month']);
	$day =  preg_replace("/\D/", "", $_POST['day']);
	$year =  preg_replace("/\D/", "", $_POST['year']);
	$hour =  preg_replace("/\D/", "", $_POST['hour']);
	$minute =  preg_replace("/\D/", "", $_POST['minute']);
	$ampm = preg_replace("/[^a-zA-Z]/", "", $_POST['AM/PM'] ?? '');

	$militarytime = (int)$hour;
	if($ampm == "PM" && $militarytime < 12) {
		$militarytime += 12;
	}
	elseif ($ampm == "AM" && $hour == 12) {
		$militarytime = 0;
	}
	$time = mktime($militarytime, (int)$minute, 0, (int)$month, (int)$day, (int)$year);
	echo "<p>" . date("l F jS, Y - g:ia", $time) . "<p>";

	$link = htmlspecialchars($_SERVER['PHP_SELF']) . "?action=iso&timestamp=" . $time;
	echo "<a href='$link'>Show date in ISO format</a>";	
}
?>
		</form>

	</body>
</html>
