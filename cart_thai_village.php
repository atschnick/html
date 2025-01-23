<html>
<link rel="stylesheet" href="css_files/construction.css">
<body class=parallax>
<br><br>
<a href=item_search.php><-- Back to Item Search</a>
<br><br>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        //Query 0.25 Function: Make sure the cart isn't empty before querying functions on customer name.

        $query_0_25 = "SELECT * FROM cart";

        $result_0_25 = mysqli_query($dbserver, $query_0_25);
        if(!$result_0_25) die ("Unable to Connect to Database Query 0.25: " . mysqli_error($dbserver));

        $rows_0_25 = mysqli_num_rows($result_0_25);

        if($rows_0_25 > 0)
        {
                //Query 0.5 Function: Get date & customer name from a row.

                $query_0_5 = "SELECT timestamp, customer FROM cart WHERE invoiceitem = (SELECT MIN(invoiceitem) FROM cart)";

                $result_0_5 = mysqli_query($dbserver, $query_0_5);
                if(!$result_0_5) die ("Unable to Connect to Database Query 0.5: " . mysqli_error($dbserver));

                $row_0_5 = mysqli_fetch_row($result_0_5);

                $timestampfromquery = $row_0_5[0];

                $customername = $row_0_5[1];

                //echo $customername;

                //Query 0.75 Function: Apply date & customer name to all rows.

                $query_0_75 = "UPDATE cart SET timestamp = '$timestampfromquery', customer = '$customername'";

                //echo $query_0_75;
                $result_0_75 = mysqli_query($dbserver, $query_0_75);
                if(!$result_0_75) die ("Unable to Connect to Database Query 0.75: " . mysqli_error($dbserver));
        }

        //Query 1 Function: Display all contents of database table.

        $query1 = "SELECT * FROM cart";

        $result1 = mysqli_query($dbserver, $query1);
        if(!$result1) die ("Unable to Connect to Database Query 1: " . mysqli_error($dbserver));

        $rows1 = mysqli_num_rows($result1);

        if($rows1 == 0)
        {
                echo "<br><br><center><h1>You have nothing in your cart.</h1></center>";

                $query_1_5 = "ALTER TABLE cart AUTO_INCREMENT = 1";

                $results_1_5 = mysqli_query($dbserver, $query_1_5);
                if(!$results_1_5) die ("Unable to Connect to Database Query 1.5: " . mysqli_error($dbserver));

        }
        else
        {
                echo "<table border=0><tr><th>Date & Time</th><th>Invoice Item</th><th>Customer</th><th>SKU</th>";
                echo "<th>Item</th><th>Quantity</th><th>Unit Price</th><th>Unit Total</th><th>Payment Method</th><th>Update</th></tr>";

                $invoicetotal = 0;

                for($x = 0; $x < $rows1; $x++)
                {
                        $row1 = mysqli_fetch_row($result1);

                        echo "<tr>";

                        echo "<td>" . $row1[0] . "</td>";
                        echo "<td><form method=post action=delete.php>" . $row1[1] . "<input type=hidden name=invoiceitem value=" . $row1[1] . "><input type=submit value=Delete></form></td>"; //invoiceitem
                        echo "<td>" . $row1[2] . "</td>"; //customer
                        echo "<td>" . $row1[3] . "</td>"; //sku
                        echo "<td>" . $row1[4] . "</td>"; //item

                        echo "<td><form method=post action=update.php><input type=text value=" . $row1[5] . " name=quantity size=2></td>";
                        echo "<td><input type=text value=" . $row1[6] . " name=unitprice size=8></td>";
                        echo "<td>" . $row1[7] . "</td>";

                        $invoicetotal = $invoicetotal + $row1[7];
                        echo "<td><input type=text value=" . $row1[9] . " name=paymentmethod size=7></td>";

                        echo "<td><input type=hidden name=invoiceitem value=" . $row1[1] . "><input type=submit name=submit value=Update></form></td>";
                        //echo "<td><form method=post action=delete.php><input type=hidden value=" . $row1[1] . "><input type=submit name=submit value=Delete></form></td>";

                        echo "</tr>";
                }

                $invoicetotal = number_format($invoicetotal, 2);

                //Query 2 Function: Update invoice total for all rows.

                $query2 = "UPDATE cart SET invoicetotal = '$invoicetotal'";

                $results2 = mysqli_query($dbserver, $query2);
                if(!$results2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));

                //Query 3 Function: Get the invoice total from the database table.

                $query3 = "SELECT invoicetotal FROM cart";

                $results3 = mysqli_query($dbserver, $query3);
                if(!$results3) die ("Unable to Connect to Database Query 3: " . mysqli_error($dbserver));

                $rows3 = mysqli_num_rows($results3);

                for($s = 0; $s < 1; $s++)
                {
                        $row3 = mysqli_fetch_row($results3);

                        $it = $row3[0];
                }

                echo "<tr><td colspan=7>Invoice Total:</td><td>" . $it . "</td><td colspan=2></td></tr>";

                echo "<tr><td colspan=9></td><td><form method=post action=empty.php><input type=submit name=submit value=Empty></form></td></tr>";

                //echo "<tr><td colspan=9></td><td><form method=post action=complete_order.php><input type=submit value='Submit Order'></form></td></tr>";

                echo "</table>";
        }

        mysqli_close($dbserver);
?>
</body>
</html>

