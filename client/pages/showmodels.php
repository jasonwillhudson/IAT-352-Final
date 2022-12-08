<style>
	.container {
		display: flex;
	}

	.filter {
		width: 300px;
		border-right: 1px solid #eee;
		height: 100vh;
		font-size: 10pt;
		min-width: 290px;
		padding: 0 0.5rem;
	}

	.result {
		padding: 0 1rem;
	}

	.searchBar {
		margin: 0.2rem 0;
	}

	.products{
		display:flex;
		flex-wrap: wrap;
		gap:1rem;
		font-size:11pt;
	}

	.products img{
		width:100%;
		border-radius:20px;
	}

	.products>div{
		flex: 1 1 15%;
		max-width:16rem;
		border:1px solid #ddd;
		border-radius:20px;
		padding:1rem;
		background:#f6f6f6;
	}
</style>


<?php
session_start();

//import web elements generation helper
include_once "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if (!initialize(false, false)) exit();

//import header elements
require "../components/header.php";

//import navbar
require "../components/nav.php";
?>

<!-- <link rel="stylesheet" href="../css/chat.css"> -->


<?php
include('../components/included_functions.php');
no_SSL();


echo "<form action='showmodels.php' method='get' class='searchBar'>";
echo "Search: <input type='text' name='search' class='search' size = '40' value=''>";
echo "<input type='submit' id='searchBtn' value='GO'/>";
echo "</form>";

echo "<div class='container'>";
echo "<div class ='filter'>";
echo "<div id='displayFilter'>";

echo "</div>";
echo "</div>";
echo "<div class='result'>";
echo "<div id ='displayResult'>";

echo "</div>";
echo "</div>";
echo "</div>";


?>

<?php





$query_str = "SELECT post_id, title, description, date, category, value  FROM post";

$res = $db->query($query_str);


function format_model_name_as_link($id,$title,$page) {
	echo "<a href=\"$page?post_id=$id\">$title</a>";
	}

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





