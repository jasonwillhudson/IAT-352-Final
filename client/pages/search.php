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
include('../components/included_functions.php');
no_SSL();


include('../components/header.php');

echo "<form action='search.php' method='get' class='searchBar'>";
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

include('../components/footer.php');
?>

<!-- <script>
	console.log("sdsdfdsf");
	document.querySelector("#searchBtn").click()
</script> -->

