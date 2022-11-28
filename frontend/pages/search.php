<style>
.container{
	display:flex;
}

.filter{
	width: 300px;
	border-right:1px solid #eee;
	height: 100vh;
}

.result{
	padding:0 1rem;
}
</style>
<?php
include('included_functions.php');
no_SSL();


include('header.php');

$sql = "SELECT DISTINCT productLine FROM products";
$res = $db->query($sql);

while ($row = $res->fetch_assoc()){

}

echo "Search: <input type='text' name='search' class='searchContent'>";
echo " <button id='searchBtn'>GO</button>";

echo "<div class='container'>";
echo "<div class='filter'>";
echo "<h2>Search Filter</h2>";

$sql = "SELECT DISTINCT productLine FROM products";
$res = $db->query($sql);

echo "<h4>Product Line:</h4>";
while ($row = $res->fetch_assoc()){
	echo "<input type='checkbox' class='productLine' value='". $row["productLine"] ."'> " . $row["productLine"] . "<br>"; 
}

echo "<h4>Price range</h4>";
echo "<p>Price: <input type='text' class='priceFrom' placeholder='min' size='10'> ";
echo "<input type='text' class='priceTo' placeholder='max' size='10'>\n";
echo " <button id='priceFilterBtn'>GO</button></p>";
echo "</div>";
echo "<div class='result'>";
echo "<h2>Search result</h2>";
echo "<div id='result'></div>";
echo "</div>";
echo "</div>";
include('footer.php');

?>

