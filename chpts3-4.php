<?php

// Variables
$EmployeeName = "Brennen Yingling";
$HoursWorked = 40;
$PayRate = 54.50;
$FedTaxRate = 0.245;
$StateTaxRate = 0.055;
$TaxBracket = "24%";

// Calculations
$GrossPay = $HoursWorked * $PayRate;
$FedWitholdingTax = $GrossPay * $FedTaxRate;
$StateWitholdingTax = $GrossPay * $StateTaxRate;
$TotalDeductions = $FedWitholdingTax + $StateWitholdingTax;
$NetPay = $GrossPay - $TotalDeductions

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Chapters 3-4</title>
	<meta charset="utf-8" content="width=device-width, initial-scale=1" />
</head>
<body>
	<h1>Payroll Info for <?php echo $EmployeeName; ?></h1>

	<table border=1>
		<tr>
			<th>Description</th>
			<th>Value</th>
		</tr>
		<tr>
			<td>Hours Worked</td>
			<td><?php echo number_format($HoursWorked, 1); ?></td>
		<tr>
			<td>Hourly Pay Rate</td>
			<td><?php echo number_format($PayRate, 2); ?></td>
		</tr>
		<tr>
			<td>Gross Pay</td>
			<td><?php echo number_format($GrossPay, 2); ?></td>
		</tr>
		<tr>
			<td>Federal Witholding (<?php echo ($FedTaxRate * 100); ?>%)</td>
			<td>$<?php echo number_format($FedWitholdingTax, 2); ?></td>
		</tr>
		<tr>
			<td>State Witholding (<?php echo ($StateTaxRate * 100); ?>%)</td>
			<td>$<?php echo number_format($StateWitholdingTax, 2); ?></td>
		</tr>
		<tr>
			<td>Tax Bracket</td>
			<td><?php echo $TaxBracket; ?> Federal Tax Bracket</td>
		</tr>
		<tr>
			<td>Total Deductions</td>
			<td><?php echo number_format($TotalDeductions, 2); ?></td>
		</tr>
		<tr>
			<td>Net Pay</td>
			<td><?php echo number_format($NetPay, 2); ?></td>
		</tr>
	</table>
</body>
