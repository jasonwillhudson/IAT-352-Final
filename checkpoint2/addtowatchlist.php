<?php
include_once('included_functions.php');

$productCode = !empty($_POST['productCode']) ? $_POST['productCode'] : "";

if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'addtowatchlist.php';
	$_SESSION['productCode'] = $productCode;
	redirect_to('sign-in.php');
} 

$email = $_SESSION['valid_user'];
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'addtowatchlist.php') {
	$productCode = $_SESSION['productCode'];
	unset($_SESSION['callback_url'],$_SESSION['productCode']);
}

$message = "";
if (!is_in_watchlist($productCode)) {
	$query = "INSERT INTO watchlist (email, productCode) VALUES (?,?)";
	  
	$stmt = $db->prepare($query);
	$stmt->bind_param('ss',$email,$productCode);
	$stmt->execute();
			  
	$message = urlencode("The model has been added to your <a href=\"showwatchlist.php\">likes</a>.");
}
//fetch the watchlist for the user
redirect_to("modeldetails.php?productCode=$productCode&message=$message");

?>

