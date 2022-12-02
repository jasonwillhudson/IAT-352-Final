<?php
// this line refers to the code that has db setup in it
include_once('helper/db.php');

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');

//write a query to get the password from database
$query = "SELECT password FROM member WHERE email = ? AND NOT isBanned";

//send the query to database, execute and then get the result
$stmt = $db->prepare($query);
$stmt->bind_param('s', $_POST['email']);
$stmt->execute();
$stmt->bind_result($hashedPassword);

$stmt->store_result();
if ($stmt->num_rows == 0) {
    echo "No user Found"; //return error if no user found  
} else {
    while ($stmt->fetch()) {
        //Direct user to last opened page if password is verified
        if (password_verify($_POST['password'], $hashedPassword)) {

            echo "success";
            exit();
        }
        //return an error message if password does not match
        else {
            echo "Password is incorrect";
        }
    }
}
