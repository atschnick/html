<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        //$date = $_POST['date'];
        $customer = $_POST['customer'];
        $sku = $_POST['sku'];
        $item = $_POST['item'];
        $unitprice = $_POST['unitprice'];
        $quantity = $_POST['quantity'];
        $unittotal = $unitprice * $quantity;
        $invoicetotal = 0.00; //Will update this below
        $paymentmethod = $_POST['paymentmethod'];

        $query = "INSERT INTO cart SET customer = '$customer', sku = '$sku',
        item = '$item', unitprice = '$unitprice', quantity = '$quantity',
        unittotal = '$unittotal', invoicetotal = '$invoicetotal', paymentmethod = '$paymentmethod'";

        //echo $query;

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Unable to Connect to Database: " . mysqli_error($dbserver));

        $query2 = "SELECT item FROM thaivillagecodes WHERE sku = '$sku'";

        $result2 = mysqli_query($dbserver, $query2);
        if(!$result2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));

        $row2 = mysqli_fetch_row($result2);
        $corrected_item = $row2[0];

        $query3 = "UPDATE cart SET item = '$corrected_item' WHERE sku = '$sku'";

        $result3 = mysqli_query($dbserver, $query3);
        if(!$result3) die ("Unable to Connect to Database Query 3: " . mysqli_error($dbserver));

        mysqli_close($dbserver);

        header("Location: cart.php");
?>
