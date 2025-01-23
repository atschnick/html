<html>
<link rel="stylesheet" href="css_files/construction.css">
<body>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        //Query 1 Function: Get SKUs from Inventory List.

        $query1 = "SELECT sku FROM thaivillagecodes ORDER BY sku ASC";

        $result1 = mysqli_query($dbserver, $query1);
        if(!$result1) die ("Unable to Connect to Database Query 1: " . mysqli_error($dbserver));

        $rows1 = mysqli_num_rows($result1);

        for($x = 0; $x < $rows1; $x++)
        {
                $row1 = mysqli_fetch_row($result1);
                $skus[] = $row1[0];
        }

        //Query 2 Function: Get SKUs from 2017 Sales Data.

        $query2 = "SELECT sku FROM allsales WHERE date >= '2017-01-01' AND date <= '2018-01-03' ORDER BY sku ASC";

        $result2 = mysqli_query($dbserver, $query2);
        if(!$result2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));

        $rows2 = mysqli_num_rows($result2);

        for($q = 0; $q < $rows2; $q++)
        {
                $row2 = mysqli_fetch_row($result2);
                $skusales2017[] = $row2[0];
        }

        //Query 3 Function: Get SKUs from 2018 Sales Data.

        $query3 = "SELECT sku FROM allsales WHERE date >= '2018-01-04' ORDER BY sku ASC";

        $result3 = mysqli_query($dbserver, $query3);
        if(!$result3) die ("Unable to Connect to Database Query 3: " . mysqli_error($dbserver));

        $rows3 = mysqli_num_rows($result3);

        for($w = 0; $w < $rows3; $w++)
        {
                $row3 = mysqli_fetch_row($result3);
                $skusales2018[] = $row3[0];
        }

        echo "<table border=1><tr><th>SKU from Inventory List</th><th>Number Sold in 2017</th>
        <th>Number Sold in 2018</th></tr>";

        $totalsold2017 = 0;
        $totalsold2018 = 0;

        for($cnt = 0; $cnt < $rows1; $cnt++)
        {
                echo "<tr><td>" . $skus[$cnt] . "</td>";

                $times2017 = 0;

                for($cnt2 = 0; $cnt2 < $rows2; $cnt2++)
                {
                        if($skusales2017[$cnt2] == $skus[$cnt])
                        {
                                $times2017++;
                        }
                }

                if($times2017 > 0)
                {
                        echo "<td>" . $times2017 . "</td>";

                        //Query 4 Function: Put quantity sold in inventory table.

                        $query4 = "UPDATE thaivillagecodes SET sold2017 = '$times2017' WHERE sku = '$skus[$cnt]'";

                        $result4 = mysqli_query($dbserver, $query4);
                        if(!$result4) die ("Unable to Connect to Database Query 4: " . mysqli_error($dbserver));

                        $sold2017[] = $times2017;
                        $totalsold2017 = $totalsold2017 + $times2017;
                }
                else
                {
                        echo "<td></td>";
                }

                $times2018 = 0;

                for($cnt3 = 0; $cnt3 < $rows3; $cnt3++)
                {
                        if($skusales2018[$cnt3] == $skus[$cnt])
                        {
                                $times2018 = $times2018 + 1;
                        }
                }

                if($times2018 > 0)
                {
                        echo "<td>" . $times2018 . "</td>";

                        //Query 5 Function: Put quantity into inventory table.

                        $query5 = "UPDATE thaivillagecodes SET sold2018 = '$times2018' WHERE sku = '$skus[$cnt]'";

                        $result5 = mysqli_query($dbserver, $query5);
                        if(!$result5) die ("Unable to Connect to Database Query 5: " . mysqli_error($dbserver));

                        $sold2018[] = $times2018;

                        $totalsold2018 = $totalsold2018 + $times2018;
                }
                else
                {
                        echo "<td></td>";
                }

                echo "</tr>";
        }

        echo "<tr><td></td><td>" . $totalsold2017 . "</td><td>" . $totalsold2018 . "</td></tr>";

        echo "</table>";

        mysqli_close($dbserver);
?>
</body>
</html>
