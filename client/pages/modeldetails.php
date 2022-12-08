
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

<link rel="stylesheet" href="../css/chat.css">


<?php
include('../components/included_functions.php');
no_SSL();

$code = trim($_GET['post_id']);
$msg = trim($_GET['message']);


$query_str = "SELECT * 
			  FROM post
			  WHERE post_id = ?"; 
			  
			  
$stmt = $db->prepare($query_str);


$stmt->bind_param('s',$code);
$stmt->execute();

$stmt->bind_result($postId,$postTitle,$postDesctib,$postDate,$postEmail,$postCategory,$isRp, $isPr,$postValue);
// echo "123";
// $query_str = "SELECT * 
// 			  FROM image_path 
// 			  WHERE post_id = ?"; 
			  
			  
// $stmt = $db->prepare($query_str);


// $stmt->bind_param('s',$code);
// $stmt->execute();

// $stmt->bind_result($postId1,$image);


if($stmt->fetch()) {
	echo "<h3>$postTitle</h3>\n";
	echo "<p>Item Type: $prLine,<br> Fineness: $prScale,<br> Item Brand: $prVendor,<br> Original Buy Price: \$$prPrice</p>\n";
	echo "<p>Description: $prDesc</p>\n";
	echo "<img src='images/$image' alt='' />";
	}
$stmt->free_result();

if(is_logged_in() && !is_in_watchlist($code) ) {
	echo "<form action=\"addtowatchlist.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"post_id\" value=$code>\n";
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

