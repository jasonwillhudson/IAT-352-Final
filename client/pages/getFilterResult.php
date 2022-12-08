

<?php
include('../components/included_functions.php');
// $db =  connectToDB('localhost', 'root', '', 'classicmodels');


$parasContent = [];
$paraType = "";

if (!empty($_GET["search"])){
   
    $wordsArr = explode(" ", $_GET["search"]);
    $sql = "SELECT DISTINCT category, count(category) as n FROM post WHERE (";
    $contentArray  = [];
    foreach ($wordsArr as $word){
        $contentArray[] = "title like ? OR description like ?"; // OR productDescription like ?
        $parasContent[] = "%" . $word . "%";
        $parasContent[] = "%" . $word . "%";
        $paraType .= "ss";
    }
    $sql .= implode(" OR ", $contentArray) . ")";
    $sql .= " GROUP BY category";
    
    // $sql = "SELECT DISTINCT productLine FROM products WHERE productName like ? OR productDescription like ?";
    // $parasContent[] = "%" . $_GET["search"] . "%";
    // $parasContent[] = "%" . $_GET["search"] . "%";
    // $paraType .= "ss";


    $stmt = $db->prepare($sql);
    $stmt->bind_param($paraType, ...$parasContent);
    $stmt->execute();
    $res = $stmt->get_result();

    echo "<h2>Search Filter</h2>";

    echo "<div style='border:1px solid #eee; padding:0.5rem'>";
    echo "<h4>Item Type:</h4>";
    while ($row = $res->fetch_assoc()){
        echo "<input type='checkbox' class='productLine' value='". $row["category"] ."'> " . $row["category"] . " (" . $row["n"] . ")<br>"; 
    }
    echo "</div>";

    echo "<div style='border:1px solid #eee; padding:0.5rem'>";
    echo "<h4>Price range</h4>";
    echo "<p>Price: <input type='text' class='priceFrom' placeholder='min' size='10'> ";
    echo "<input type='text' class='priceTo' placeholder='max' size='10'>\n";
    echo " <button id='priceFilterBtn'>GO</button></p>";
    echo "</div>";

    $sql = "SELECT brand, count(brand) as n FROM post WHERE (";
    $contentArray  = [];
    unset($parasContent);
    $paraType = "";
    foreach ($wordsArr as $word){
        $contentArray[] = "title like ? OR description like ?"; // OR productDescription like ?
        $parasContent[] = "%" . $word . "%";
        $parasContent[] = "%" . $word . "%";
        $paraType .= "ss";
    }
    $sql .= implode(" OR ", $contentArray) . ")";
    $sql .= " GROUP BY brand";
    

    $stmt = $db->prepare($sql);
    $stmt->bind_param($paraType, ...$parasContent);
    $stmt->execute();
    $res = $stmt->get_result();

    echo "<div style='border:1px solid #eee; padding:0.5rem'>";
    echo "<h4>Item Brand:</h4>";
    while ($row = $res->fetch_assoc()){
        echo "<input type='checkbox' class='productVendor' value='". $row["brand"] ."'> " . $row["brand"] . " (" . $row["n"] . ")<br>"; 
    }
    echo "</div>";

}else{
    echo "No any filter result";
}

?>



