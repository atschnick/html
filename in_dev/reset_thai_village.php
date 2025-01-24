<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

        //$query1 = "TRUNCATE TABLE sales2019";

        //$results1 = mysqli_query($dbserver, $query1);
        //if(!$results1) die ("Unable to Connect to Database Query 1: " . mysqli_error($dbserver));

        $query2 = "ALTER TABLE invoices AUTO_INCREMENT = 83";

        $results2 = mysqli_query($dbserver, $query2);
        if(!$results2) die ("Unable to Connect to Database Query 2: " . mysqli_error($dbserver));

        mysqli_close($dbserver);

        header("Location: item_search.php");
?>
