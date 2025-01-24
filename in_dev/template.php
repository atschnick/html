<!DOCTYPE html>
<?php include 'head.php'; ?>
<body class=parallax>
<?php
        require_once 'private/login_auth_thai_village.php';

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

	mysqli_close($dbserver);
?>
</body>
</html>
