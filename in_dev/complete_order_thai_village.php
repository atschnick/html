<?php
        require_once 'login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        //Query 1 Function: Get date from cart

        $query1 = "SELECT date FROM cart WHERE invoiceitem = (SELECT MIN(invoiceitem) FROM cart)";

        $results1 = mysqli_query($dbserver, $query1);
        if(!$results1) die ("Unable to Connect to Database Query 1: " . mysqli_error($dbserver));

        $row1 = mysqli_fetch_row($results1);
        $date = $row1[0];

        //echo $query;

        //Query 2 Function: Insert date into invoice table

        $query2 = "INSERT INTO invoices SET date = '$date'";

        $results2 = mysqli_query($dbserver, $query2);
        if(!$results2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));

        //Query 3 Function: Get last invoice number

        $query3 = "SELECT MAX(invoice) FROM invoices";

        $results3 = mysqli_query($dbserver, $query3);
        if(!$results3) die ("Unable to Connect to Database Query 3: " . mysqli_error($dbserver));

        $row3 = mysqli_fetch_row($results3);
        $invoice = $row3[0];

        //echo $row3[0]; //Works!

        //Query 4 Function: Get contents of cart

        $query4 = "SELECT * FROM cart";

        $results4 = mysqli_query($dbserver, $query4);
        if(!$results4) die ("Unable to Connect to Database Query 4: " . mysqli_error($dbserver));

        $rows4 = mysqli_num_rows($results4);

        for($z = 0; $z < $rows4; $z++)
        {
                $row4 = mysqli_fetch_row($results4);

                for($q = 0; $q < 10; $q++)
                {
                        $values[$q] = $row4[$q];
                }

                $row_query = "INSERT INTO sales2019 SET date = '$values[0]', invoice = '$invoice',
                invoiceitem = '$values[1]', customer = '$values[2]', sku = '$values[3]', item = '$values[4]',
                quantity = '$values[5]', unitprice = '$values[6]', unittotal = '$values[7]',
                invoicetotal = '$values[8]', paymentmethod = '$values[9]'";

                $row_results = mysqli_query($dbserver, $row_query);
                if(!$row_results) die ("Unable to Connect to Database Row Query: " . mysqli_error($dbserver));
        }

        mysqli_close($dbserver);

        header("Location: empty.php");
?>

