<html>
<link rel="stylesheet" href="css_files/construction.css">
<body>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

	if($dbserver)
	{
		echo "<table border=0><tr><td>Connected to Server</td></tr></table>";
	}

        $query = "SELECT sku FROM thaivillagecodes";

	//echo $query;

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Query was unsuccessful " . mysqli_connect_error());

	if($result)
	{
		echo "<br><table border=0><tr><td>Query Successful</td></tr></table>";
	}

        $rows = mysqli_num_rows($result);

        echo "<br><table border=0>";

	echo "<tr><td>There are " . $rows . " rows.</td></tr>";

	echo "<form method=post action=unitprice_update.php>";

        for($q = 0; $q < $rows; ++$q)
        {
		$row = mysqli_fetch_row($result);

                echo "<tr><td>" . $row[0] . "<input type=hidden name=" . $row[0] . " ";

		$unitprice_query = "SELECT unitprice FROM allsales WHERE sku = '" . $row[0] ."'";

		$unitprice_result = mysqli_query($dbserver, $unitprice_query);
		if(!$unitprice_result) die ("<td>Unit Price Query Unsuccessful " . mysqli_connect_error() . "</td></tr>");

		$unitprice_rows = mysqli_num_rows($unitprice_result);

		if($unitprice_rows == 1)
		{
			$unitprice_row = mysqli_fetch_row($unitprice_result);

			if($unitprice_row[0] != 0.00)
			{
				echo "value=" . $unitprice_row[0] . "> $" . $unitprice_row[0] . "</td></tr>";
			}
			else
			{
				echo "value= ></td></tr>";
			}
		}
		else
		{
			echo "value= ></td></tr>";
		}
        }

        echo "</table>";

        mysqli_close($dbserver);
?>
</body>
</html>
