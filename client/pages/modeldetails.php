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


//require database for first time page render
require "../../server/helper/detailHelper.php";

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');
?>

<link rel="stylesheet" href="../css/productdetail.css">


<div class="container">

<?php
//get post id from the get post
$postID = trim($_GET['post_id']);


echo '<div id="post-id" style="display: none;">'.$postID.'</div>';

//show images
echo "<div class='image-wrapper'>";
echo "<img class='first-image'/>";
disPlayImage($postID);
echo "</div>";

echo "<div class='info-wrapper'>";

//show the basic information
displayBasicInfo($postID);

//display trade tags
echo "<h3>Want to Trade</h3>";
displayTradeTag($postID);

echo "</div>";
?>
</div>

<?php
include('../components/footer.php');
?>

<script src="../js/detailProcess.js"></script>