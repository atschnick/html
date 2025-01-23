<!DOCTYPE html>
<?php include 'head.php'; ?>
<body class=parallax>
<center><table>
	<tr>
		<td colspan=11><h1>Thai Village Sales Record Project (All Sales)</h1></td>
	</tr>
	<tr>
		<td colspan=11>During the Christmas season of 2017 & 2018, 
		<a href=https://www.wlchapel.org target=window>Wisconsin
		Lutheran Chapel</a> sold crafts for <a href=https://thaivillage.org target=window>
		Thai Village</a>. As a fun project, I made database tables based
		on the records of sales and some analysis using PHP & MySQL. Note: In 2018, we didn't keep track of customer names.</td>
	</tr>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $query = "SELECT * FROM allsales ORDER BY invoice ASC, date ASC";

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Unable to connect to Database: " . mysqli_connect_error());

        $rows = mysqli_num_rows($result);

        //echo $rows;

        echo "<tr><th>Date</th><th>Invoice</th><th>Invoice Item</th><th>Customer</th><th>SKU</th><th>Item</th><th>Quantity</th><th>Unit Price</th>
        <th>Unit Total</th><th>Invoice Total</th><th>Payment Method</th></tr>";

        for($q = 0; $q < $rows; ++$q)
        {
                echo "<tr>";

                $row = mysqli_fetch_row($result);

                for($w = 0; $w < 11; ++$w)
                {

                        echo "<td>";

                        echo $row[$w];

                        echo "</td>";
                }

                echo "</tr>";
        }

        echo "</table></center>";

        mysqli_close($dbserver);
?>
</body>
</html>
