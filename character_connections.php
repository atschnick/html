<html>
<?php include "head.php"; ?>
<body class=parallax>
<form method=post action=>
<center><table>
	<tr>
		<td colspan=5><center><h1>ANDy's Human Networking Example Project</h1></center></td>
	</tr>
	<tr>
		<td colspan=5><p>Instead of putting a database table of actual people who may or may not get upset
		with me for publishing their name and where they work, I have decided to create a database
		table of fictional characters from television and movies.  The way this was supposed to
		work is first seeing a job ad, then searching the company name on the job ad to see if
		anyone I know knows someone who works in that company.</p></td>
	</tr>
	<tr>
        	<td>Company: <input type=text name=company></td>
		<td><input type=submit value=Search> <input type=submit name=submit value=Reset></td>
	</tr>
<?php
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
                $query = "SELECT * FROM character_connections";
        }
        else
        {
                if(isset($_POST['submit']) == 'Reset')
                {
                        $query = "SELECT * FROM character_connections";
                }

                if($_POST['company'])
                {
                        $company_search_text = $_POST['company'];
                        $query = $query. "SELECT * FROM character_connections WHERE ";
                        $company_search_words = explode(" ", $company_search_text);

                        $company_space_count = substr_count($company_search_text, " ") + 1;

                        for($y = 0; $y < $company_space_count; $y++)
                        {
                                if($y == 0)
                                {
                                        $add_company_1 = "company LIKE '%" . $company_search_words[$y] . "%' ";
                                        $query = $query. " " .$add_company_1;
                                }
                                else
                                {
                                        $add_company_2 = "AND company LIKE '%" . $company_search_words[$y] . "%' ";
                                        $query = $query. " " .$add_company_2;
                                }
                        }
                }
        }

	$query = $query . " ORDER BY lastname ASC";

        //echo $query;
        require_once "private/login_auth_peopledb.php";

        $dbserver = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        if(!$dbserver) die ("Unable to connect to MySQL: " . mysqli_connect_error());

	/*if($dbserver)
	{
		echo " Made the connection to server. ";
	}*/

        $result = mysqli_query($dbserver, $query);
        if(!$result) die ("Unable to connect to Database: " . mysqli_connect_error());

	/*if($result)
	{
		echo " Query was successful.";
	}*/

        $rows = mysqli_num_rows($result);

        if($rows)
	{
		echo "<tr><td>There are " . $rows . " results.</td></tr>";
	}

        echo "<tr><td><b>First Name</b></td><td><b>Last Name</b></td>
        <td><b>Job Title<b></td><td><b>Company</b></td><td><b>Knows</b></td></tr>";

        for($q = 0; $q < $rows; ++$q)
        {
                echo "<tr>";

                $row = mysqli_fetch_row($result);

                echo "<td>" . $row[0] . "</td>"; //First Name

                echo "<td>" . $row[1] . "</td>"; //Last Name

                echo "<td>" . $row[2] . "</td>"; //Job Title

		echo "<td>" . $row[3] . "</td>"; //Company

                echo "<td>" . $row[4] . "</td>"; //Knows

                echo "<td></td>";

                echo "</tr>";
        }

        echo "</table></center>";

        mysqli_close($dbserver);
?>
</body>
</html>
