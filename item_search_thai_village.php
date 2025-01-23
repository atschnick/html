<html>
<link rel="stylesheet" href="css_files/construction.css" />
<body class=parallax>
<form method=post action=>
<center><table border=0>
<tr>
        <td>Item Name: </td>
        <td><input type=text name=itemsearch></td>
        <td><input type=submit value=Search></td>
</tr>
<tr>
        <td>SKU code: </td>
        <td><input type=text name=skusearch></td>
        <td><input type=submit value=Search></td>
</tr>
<tr>
        <td>Category: </td>
        <td><input type=text name=catsearch></td>
        <td><input type=submit value=Search></td>
</tr>
<tr>
        <td colspan=2></td>
        <td><input type=submit name=submit value=Reset></td>
</tr>
<tr>
	<td colspan=3><a href=cart.php class=button>View Cart --></a></td>
</tr>
</table>
</form>
<?php
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
                $query = "SELECT * FROM thaivillagecodes";
        }
        else
        {
                if(isset($_POST['submit']) == 'Reset')
                {
                        $query = "SELECT * FROM thaivillagecodes";
                }
                if($_POST['itemsearch'])
                {
                        $item_search_text = $_POST['itemsearch'];
                        $query = $query. "SELECT * FROM thaivillagecodes WHERE ";

                        $item_search_words = explode(" ", $item_search_text);

                        $item_space_count = substr_count($item_search_text, " ") + 1;

                        for($d = 0; $d < $item_space_count; $d++)
                        {
                                if($d == 0)
                                {
                                        $add_item_1 = "item LIKE '%" . $item_search_words[$d] . "%' ";
                                        $query = $query. " " .$add_item_1;
                                }
                                else
                                {
                                        $add_item_2 = "AND item LIKE '%" . $item_search_words[$d] . "%' ";
                                        $query = $query. " " .$add_item_2;
                                }
                        }
                }

                if($_POST['skusearch'])
                {
                        $skusearch = $_POST['skusearch'];
                        $query = $query. "SELECT * FROM thaivillagecodes WHERE sku LIKE '%" . $skusearch . "%'";
                }

                if($_POST['catsearch'])
                {
                        $cat_search_text = $_POST['catsearch'];
                        $query = $query. "SELECT * FROM thaivillagecodes WHERE ";
                        $cat_search_words = explode(" ", $cat_search_text);

                        $cat_space_count = substr_count($cat_search_text, " ") + 1;

                        for($y = 0; $y < $cat_space_count; $y++)
                        {
                                if($y == 0)
                                {
                                        $add_cat_1 = "category LIKE '%" . $cat_search_words[$y] . "%' ";
                                        $query = $query. " " .$add_cat_1;
                                }
                                else
                                {
                                        $add_cat_2 = "AND category LIKE '%" . $cat_search_words[$y] . "%' ";
                                        $query = $query. " " .$add_cat_2;
                                }
                        }
                }
        }

	//$query = "SELECT * FROM thaivillagecodes";

        //echo $query;
        require_once "private/login_auth_thai_village.php";

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
		echo "<table><tr><td>There are " . $rows . " items.</td></tr></table>";
	}

        echo "<table border=0><tr><th>Customer</th><th>Category</th>
        <th>SKU</th><th>Item</th><th>Price Each</th><th>Quantity</th><th>Payment Method</th><th></th></tr>";

        for($q = 0; $q < $rows; ++$q)
        {
                echo "<tr><form method=post action=insert.php>";

                $row = mysqli_fetch_row($result);

                echo "<td><input type=text name=customer size=15></td>";

                echo "<td>" . $row[0] . "</td>"; //Category

                echo "<td>" . $row[1] . "<input type=hidden name=sku value=" . $row[1] . "></td>"; //sku

                echo "<td>" . $row[2] . "<input type=hidden name=item value=" . $row[2] . "></td>"; //item

		echo "<td>$" . $row[3] . "<input type=hidden name=unitprice value=" . $row[3] . "></td>"; //unitprice

                echo "<td><input type=text name=quantity value=0 size=6></td>";

                echo "<td><select name=paymentmethod>
                        <option value=Cash>Cash</option>
                        <option value=Check>Check</option>
                        <option value=PayPal>PayPal</option>
                </select></td>";

                echo "<td><input type=submit name=submit value='Add to Cart'></td>";

                echo "</form></tr>";
        }

        echo "</table></center>";

        mysqli_close($dbserver);
?>
</body>
</html>

