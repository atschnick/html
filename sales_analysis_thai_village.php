<html>
<link rel="stylesheet" href="css_files/construction.css">
<body>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $totalsold2017 = 87;
        $totalsold2018 = 88;

        //echo "Hello.  At least some of my code is working.";

        $query = "SELECT sku, sold2017, sold2018 FROM thaivillagecodes ORDER BY sku ASC";

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Unable to Connect to Database: " . mysqli_error($dbserver));

        $rows = mysqli_num_rows($result);

        for($x = 0; $x < $rows; $x++)
        {
                $row = mysqli_fetch_row($result);

                for($y = 0; $y < 3; $y++)
                {

                        if($y == 1) //Sold 2017
                        {
                                $percent2017 = ($row[$y] / $totalsold2017) * 100;
                                $percent2017 = round($percent2017, 0, PHP_ROUND_HALF_UP);

                                $query2 = "UPDATE thaivillagecodes SET percent2017 = '$percent2017' WHERE sku = '$row[0]'";

                                $result2 = mysqli_query($dbserver, $query2);
                                if(!$result2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));
                        }


                        if($y == 2) //Sold 2018
                        {
                                $percent2018 = ($row[$y] / $totalsold2018) * 100;
                                $percent2018 = round($percent2018, 0, PHP_ROUND_HALF_UP);

                                $query3 = "UPDATE thaivillagecodes SET percent2018 = '$percent2018' WHERE sku = '$row[0]'";

                                $result3 = mysqli_query($dbserver, $query3);
                                if(!$result3) die ("Unable to Connect to Database Query 3: " . mysqli_error($dbserver));
                        }

                        if($row[1] > $row[2])
                        {
                                if($row[2] == 0)
                                {
                                        $change = $row[1] * 100;
                                }
                                else
                                {
                                        $change = $row[1] - $row[2];
                                        $denom = $row[1] + $row[2];
                                        $change = ($change / $denom) * 100;
                                        $change = round($change, 0, PHP_ROUND_HALF_UP);
                                }

                                $query4 = "UPDATE thaivillagecodes SET perchange = 'Down $change' WHERE sku = '$row[0]'";

                                $result4 = mysqli_query($dbserver, $query4);
                                if(!$result4) die ("Unable to Connect to Database Query 4: " . mysqli_error($dbserver));
                        }


                        if($row[1] < $row[2])
                        {
                                if($row[1] == 0)
                                {
                                        $change = $row[2] * 100;
                                }
                                else
                                {
                                        $change = $row[2] - $row[1];
                                        $denom = $row[1] + $row[2];
                                        $change = ($change / $denom) * 100;
                                        $change = round($change, 0, PHP_ROUND_HALF_UP);
                                }

                                $query5 = "UPDATE thaivillagecodes SET perchange = 'Up $change' WHERE sku = '$row[0]'";

                                $result5 = mysqli_query($dbserver, $query5);
                                if(!$result5) die ("Unable to Connect to Database Query 5: " . mysqli_error($dbserver));
                        }

                        if($row[1] == $row[2])
                        {
                                $query6 = "UPDATE thaivillagecodes SET perchange = 'No Change' WHERE sku = '$row[0]'";

                                $result6 = mysqli_query($dbserver, $query6);
                                if(!$result6) die ("Unable to Connect to Database Query 6: " . mysqli_error($dbserver));
                        }
                }
        }

        //echo "Queries 1 - 6 Successful!";

        //Query 7 Function: Display the results.

        $query7 = "SELECT * FROM thaivillagecodes ORDER BY sku ASC";

        $result7 = mysqli_query($dbserver, $query7);
        if(!$result7) die ("Unable to Connect to Database Query 7: " . mysqli_error($dbserver));

        $rows7 = mysqli_num_rows($result7);

        echo "<table border=1><tr><th>Category</th><th>SKU</th><th>Item</th><th>Sold 2017</th>
        <th>Sold 2018</th><th>Percentage of Sales 2017</th><th>Percentage of Sales 2018</th>
        <th>Percentage Change from 2017</th></tr>";

        for($f = 0; $f < $rows7; $f++)
        {
                $row7 = mysqli_fetch_row($result7);

                echo "<tr>";

                for($n = 0; $n < 8; $n++)
                {
                        if($n == 7 && $row7[$n] != 'No Change')
                        {
                                echo "<td>" . $row7[$n] . "%</td>";
                        }
                        else
                        {
                                echo "<td>" . $row7[$n] . "</td>";
                        }
                }

                echo "</tr>";
        }

        echo "</table>";

        mysqli_close($dbserver);
?>
</body>
</html>

