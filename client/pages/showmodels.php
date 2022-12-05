<?php
include('../components/included_functions.php');
no_SSL();


//check the values enterred (ommitted here)


$query_str = "SELECT productCode, productName FROM products";
$res = $db->query($query_str);

function format_model_name_as_link($id,$name,$page) {
	echo "<a href=\"$page?productCode=$id\">$name</a>";
	}

include('../components/header.php');

echo "<h2>All Items</h2>";

echo "<ul>";
while ($row = $res->fetch_row()) {
	echo "<li>";
	format_model_name_as_link($row[0], $row[1],"modeldetails.php");
	
	echo "</li>\n";
};
echo "</ul>";

include('../components/footer.php');
$res->free_result();
$db->close();
?>

