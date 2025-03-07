<!DOCTYPE html>
<?php
	include "head.php";
	include "navbar.php";
?>
<body>
<br>
<center>
<h1>Investment Planning</h1>
<br>
<table border=0>
<?php

include 'connect_financial.php';

$fv = $_POST['fv'];
$no_of_periods = $_POST['no_of_periods'];
$interest_rate = $_POST['interest_rate'];

$display_fv = number_format($fv, 2, '.', ',');
$display_interest_rate = number_format(($interest_rate * 100), 1, '.');

echo "<tr><td>Investment Goal:</td><td>$" . $display_fv . "</td></tr>";
echo "<tr><td>Number of Years:</td><td>" . $no_of_periods . "</td></tr>";
echo "<tr><td>Interest Rate:</td><td>" . $display_interest_rate . "%</td></tr>";

$query = "SELECT pv_factor FROM pv WHERE no_of_periods = '" . $no_of_periods . "' AND interest_rate = '" . $display_interest_rate . "' LIMIT 1";

//echo "<tr><td colspan=2>" . $query . "</td></tr>";

$result = mysqli_query($dbserver, $query);
if(!$result) die ("Unable to connect to Database: " . mysqli_connect_error());

$row = mysqli_fetch_row($result);

//echo "<tr><td>PV Factor:</td><td>" . $row[0] . "</td></tr>";

$pv = number_format(($fv * $row[0]), 2);

echo "<tr><td>You would need to pay this amount today:</td><td>$" . $pv . "</td></tr>";
echo "<tr><td colspan=2>*This assumes no other payments were made.</td></tr>";

mysqi_close($dbserver);

?>
	<tr>
		<td>*This assumes no other payments were made.</td>
	</tr>
</table>
</center>
</body>
</html>
