<html>
<link rel="stylesheet" href="css_files/construction.css">
<body>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $totalsold2017 = 87;
        $totalsold2018 = 88;

        $query = "SELECT * FROM thaivillagecodes ORDER BY sku ASC";

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Unable to Connect to Database: " . mysqli_error($dbserver));

        $rows = mysqli_num_rows($result);

        echo "<table border=1><tr><th>Category</th><th>SKU</th><th>Item</th><th>Sold 2017</th>
        <th>Sold 2018</th><th>Percent 2017</th><th>Percent 2018</th><th>Change from 2017</th></tr>";

        for($x = 0; $x < $rows; $x++)
        {
                $row = mysqli_fetch_row($result);

                echo "<tr>";

                for($y = 0; $y < 8; $y++)
                {
                        if($y < 3) //Category, SKU & Item
                        {
                                echo "<td>" . $row[$y] . "</td>";
                        }

                        if($y == 3) //Sold 2017
                        {
                                echo "<td>" . $row[$y] . "</td>";

                                $percent2017 = ($row[$y] / $totalsold2017) * 100;
                                $percent2017 = round($percent2017, 0, PHP_ROUND_HALF_UP);

                                $query2 = "UPDATE thaivillagecodes SET percent2017 = '$percent2017' WHERE sku = '$row[1]'";


                                $result2 = mysqli_query($dbserver, $query2);
                                if(!$result2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));
                        }

                        if($y == 4) //Sold 2018
                        {
                                echo "<td>" . $row[$y] . "</td>";

                                $percent2018 = ($row[$y] / $totalsold2018) * 100;
                                $percent2018 = round($percent2018, 0, PHP_ROUND_HALF_UP);

                                $query3 = "UPDATE thaivillagecodes SET percent2018 = '$percent2018' WHERE sku = '$row[1]'";

                                $result3 = mysqli_query($dbserver, $query3);
                                if(!$result3) die ("Unable to Connect to Database Query 3: " . mysqli_error($dbserver));
                        }

                        if($y == 5 || $y == 6) //Percent 2017 & Percent 2018
                        {
                                echo "<td>" . $row[$y] . "%</td>";
                        }

                        if($y == 7) //Change
                        {
                                if($row[7] == 'No Change')
                                {
                                        echo "<td>" . $row[$y] . "</td>";
                                }
                                else
                                {
                                        echo "<td>" . $row[$y] . "%</td>";
                                }

                                if($row[3] > $row[4])
                                {
                                        if($row[4] == 0)
                                        {
                                                $change = $row[3] * 100;
                                        }
                                        else
                                        {
                                                $change = $row[3] - $row[4];

                                                $denom = $row[4] + $row[3];
                                                $change = ($change / $denom) * 100;
                                                $change = round($change, 0, PHP_ROUND_HALF_UP);
                                        }

                                        $query4 = "UPDATE thaivillagecodes SET perchange = 'Down $change' WHERE sku = '$row[1]'";

                                        $result4 = mysqli_query($dbserver, $query4);
                                        if(!$result4) die ("Unable to Connect to Database Query 4: " . mysqli_error($dbserver));
                                }

                                if($row[3] < $row[4])
                                {
                                        if($row[3] == 0)
                                        {
                                                $change = $row[4] * 100;
                                        }
                                        else
                                        {
                                                $change = $row[4] - $row[4];
                                                $denom = $row[3] + $row[4];
                                                $change = ($change / $denom) * 100;
                                                $change = round($change, 0, PHP_ROUND_HALF_UP);
                                        }

                                        $query5 = "UPDATE thaivillagecodes SET perchange = 'Up $change' WHERE sku = '$row[1]'";

                                        $result5 = mysqli_query($dbserver, $query5);
                                        if(!$result5) die ("Unable to Connect to Database Query 5: " . mysqli_error($dbserver));
                                }

                                if($row[3] == $row[4])
                                {
                                        $query6 = "UPDATE thaivillagecodes SET perchange = 'No Change' WHERE sku = '$row[1]'";

                                        $result6 = mysqli_query($dbserver, $query6);
                                        if(!$result6) die ("Unable to Connect to Database Query 6: " . mysqli_error($dbserver));
                                }
                        }


                }

                echo "</tr>";

        }

        echo "</table>";

        mysqli_close($dbserver);
?>
</body>
</html>

