<?php
// this line refers to the code that has db setup in it
include_once('helper/db.php');

//start the session
session_start();

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
    //return error message if there has no user found
    $return_arr[] = array(
        "mssg" => "No user found",
        "visitedUrl" => ""
    );

    // Encoding array in JSON format
    echo json_encode($return_arr);
    exit();
} else {
    while ($stmt->fetch()) {
        //Direct user to last opened page if password is verified
        if (password_verify($_POST['password'], $hashedPassword)) {

            //store the email address to the session
            $_SESSION['email'] = $_POST['email'];

            //make an array to store the url link for direction and success mssg
            $return_arr[] = array(
                "mssg" => "success",
                "visitedUrl" => (empty($_SESSION['url']) ? "" : $_SESSION['url'])
            );

            // Encoding array in JSON format
            echo json_encode($return_arr);

            exit();
        }
        //return an error message if password does not match
        else {

            
            //make an array to store the url link for direction and success mssg
            $return_arr[] = array(
                "mssg" => "Password is incorrect",
                "visitedUrl" => ""
            );

            // Encoding array in JSON format
            echo json_encode($return_arr);
            exit();
        }
    }
}
