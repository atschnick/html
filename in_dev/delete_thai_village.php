<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $invoiceitem = $_POST['invoiceitem'];

        $query = "DELETE FROM cart WHERE invoiceitem = '$invoiceitem'";

        $results = mysqli_query($dbserver, $query);
        if(!$results) die ("Unable to Connect to Server Query: " . mysqli_error($dbserver));

        //echo $query;

        mysqli_close($dbserver);

        header("Location: cart.php");
?>
