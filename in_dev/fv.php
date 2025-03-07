<!DOCTYPE html>
<body>
<h1>Future Value of $1.00 Factor Table</h1>
<table border=1>
<tr>
	<td>No of Periods</td>
	<td>Interest Rate</td>
	<td>FV Factor</td>
	<td>Query</td>
	<td>Successful?</td>
</tr>
<?php

//include 'connect_financial.php';

$no_of_periods = 1;
$interest_rate = 0.010;

for($counter = 0; $counter < 50; $counter++)
{
	for($second_counter = 0; $second_counter < 41; $second_counter++)
	{
		echo "<tr>";

		echo "<td>" . $no_of_periods . "</td>";

		$display_interest_rate = $interest_rate * 100;

		echo "<td>" . $display_interest_rate . "%</td>";

		$interest_rate_plus_one = $interest_rate + 1;

		$interest_rate_plus_one_to_the_power_of_no_of_periods = pow($interest_rate_plus_one, $no_of_periods);

		$fv_factor = number_format($interest_rate_plus_one_to_the_power_of_no_of_periods, 25);

		echo "<td>" . $fv_factor . "</td>";

		$query = "INSERT INTO fv (no_of_periods, interest_rate, fv_factor) VALUES ($no_of_periods, $display_interest_rate, $fv_factor)";

		echo "<td>" . $query . "</td>";

		/*$result = mysqli_query($dbserver, $query);
		if(!$result) die("Query unsuccessful: " . mysqli_connect_error());

		if($result)
		{
			echo "<td>Successful</td>";
		}
		else
		{
			echo "<td>Unsuccessful</td>";
		}*/

		echo "</tr>";

		$interest_rate = $interest_rate + 0.005;
	}

	$interest_rate = 0;

	$no_of_periods++;
}

//mysqi_close($dbserver);

?>
</table>
</body>
</html>
