<?php

include_once "db.php";

//connect to database
$db = connectToDB('localhost', 'root', '', 'svap');




//start the session if no session existed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}




//get the list of post data from the database
function getPostsList($filter, $search)
{

    //check if user log in and get it's email address if so
    $email = "";
    if (!empty($_SESSION['email'])) $email = $_SESSION['email'];

    $collection = getCollection($email);

    global $db;

    //array storing sql where clouse
    $sql = array();

    //array for storing the bind parameters
    $parameters = array();

    //add all the filtered catecory tag to the array
    if ($filter) {
        $sql = array_fill(0, count($filter), " post.category = ? ");
        $parameters = $filter;
    }

    //write a query to select the unique post data we need from joined tables
    $query = "SELECT MAX(post.title), MAX(image_path.image_path), post.post_id, MAX(member.name), MAX(member.email) FROM post  
                INNER JOIN image_path ON post.post_id = image_path.post_id
                INNER JOIN member ON member.email = post.email ";

    //add where clause to the sql query
    if ($sql) {
        $clouse = implode(' OR ', $sql);
        $query .= ' WHERE (' . $clouse . ') ';
    }


//=============================================Search Query==========================//
    $keywords = [];
    if (!empty($search)) {

        //split search into a keywords array if search filed not empty
        $keywords = explode(" ", $search);

        //add search where clause to the query
        $query .= "AND (title REGEXP '" .  implode('|', $keywords) . "' OR description REGEXP '" . implode('|', $keywords) . "') ";
    }

//======================================================================================//

    //add group by clause to the sql query
    $query .= " GROUP BY post.post_id ";


    //send the query to database to execute and return the result
    $stmt = $db->prepare($query);
    if ($parameters) {
        $stmt->bind_param(str_repeat('s', count($filter)), ...$parameters);
    }
    $stmt->execute();
    $stmt->bind_result($title, $imagePath, $postID, $username, $userEmail);

    //make each of chat information to html element and send them to ajax to render on the page
    $result = '<div class="post-list">';
    $pathStart = '../../server/'; //the path to reach the folder


    while ($stmt->fetch()) {
        $result .= '<div class="post-wrap"><a href=../pages/modeldetails.php?post_id=' . $postID . '>';
        $result .= '<img class="post-image" src = "' . $pathStart . $imagePath . '" alt="post image"/></a>';
        $result .= '<div class="text-wrap"><p class="post-title">' . $title . '</p>';

        //add like and unlike button if user log in and this post is not posted by the user
        if (!empty($email) && $email != $userEmail) {
            if (in_array($postID, $collection)) {
                //post is in collection
                $result .= '<span id="' . $postID . '" class="unlike star">&#9733;</span>';
            } else {
                //post is not in collection
                $result .= '<span id="' . $postID . '" class="like star">&#9734;</span>';
            }
        } else {
            $result .= '<span class="star"></span>';
        }

        $result .= '</div></div>';
    }

    $result .= '</div>';


    return $result;
}





//get the posts from user collections and return an array of post id
function getCollection($email)
{
    global $db;

    //write a query to get all the post this user collected
    $query = "SELECT post_id FROM collection WHERE collector_email = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($postID);

    //use an array to store the post id from the collection
    $result = array();
    while ($stmt->fetch()) {
        $result[] = $postID;
    }

    return $result;
}





//Add the data to collection table
function addToCollection($postID)
{
    global $db;

    //write a query to add post to collection
    $query = "INSERT INTO collection (collector_email, post_id) VALUES (?,?)";

    if (empty($_SESSION['email'])) {
        echo "user not found";
        exit();
    }

    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $_SESSION['email'], $postID);
    $stmt->execute();

    return 'success';
}






//remove the post from the collection
function removeFromCollection($postID)
{
    global $db;

    //write a query to add post to collection
    $query = "DELETE FROM collection WHERE collector_email = ? AND post_id = ?";

    if (empty($_SESSION['email'])) {
        echo "user not found";
        exit();
    }

    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $_SESSION['email'], $postID);
    $stmt->execute();

    return 'success';
}






//get the list of post data from the database
function getCollectionList()
{

    global $db;

    //write a query to select the unique post data we need from joined tables
    $query = "SELECT MAX(post.title), MAX(image_path.image_path), post.post_id FROM post  
                INNER JOIN image_path ON post.post_id = image_path.post_id 
                INNER JOIN collection ON collection.post_id = post.post_id
                WHERE collector_email = ? GROUP BY post.post_id";


    //send the query to database to execute and return the result
    $stmt = $db->prepare($query);

    //if session not exists, handle the error
    if (empty($_SESSION['email'])) {
        echo "user not found";
        exit();
    }

    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $stmt->bind_result($title, $imagePath, $postID);

    //make each of chat information to html element and send them to ajax to render on the page
    $result = '<div class="post-list">';
    $pathStart = '../../server/'; //the path to reach the folder


    while ($stmt->fetch()) {
        $result .= '<div class="post-wrap"><a href=../pages/modeldetails.php?post_id=' . $postID . '>';
        $result .= '<img class="post-image" src = "' . $pathStart . $imagePath . '" alt="post image"/></a>';
        $result .= '<div class="text-wrap"><p class="post-title">' . $title . '</p>';

        //post is in collection, add unlike button
        $result .= '<span id="' . $postID . '" class="unlike star">&#9733;</span>';

        $result .= '</div></div>';
    }

    $result .= '</div>';


    return $result;
}





//get the elements to display the post at front end
function getMyPost()
{
    global $db;

    //write a query to select the unique post data we need from joined tables
    $query = "SELECT MAX(post.title), MAX(image_path.image_path), post.post_id FROM post  
                INNER JOIN image_path ON post.post_id = image_path.post_id 
                WHERE post.email = ? GROUP BY post.post_id";


    //send the query to database to execute and return the result
    $stmt = $db->prepare($query);

    //if session not exists, handle the error
    if (empty($_SESSION['email'])) {
        echo "user not found";
        exit();
    }

    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $stmt->bind_result($title, $imagePath, $postID);

    //make each of chat information to html element and send them to ajax to render on the page
    $result = '<div class="post-list">';
    $pathStart = '../../server/'; //the path to reach the folder


    while ($stmt->fetch()) {
        $result .= '<div class="post-wrap"><a href=../pages/modeldetails.php?post_id=' . $postID . '>';
        $result .= '<img class="post-image" src = "' . $pathStart . $imagePath . '" alt="post image"/></a>';
        $result .= '<div class="text-wrap"><p class="post-title">' . $title . '</p>';

        //post is in collection, add unlike button
        $result .= '<button id="' . $postID . '" class="delete-button">Delete</button>';

        $result .= '</div></div>';
    }

    $result .= '</div>';


    return $result;
}





//remove post from database
function removePost($postID)
{

    global $db;

    //remove all the basic information of the posts
    $query = "DELETE post, image_path, want_to_trade FROM post
    INNER JOIN image_path ON image_path.post_id = post.post_id
    INNER JOIN want_to_trade ON want_to_trade.post_id = post.post_id
    WHERE post.post_id = ?";

    //send the query to database to execute and return the result
    $stmt = $db->prepare($query);

    $stmt->bind_param('i', $postID);
    $stmt->execute();

    //remove comments of the posts
    //removeRowIn("comment", $postID);

    //remove post from collection
    removeRowIn("collection", $postID);

    //remove the image folder contains this post's image files
    $dir = "imgStorage/" . $_SESSION['email'] . "/" . $postID;
    if (file_exists($dir)) removeImg($dir);
}

function removeRowIn($table, $postID)
{

    global $db;

    $query = "DELETE FROM " . $table . " WHERE post_id = ?";


    //send the query to database to execute and return the result
    $stmt = $db->prepare($query);

    $stmt->bind_param('i', $postID);
    $stmt->execute();
}

//remove image files
function removeImg($path)
{
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeImg($file) : unlink($file);
    }
    rmdir($path);
    return;
}
