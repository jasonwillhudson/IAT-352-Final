<?php
include_once('../components/included_functions.php');

$message = "";
if (!empty($_GET['productCode']) && !empty($_SESSION['valid_user'])) {
	$query = "DELETE FROM watchlist WHERE email=? AND productCode =?";
	  
	$stmt = $db->prepare($query);
	$stmt->bind_param('ss',$_SESSION['valid_user'],$prCode);
	foreach($_GET['productCode'] as $pc) {
		$prCode = $pc;
		$stmt->execute();
	}	  
	$message = "The model(s) have been removed from to your Likes.";
	
}
echo $message;
//fetch the watchlist for the user
//redirect_to("showwatchlist.php");
?>

