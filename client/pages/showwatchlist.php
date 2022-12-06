<?php
include_once('../components/included_functions.php');
no_SSL();

if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'showwatchlist.php';
	redirect_to('sign-in.php');
} 

$email = $_SESSION['valid_user'];
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'showwatchlist.php') {
	unset($_SESSION['callback_url']);
}

$query_str = "SELECT P.productCode, P.productName ";
$query_str .= "FROM products P INNER JOIN watchlist W ON P.productCode = W.productCode ";
$query_str .= "WHERE W.email='$email'";
$res = $db->query($query_str);

function format_model_name_as_link($id,$name,$page) {
	echo "<a href=\"$page?productCode=$id\">$name</a>";
	}
function format_watchlist_action_link($id,$name,$page) {
	echo "<a class=\"action\" href=\"$page\">$name</a>";
	}

include_once('../components/header.php');

if (isset($message)) echo "<p>$message</p>";

echo "<h2>Items You Liked</h2>\n";
echo "<ul>\n";
while ($row = $res->fetch_row()) {
	echo "<li id=\"". $row[0] . "\"><input type=\"checkbox\" class=\"watch_checks\">";
	format_model_name_as_link($row[0], $row[1],"modeldetails.php");
	echo " ";
	format_watchlist_action_link($row[0],"Remove","removefromwatchlist.php");
	echo "</li>\n";
};
echo "</ul>\n";

echo "<button type=\"button\" formaction=\"removefromwatchlist.php\">Remove Selected</button>";

echo "<p id=\"msg\"></p>\n";
include_once('../components/footer.php');

$res->free_result();
$db->close();
?>

