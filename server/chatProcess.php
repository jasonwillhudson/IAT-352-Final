<?php
include_once('helper/db.php');

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');

//query
$query = "SELECT usermsg FROM member WHERE email = ? AND NOT isBanned";

//send the query to database, execute and then get the result
$stmt = $db->prepare($query);
$stmt->bind_param('s', $_POST['???']);
$stmt->execute();
$stmt->bind_result(???);

$stmt->store_result();

Footer
?>
