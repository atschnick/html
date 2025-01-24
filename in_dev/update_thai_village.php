<?php
        require_once 'login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $invoiceitem = $_POST['invoiceitem'];
        $quantity = $_POST['quantity'];
        $unitprice = $_POST['unitprice'];
        $unittotal = $quantity * $unitprice;
        $paymentmethod = $_POST['paymentmethod'];

        $query = "UPDATE cart SET quantity = '$quantity', unitprice='$unitprice',
        unittotal = '$unittotal', paymentmethod = '$paymentmethod' WHERE invoiceitem = '$invoiceitem'";

        //echo $query;

        $results = mysqli_query($dbserver, $query);
        if(!$results) die ("Unable to Connect to Database Query: " . mysqli_error($dbserver));

        mysqli_close($dbserver);

        header("Location: cart.php");
?>
