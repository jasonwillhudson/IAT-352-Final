<?php
include('included_functions.php');
no_SSL();

$code = trim($_GET['productCode']);
@$msg = trim($_GET['message']);

$query_str = "SELECT * 
			  FROM products 
			  WHERE productCode = ?"; 
			  
$stmt = $db->prepare($query_str);
$stmt->bind_param('s',$code);
$stmt->execute();
$stmt->bind_result($prCode,$prName,$prLine,$prScale,$prVendor,$prDesc,$prQ,$prPrice,$MSRP,$image);

include('header.php');

if($stmt->fetch()) {
	echo "<h3>$prName</h3>\n";
	echo "<p>Item Type: $prLine,<br> Fineness: $prScale,<br> Item Brand: $prVendor,<br> Original Buy Price: \$$prPrice</p>\n";
	echo "<p>Description: $prDesc</p>\n";
	echo "<img src='images/$image' alt='' />";
	}
$stmt->free_result();

if(is_logged_in() && !is_in_watchlist($code) ) {
	echo "<form action=\"addtowatchlist.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"productCode\" value=$code>\n";
	echo "<input type=\"submit\" value=\"I Like It\">\n";
	echo "</form>\n";
} else if (!empty($msg) ) {
	echo "<p>$msg</p>\n";
} else if (is_logged_in()) {
	echo "This model is already in your <a href=\"showwatchlist.php\">Likes</a>.";
}

include('footer.php');
$db->close();
?>

