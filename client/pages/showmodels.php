<link rel="stylesheet" href="../css/postlist.css">
<style>
	.container {
		display: flex;
	}
</style>


<?php
session_start();

//import web elements generation helper
include_once "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if (!initialize(false, false)) exit();

//include helper Functions
include_once("../../server/helper/postHelper.php");

//import header elements
require "../components/header.php";

//import navbar
require "../components/nav.php";

?>



<div class=container>
	<?php

	echo "<form method = post id=\"filter\">";

	echo "<div style='display:flex;'>";
	makeInput("", "search", "text");
	//submit
	echo '<input type="submit" name= "submit" value="Search" style="font-size:15px; width: fit-content; padding: 0 15px; margin-left: 5px;">';
	echo "</div>";
	 
	//Digital Media Section
	echo "<div class='filter-title-wrap'><input type='checkbox' name='media' id='media'/><span class ='filter-title'>Media Entertainment</span></div>";
	$arr = array('Casset' => 'casset', 'CD' => 'cd', 'DVD' => 'dvd', 'Blu-Ray' => 'blu-ray', 'Laser Disc' => 'laser-disc');
	createCheckBoxes('media', $arr);


	//Electronics section
	echo "<div class='filter-title-wrap'><input type='checkbox' name='electronic' id='electronics'/><span class ='filter-title'>Electronics</span></div>";
	$arr = array('TV' => 'tv', 'Desktop' => 'desktop', 'Laptop' => 'laptop', 'Speaker' => 'speaker', 'Phone' => 'phone', 'Gaming Console' => 'game-console');
	createCheckBoxes('electronics', $arr);


	//Collectibles section
	echo "<div class='filter-title-wrap'><input type='checkbox' name='toys' id='toys'/><span class ='filter-title'>Toys / Collectibles</span></div>";
	$arr = array('Collectible' => 'collectible', 'Funko Pop' => 'funko-pop', 'Figure' => 'figure', 'Lego' => 'lego');
	createCheckBoxes('collectible', $arr);


	//submit
	echo '<input type="submit" name= "submit" value="Filter Result" style="width:100%; font-size: 16px; height:50px; display:flex; justify-content:center; align-self:center; margin-top:25px;">';
	echo "</form>";


	?>
	<!---------------------------------Display Posts------------>
	<div class="post-container" id="posts">
		<?php echo getPostsList([], "") ?>
	</div>
</div>
<script src="../js/postListProcess.js"></script>
<?php require "../components/footer.php"; ?>