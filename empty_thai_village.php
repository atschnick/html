<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        $query1 = "TRUNCATE TABLE cart";

        $results1 = mysqli_query($dbserver, $query1);
        if(!$results1) die ("Unable to Connect to Database Query 1: " . mysqli_error($dbserver));

        mysqli_close($dbserver);

        header("Location: cart.php");
?>
