<?php
include_once('../components/included_functions.php');
session_start();

$post_id = !empty($_GET['postId']) ? $_GET['postId'] : "";


if(!isset($_SESSION['email'])) {
	$_SESSION['callback_url'] = 'addtowatchlist.php';
	$_SESSION['postId'] = $post_id;
	redirect_to('login.php');
} 

$email = $_SESSION['email'];
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'addtowatchlist.php') {
	$post_id = $_SESSION['postId'];
	unset($_SESSION['callback_url'],$_SESSION['postId']);
}

$message = "";
if (!is_in_watchlist($post_id)) {

	$query = "INSERT INTO collection (collector_email, post_id) VALUES (?,?)";
	  
	$stmt = $db->prepare($query);
	$stmt->bind_param('si',$email,$post_id);
	$stmt->execute();
			  
	//$message = urlencode("The model has been added to your <a href=\"showwatchlist.php\">likes</a>.");
}else{
	$query = "DELETE FROM collection WHERE post_id = ? AND collector_email = ?";
	  
	$stmt = $db->prepare($query);
	$stmt->bind_param('is',$post_id, $email);
	$stmt->execute();
}
//fetch the watchlist for the user
redirect_to("modeldetails.php?post_id=$post_id");

?>
