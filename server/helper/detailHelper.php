<?php

include_once "db.php";

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');


//start the session if no session existed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//get the basic information of the post detail from database
function displayBasicInfo($postID)
{

    global $db;




    //write a query to select the unique post data we need from joined tables
    $query_str = "SELECT post.post_id, post.title, post.description, post.date, post.email, post.category, post.value,member.name, member.city, member.phone
    FROM post INNER JOIN member ON post.email = member.email
    WHERE post.post_id = ?";


    //echo $query;
    //send the query to database to execute and return the result
    $stmt = $db->prepare($query_str);
    $stmt->bind_param('i', $postID);
    $stmt->execute();

    $stmt->bind_result($postId, $title, $description, $date, $email, $category, $value, $name, $city, $phone);

    //make each of chat information to html element and send them to ajax to render on the page
    $result = '<div class="basic-info">';
    while ($stmt->fetch()) {

        //title elements
        $result .= '<div class="wrap"><h2 class="main-title">' . $title . ' <strong>Value(CAD)</strong> <span>' . $value . '</span></h2>';
        $result .= '<p class="sub-title"><strong>By </strong>' . $name . '</p>';
        $result .= '<p class="sub-title"><strong>Date </strong>' . $date . '</p></div>';


        //Desctiprion of the item
        $result .= '<div class="wrap"><h3 class="info-title">Description </h3>';
        $result .= '<p class="contact">' . $description . '</p></div>';


        //contact elements
        $result .= '<div class="wrap"><h3 class="info-title">Contact Information</h3>';
        $result .= '<p class="contact"><strong>Phone </strong>' . $phone . '</p>';
        $result .= '<p class="contact"><strong>Email </strong>' . $email . '</p>';
        $result .= '<p class="contact"><strong>City </strong>' . $city . '</p>';
        $result .= '<button id="message">Message Owner</button></div>';
    }

    $result .= '</div>';
    //favourite element
    $button = "";
    $button .= getLikeButton($postID, $email);

    echo $button;
    echo $result;
}


//get the list of item user want to trade with
function displayTradeTag($postID)
{
    global $db;
    $query = "SELECT category FROM want_to_trade WHERE post_id = ?";

    $stmt = $db->prepare($query);

    $stmt->bind_param('i', $postID);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='tag-container'>";
    while ($row = $result->fetch_row()) {

        echo  "<span class='trade-tag'>$row[0]</span>";
    }
    echo "</div>";
}


//get the list of image path
function disPlayImage($postID)
{

    global $db;
    $query = "SELECT image_path FROM image_path WHERE post_id = ?";

    $stmt = $db->prepare($query);

    $stmt->bind_param('i', $postID);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_row()) {

        echo  "<img class=\"gallery-img\" src='../../server/$row[0]' alt=''> ";
    }
}

function getLikeButton($postID, $postEmail)
{
    global $db;
    $query = "SELECT post_id FROM collection WHERE post_id = ? AND collector_email = ?";

    $stmt = $db->prepare($query);
    //start the session if no session existed

    $stmt->bind_param('is', $postID, $_SESSION['email']);
    $stmt->execute();
    $stmt->store_result();

    $result = "";
    //add like and unlike button if user log in and this post is not posted by the user
    if (!empty($_SESSION['email']) && $_SESSION['email'] != $postEmail) {
        if ($stmt->num_rows != 0) {
            //post is in collection
            $result .= '<a class="unlike-button"><span class="button-text">Unlike</span><span id="' . $postID . '" class="unlike star"> &#9733;</span></a>';
        } else {
            //post is not in collection
            $result .= '<a class="like-button"><span class="button-text">Like</span><span id="' . $postID . '" class="like star">&#9734;</span></a>';
        }
    } else {
        $result .= '<a><span></span></a>';
    }

    return $result;
}
