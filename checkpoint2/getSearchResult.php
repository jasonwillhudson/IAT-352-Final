<?php
include('included_functions.php');
// no_SSL();
// $db =  connectToDB('localhost', 'root', '', 'classicmodels');

$message = "";
$parasContent = [];
$paraType = "";

if (!empty($_GET["search"])){
    $wordsArr = explode(" ", $_GET["search"]);
    $sql = "SELECT * FROM products WHERE (";
    $contentArray  = [];
    foreach ($wordsArr as $word){
        $contentArray[] = "productName like ? OR productDescription like ?"; // OR productDescription like ?
        $parasContent[] = "%" . $word . "%";
        $parasContent[] = "%" . $word . "%";
        $paraType .= "ss";
    }
    $sql .= implode(" OR ", $contentArray) . ")";
}else{
    echo "No any result to match";
    exit();
}

if (!empty($_GET["priceFrom"]) && !empty($_GET["priceTo"])){
    $sql .= " AND buyPrice BETWEEN ? AND ?";

    $parasContent[] = $_GET["priceFrom"];
    $parasContent[] = $_GET["priceTo"];
    $paraType .= "dd";
}

if (!empty($_GET["productLine"])){
    $sql .= " AND (";
    $lines = [];
    foreach ($_GET["productLine"] as $line){
        $lines[] = "productLine = ?";
        $parasContent[] = $line;
        $paraType .= "s";
    }
    $sql .= implode(" OR ", $lines) . ")";
}

if (!empty($_GET["productVendor"])){
    $sql .= " AND (";
    $lines = [];
    foreach ($_GET["productVendor"] as $line){
        $lines[] = "productVendor = ?";
        $parasContent[] = $line;
        $paraType .= "s";
    }
    $sql .= implode(" OR ", $lines) . ")";
}

// print_r($parasContent);
// print_r($paraType);

// print_r($parasContent);
$stmt = $db->prepare($sql);
$stmt->bind_param($paraType, ...$parasContent);
$stmt->execute();

$res = $stmt->get_result();
$matchCount = $res->num_rows;

echo "<h3>Search result for <span style='color:red; font-style:italic; font-size:16pt'>". $_GET["search"] . " (" . $matchCount . ") </span></h3>";
$message .= "<div class='products'>";
while ($row = $res->fetch_assoc()){
    $message .= "<div>";
    if ($row["image"] != ""){
        $message .= "<img src='images/" . $row["image"] . "' alt='' />";
    }else{
        $message .= "<img src='images/null.png' alt='' />";
    }
    
    $message .= "<h3><a href='modeldetails.php?productCode=". $row["productCode"] ."'>". $row["productName"] ."</a></h3>";
    $message .= "<p>". subStr($row["productDescription"], 0, 100) ." ......</p>";
    $message .= "<p><b>Item Type:</b> ". $row["productLine"] ."</p>";
    $message .= "<p><b>Original Price Cost:</b> $". $row["buyPrice"] ."</p>";
    $message .= "<p><b>Item Brand:</b> ". $row["productVendor"] ."</p>";
    $message .= "</div>";
}

$message .= "</div>";

echo $message;

?>



