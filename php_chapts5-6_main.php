<?php
require_once('php_chapts5-6_student.php');
require_once('php_chapts5-6_lettegrades.php');

// create the 3 students
$students = [
	new student(1001, "Kevin", "Slonka", [
		"CPSC222" => 98,
		"CPSC111" => 76,
		"CPSC333" => 82
	]),

	new student(1005, "Joe", "Schmoe", [
		"CPSC122" => 88,
		"CPSC411" => 46,
		"CPSC323" => 72
	]),

	new student(1009, "Stewie", "Griffin", [
		"CPSC244" => 68,
		"CPSC116" => 96,
		"CPSC345" => 82
	])
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content"=width=device-width" />
</head>
<body>
	<h1>Chapters 5 & 6</h1>
</body>
<?php 
	// students for loop
	$studentscount = count($students);
	for ($i = 0; $i < $studentscount; $i++) {
		$s = $students[$i];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content"=width=device-width" />
	<title>PHP Chapters 5-6</title>
</head>

<body>
	<table border=1>
		<tr>
			<th>Name</th>
			<td><?php echo $s->getLname() . ", " . $s->getFname(); ?></td>
		</tr>
		<tr>
			<th>Student ID</th>
			<td><?php echo $s->getID(); ?></td>
		</tr>
		<tr>
			<th>Grades</th>
			<td>
				<ul><?php foreach ($s->getGrade() as $courseName => $score) {
					$letter = calculatelettergrade($score);
					echo "<li> $courseName - $score% $letter</li>";
				}
				?>
				</ul>
			</td>
		</tr>
	</table>
<br>
	<?php
}
?>
