<?php
// this line refers to the code that has db setup in it
include_once('helper/db.php');

//Get the email that user input in the form
$email = $_POST['email'];

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');

//write a query to get the user name and password from database
$query = "SELECT email, password FROM member WHERE email =\"$email\" AND NOT isBanned";

//send the query to database, execute and then get the result
$stmt = $db->prepare($query);
$stmt->execute();
$stmt->bind_result($email, $hashedPassword);


if($stmt->num_rows == 0) echo "No user Found"; //return error if no user found
else{
    //Direct user to last opened page if password is verified
    if(password_verify($password, $hashedPassword)){
        header("www.google.com");
    }
    else{
        echo "Password is incorrect";
    }
}