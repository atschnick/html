<html>
<link rel="stylesheet" href="css_files/construction.css">
<body>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $query = "SELECT * FROM allsales ORDER BY invoice DESC";

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Unable to connect to Database: " . mysqli_connect_error());

        $rows = mysqli_num_rows($result);

        //echo $rows;

        echo "<table border=1><tr><th>Date</th><th>Invoice</th><th>Invoice Item</th><th>Customer</th><th>SKU</th><th>Item</th><th>Quantity</th><th>Unit Price</th>
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

        echo "</table>";

        mysqli_close($dbserver);
?>
</body>
</html>
