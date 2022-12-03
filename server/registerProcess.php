<?php

// this line refers to the code that has db setup in it
include_once('helper/db.php');

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');

//if the user already existed, return a message and end the script
if (isUserExisted($db, $_POST["email"])) {
    echo "email is already existed, try something else";
    exit();
}

//write a query to get the user name and password from database
$query = "INSERT INTO member (name, email, password, city, phone)
VALUES (?,?,?,?,?);";

//send the query to database, execute and then get the result
$stmt = $db->prepare($query);
$stmt->bind_param('sssss', $_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["city"], $_POST["phone"]);
$stmt->execute();

//redirect user to login page
echo "success";
exit();


//Check if the user email is already existed, if yes return true, else return false
function isUserExisted($db, $email)
{
    //write a query to get the user name from database
    $query = "SELECT email FROM member WHERE email = ?";

    //send the query to database, execute and then get the result
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();

    //check if the result has more than one row (0 if user not existed)
    if ($stmt->num_rows == 0) {
        return false;
    } else return true;
}
