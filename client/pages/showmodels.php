<style>
	.container {
		display: flex;
	}

	#filter {
		display: flex;
		flex-direction: column;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		margin: 20px;
		padding: 20px;
		flex: 0 0 250px;
	}

	.sub-filter {
		display: flex;
		flex-direction: column;
		margin-left: 40px;
	}

	.filter-title-wrap input {
		margin: 12px;
	}

	.filter-title-wrap {
		font-size: 16px;
		font-weight: 600;
		margin-top: 30px;
	}

	.post-container {
		display: flex;
		justify-content: center;
		flex: 1 1 100%;
	}

	.post-list {
		display: inline-flex;
		padding: 20px;
		flex-wrap: wrap;
		flex: 1 1 100%;
		height: fit-content;
	}

	.post-wrap {
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		height: 310px;
		width: 250px;
		margin: 15px;
		transition: .4s;
	}

	.post-title {
		width: 80%;
		margin: auto;
		height: 40px;
		overflow: hidden;
		font-weight: 400;
		margin-top: 8px;
		font-size: 17px;
	}

	.post-wrap:hover {
		transform: translateY(-10px);
		transition: .4s;
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
	/*
include('../components/included_functions.php');

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

*/
	echo "<form method = post id=\"filter\">";

	echo "<h3>Filter By</h3>";

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
	echo '<input type="submit" name= "submit" value="Filter Result" style="width:130px; font-size: 16px; height:50px; display:flex; justify-content:center; align-self:center; margin:25px;">';
	echo "</form>";


	?>
	<!---------------------------------Display Posts------------>
	<div class="post-container" id="posts">
		<?php echo getPostsList([]) ?>
	</div>
</div>
<script src="../js/postListProcess.js"></script>
<?php require "../components/footer.php"; ?>